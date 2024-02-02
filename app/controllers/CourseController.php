<?php

require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../../config/Database.php';

class CourseController {

    public function index($item = null) {
        $logger = new Logger();
        $data['title'] = "Skiller - Course";

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);

        $data['Chapters'] = $lessonModel->getChaptersOnly();
        $data['Lessons'] = $lessonModel->getLessonsOnly();

        $data['Progress'] = $progressModel->getAllMyProgress(['Account_Id'=>$_SESSION['User_Id']]);
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/course.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher($item = null){
        $logger = new Logger();
        $data['title'] = "Skiller - Course";

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);

        $data['Chapters'] = $lessonModel->getChaptersOnly();
        $data['Lessons'] = $lessonModel->getLessonsOnly();
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/course.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }



    
}
?>