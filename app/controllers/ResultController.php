<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../../config/Database.php';

class ResultController {

    public function index($item = null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);

        $data['Result'] = $activityModel->getActivityResult(['ResultId'=>$db->escape($item)]);
        if($data['Result'] === []){
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        $data['Activity'] = $activityModel->getActivity(['ActivityId'=>$db->escape($data['Result'][0]['Activity_Id'])]);

        $data['Summary'] = json_decode($data['Result'][0]['Summary']);

        $data['title'] = "Skiller - Assessment Result";
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/result.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function action($item = null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!isset($_POST['ActivityId'])) {
                header('Location: '.BASE_URL.'?page=NotFound');
                exit;
            } 

            $ActivityId = null;
            $LessonId = null;
            $score = 0;
            $summary = [];
            $total = 0;

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $activityModel = new ActivityModel($db, $logger);

            $Activity =  $activityModel->getActivity(['ActivityId'=>$db->escape($item)]);

            $ActivityHistory =  $activityModel->getActivity(['ActivityId'=>$db->escape($item)]);
            
            $rawQuestions = $activityModel->getActivityQuestions(['ActivityId'=>$db->escape($item)]);

            $data['Questions'] = [];

            foreach ($rawQuestions as $value) {
                $data['Questions'][$value['Id']] = [
                    'Question' => $value['Question'],
                    'QuestionOption1' => $value['Option1'],
                    'QuestionOption2' => $value['Option2'],
                    'QuestionOption3' => $value['Option3'],
                    'QuestionOption4' => $value['Option4'],
                    'QuestionAnswer' => $value['Answer'],
                    'QuestionPoints' => $value['Points'],
                    'QuestionImage' => $value['Image']
                ];
            }

            foreach ($_POST as $key => $value) {
                $filteredKey = sanitizeInput($key);
                $filteredValue = sanitizeInput($value);
            
                if ($filteredKey === "ActivityId") {
                    $ActivityId = (int)$filteredValue;
                } elseif ($filteredKey === "LessonId") {
                    $LessonId = (int)$filteredValue;
                } else {
                    $QuestionIsCorrect = 0;
                    if (isset($data['Questions'][$filteredKey]['QuestionAnswer']) && $data['Questions'][$filteredKey]['QuestionAnswer'] === $filteredValue) {
                        $score += (int)$data['Questions'][$filteredKey]['QuestionPoints'];
                        $QuestionIsCorrect = 1;
                    }
                    $total += (int)$data['Questions'][$filteredKey]['QuestionPoints'];

                    $summary[] = [
                        'QuestionId' => $filteredKey,
                        'Question' => $data['Questions'][$filteredKey]['Question'],
                        'QuestionOption1' => $data['Questions'][$filteredKey]['QuestionOption1'],
                        'QuestionOption2' => $data['Questions'][$filteredKey]['QuestionOption2'],
                        'QuestionOption3' => $data['Questions'][$filteredKey]['QuestionOption3'],
                        'QuestionOption4' => $data['Questions'][$filteredKey]['QuestionOption4'],
                        'QuestionAnswer' => $value,
                        'QuestionPoints' => $data['Questions'][$filteredKey]['QuestionPoints'],
                        'QuestionIsCorrect' => $QuestionIsCorrect,
                        'QuestionImage' => $data['Questions'][$filteredKey]['QuestionImage']
                    ];
                }
            }

            $Id = $activityModel->createActivityResult([
                'ActivityId'=>$db->escape($ActivityId),
                'LessonId'=>$db->escape($LessonId),
                'AccountId'=>$db->escape($_SESSION['User_Id']),
                'Score'=>$db->escape($score),
                'Summary'=>json_encode($summary),
                'Total'=>$db->escape($total),
            ]);

            $activityModel->deleteActivityInProgress([
                'ActivityId'=>$db->escape($ActivityId),
                'LessonId'=>$db->escape($LessonId),
                'AccountId'=>$db->escape($_SESSION['User_Id']),
            ]);

            header('Location: '.BASE_URL.'?page=result&item='.$Id);
            exit;
        }
    }
}

?>