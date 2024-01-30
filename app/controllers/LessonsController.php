<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../../config/Database.php';

class LessonsController {

    public function index($item = null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);
        $activityModel = new ActivityModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);

        $data['Lessons'] = $lessonModel->getLessonFull(['LessonId'=>$db->escape($item)]);
        if($data['Lessons'] === []){
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        $data['Activities'] = $activityModel->getLessonActivities(['LessonId'=>$db->escape($item)]);

        $progressModel->AddMyProgress([
            'Lesson_Id'=>$db->escape($item),
            'Activity_Id'=>"0",
            'Account_Id'=>$db->escape($_SESSION['User_Id'])
        ]);

        $data['Progress'] = $progressModel->getAllMyProgress(['Account_Id'=>$_SESSION['User_Id']]);

        $data['title'] = "Skiller - ".$data['Lessons'][0]['LessonTitle'];
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/lessons.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }
}

?>