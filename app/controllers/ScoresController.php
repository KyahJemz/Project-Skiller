<?php

require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/CoursesModel.php';
require_once __DIR__.'/../../config/Database.php';

class ScoresController {

    public function index($item = null, $course=null) {
        $logger = new Logger();

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);
        $lessonModel = new LessonModel($db, $logger);
        $coursesModel = new CoursesModel($db, $logger);

        $UserCourses = $coursesModel->getUserCourses(['Account_Id'=>$_SESSION['User_Id']]);
        $data['MyCourses'] = $UserCourses;
 
        $data['title'] = "Skiller - My Scores";

        $data['HasCourse'] = $course;

        if(empty($course)){
            include(__DIR__ . '/../views/headers/Default.php');
            include(__DIR__ . '/../views/headers/SignedIn.php');
            include(__DIR__ . '/../views/scores.php');
            include(__DIR__ . '/../views/footers/Default.php');
        } else {
            $data['Activities'] = $activityModel->getActivitiesResults(['Account_Id'=>$_SESSION['User_Id'], 'Course_Id'=>$course]);

            include(__DIR__ . '/../views/headers/Default.php');
            include(__DIR__ . '/../views/headers/SignedIn.php');
            include(__DIR__ . '/../views/scores.php');
            include(__DIR__ . '/../views/footers/Default.php');
        }
    }

    public function indexAdministrator($item = null, $course=null) {
        $logger = new Logger();
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);
        $accountModel = new AccountModel($db, $logger);
        $coursesModel = new CoursesModel($db, $logger);

        $UserCourses = $coursesModel->getUserCourses(['Account_Id'=>$item]);
        $data['MyCourses'] = $UserCourses;

        $data['HasCourse'] = $course;

        $data['Account'] = $accountModel->getAccountById(['Account_Id'=>$item]);
        
        $data['lastname'] = $data['Account'][0]['LastName'];

        $data['title'] = "Skiller - Scores";

        if(empty($course)){
            include(__DIR__ . '/../views/headers/Default.php');
            include(__DIR__ . '/../views/headers/SignedIn.php');
            include(__DIR__ . '/../views/scores.php');
            include(__DIR__ . '/../views/footers/Default.php');
        } else {
            
            $data['Activities'] = $activityModel->getActivitiesResults(['Account_Id'=>$item, 'Course_Id'=>$course]);

            include(__DIR__ . '/../views/headers/Default.php');
            include(__DIR__ . '/../views/headers/SignedIn.php');
            include(__DIR__ . '/../views/scores.php');
            include(__DIR__ . '/../views/footers/Default.php');
        }
    }
}

?>