<?php

require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../models/CoursesModel.php';
require_once __DIR__.'/../../config/Database.php';

class DashboardController {

    public function index($item=null, $course=null) {
        $logger = new Logger();

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $coursesModel = new CoursesModel($db, $logger);
        $lessonModel = new LessonModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);

        $UserCourses = $coursesModel->getUserCourses(['Account_Id'=>$_SESSION['User_Id']]);
        $OtherCourses = $coursesModel->getUserOtherCourses(['Account_Id'=>$_SESSION['User_Id']]);

        $data['MyCourses'] = [];
        $data['OtherCourses'] = [];

        foreach ($UserCourses as $key => $value) {
            $data['MyCourses'][] = [
                'Progress'=>$progressModel->getAllMyProgress(['Account_Id'=>$_SESSION['User_Id'], 'Course_Id'=>$value['Id']]), 
                'Details'=>$value,
                'Chapters'=>$lessonModel->getChaptersOnly(['Course_Id'=>$value['Id']])
            ];
        }

        foreach ($OtherCourses as $key => $value) {
            $data['OtherCourses'][] = [
                'Progress'=>null, 
                'Details'=>$value,
                'Chapters'=>$lessonModel->getChaptersOnly(['Course_Id'=>$value['Id']])
            ];
        }

        $data['User_Name'] = ucwords(strtolower($_SESSION['User_FirstName']));

        $data['title'] = "Welcome to Skiller: Tutorial System";

        echo '<script>';
        echo 'const OtherCourses = `'. json_encode($data['OtherCourses']) .'`;';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/dashboard.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexAdministrator($item=null, $course=null){
        $logger = new Logger();

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $coursesModel = new CoursesModel($db, $logger);
        $lessonModel = new LessonModel($db, $logger);

        $data['User_Name'] = ucwords(strtolower($_SESSION['User_FirstName']));

        $OtherCourses = $coursesModel->getUserOtherCourses(['Account_Id'=>$_SESSION['User_Id']]);
        $data['OtherCourses'] = [];

        foreach ($OtherCourses as $key => $value) {
            $data['OtherCourses'][] = [
                'Progress'=>null, 
                'Details'=>$value,
                'Chapters'=>$lessonModel->getChaptersOnly(['Course_Id'=>$value['Id']])
            ];
        }

        $data['title'] = "Welcome to Skiller: Tutorial System";

        echo '<script>';
        echo 'const OtherCourses = `'. json_encode($data['OtherCourses']) .'`;';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/dashboard.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }
}
?>