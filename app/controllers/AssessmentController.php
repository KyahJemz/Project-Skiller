<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../../config/Database.php';

class AssessmentController {

    public function index($item = null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);

        $data['Activity'] = $activityModel->getActivity(['ActivityId'=>$db->escape($item)]);
        if($data['Activity'] === []){
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        $rawQuestions = $activityModel->getActivityQuestions(['ActivityId'=>$db->escape($item)]);
        // if($rawQuestions === []){
        //     header('Location: '.BASE_URL.'?page=NotFound');
        //     exit;
        // }

        $data['Questions'] = [];
        $data['Answers'] = [];

        foreach ($rawQuestions as $value) {
            $data['Questions'][] = [
                'QuestionId' => $value['Id'],
                'Question' => $value['Question'],
                'QuestionOptions' => [
                    $value['Option1'],
                    $value['Option2'],
                    $value['Option3'],
                    $value['Option4'],
                ],
                'QuestionPoints' => $value['Points'],
                'QuestionImage' => $value['Image']
            ];
            $data['Answers'][] = "";
        }

        $data['Progress'] = $activityModel->getActivityHasProgress(['ActivityId'=>$db->escape($item), 'AccountId'=>$db->escape($_SESSION['User_Id'])]);
        if(!empty($data['Progress'] )) {
            $data['Questions'] = $data['Progress'][0]['ActivityQuestions'];
            $data['Answers'] = $data['Progress'][0]['ActivityAnswers'];
        }


        
        // echo '<pre>'; print_r($data['Activities']); echo '</pre>';
        // echo '<pre>'; print_r($data['Lessons']); echo '</pre>';

        $data['title'] = "Skiller - ".$data['Activity'][0]['ActivityTitle'];
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/assessment.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }


}

?>