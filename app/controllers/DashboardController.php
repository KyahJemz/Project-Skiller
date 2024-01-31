<?php

require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../../config/Database.php';

class DashboardController {

    public function index() {
        $logger = new Logger();

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);

        $data['Chapters'] = $lessonModel->getChaptersOnly();
        $data['Lessons'] = $lessonModel->getLessonsOnly();

        $data['Progress'] = $progressModel->getAllMyProgress(['Account_Id'=>$_SESSION['User_Id']]);

        $data['User_Name'] = ucwords(strtolower($_SESSION['User_FirstName']));

        $data['title'] = "Welcome to Skiller: Tutorial System";
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/dashboard.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher(){
        $logger = new Logger();

        $data['User_Name'] = ucwords(strtolower($_SESSION['User_FirstName']));

        $data['title'] = "Welcome to Skiller: Tutorial System";
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/dashboard.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }
}
?>