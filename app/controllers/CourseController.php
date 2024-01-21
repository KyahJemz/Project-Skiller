<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../../config/Database.php';

class CourseController {

    public function index() {
        $logger = new Logger();
        $data['title'] = "Skiller - Lessons";

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);

        // $accountData = $accountModel->getAccount(['Email'=>$decodedBody['email']]);

        $data['Chapters'] = $lessonModel->getChaptersOnly();
        $data['Lessons'] = $lessonModel->getLessonsOnly();
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/course.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }



    
}
?>