<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
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

        $data['Lessons'] = $lessonModel->getLessonFull(['LessonId'=>$db->escape($item)]);
        if($data['Lessons'] === []){
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        $data['Activities'] = $activityModel->getLessonActivities(['LessonId'=>$db->escape($item)]);

        // echo '<pre>'; print_r($data['Activities']); echo '</pre>';
        // echo '<pre>'; print_r($data['Lessons']); echo '</pre>';

        // $data['Progress'] = $lessonModel->getLessonsOnly(); to follow to display ko muna



        $data['title'] = "Skiller - ".$data['Lessons'][0]['LessonTitle'];
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/lessons.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }


}

?>