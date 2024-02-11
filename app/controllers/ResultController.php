<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
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

        $data['PastAttempts'] = $activityModel->getActivityResults([
            'Activity_Id'=>$db->escape($data['Result'][0]['Activity_Id']),
            'Account_Id'=>$db->escape($data['Result'][0]['Account_Id'])
        ]);

        $data['Activity'] = $activityModel->getActivity(['ActivityId'=>$db->escape($data['Result'][0]['Activity_Id'])]);

        $data['Summary'] = json_decode($data['Result'][0]['Summary']);

        $data['title'] = "Skiller - Assessment Result";

        echo '<script>';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/result.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher($item = null) {
        $this->index($item);
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
            $progressModel = new ProgressModel($db, $logger);


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

            $progressModel->AddMyProgress([
                'Lesson_Id'=>$db->escape($LessonId),
                'Activity_Id'=>$db->escape($ActivityId),
                'Account_Id'=>$db->escape($_SESSION['User_Id'])
            ]);

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

            $logger->log('Sending assessment score to ' .$Activity[0]['Email'], 'info');
            Email::sendMail([
                'Subject' => 'Assessment Score',
                'ReceiverName' => $Activity[0]['FirstName'],
                'ReceiverEmail' => $Activity[0]['Email'],
                'Message' => 'You have completed your assessment in '.$Activity[0]['ActivityTitle'].'. You have scored '.$score.' out of '.$total.', Thank you!'
            ]);

            header('Location: '.BASE_URL.'?page=result&item='.$Id);
            exit;
        }
    }

    public function actionTeacher($item = null){
        $logger = new Logger();
    
        $jsonPayload = file_get_contents("php://input");

        $data = json_decode($jsonPayload, true);

        if ($data === null) {
            http_response_code(400);
            exit;
        } else {
            if (!isset($data['ToState']) || !isset($data['Id'])) {
                echo "Error: Required fields are missing in the JSON payload.";
                http_response_code(400);
                exit;
            }
            $ToState = sanitizeInput(filter_var($data['ToState'], FILTER_SANITIZE_STRING ));
            $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_NUMBER_INT));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $activityModel = new ActivityModel($db, $logger);
            $Account = $activityModel

            if ($data['ToState'] === "Enable"){
                $activityModel->updateResultRetake([
                    'Value'=>'1',
                    'Id'=>$Id
                ]);
                Email::sendMail([
                    'Subject' => 'Assessment Retake Enabled',
                    'ReceiverName' => $Account[0]['FirstName'],
                    'ReceiverEmail' => $Account[0]['Email'],
                    'Message' => 'Your assessment in '.$Account[0]['Title'].' has retake now enabled. You can now retake your assessment, Thank you!'
                ]);
            } else {
                $activityModel->updateResultRetake([
                    'Value'=>'0',
                    'Id'=>$Id
                ]);
                Email::sendMail([
                    'Subject' => 'Assessment Retake Disabled',
                    'ReceiverName' => $Account[0]['FirstName'],
                    'ReceiverEmail' => $Account[0]['Email'],
                    'Message' => 'Your assessment in '.$Account[0]['Title'].' has retake now disabled. Retake is not possible, Thank you!'
                ]);
            }
            echo json_encode(['success' => true]);
            http_response_code(200);
            exit();
        }
    }

}

?>