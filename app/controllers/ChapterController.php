<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../models/CoursesModel.php';
require_once __DIR__.'/../../config/Database.php';

class ChapterController {

    public function index($item = null, $course = null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);
        $coursesModel = new CoursesModel($db, $logger);

        $data['Course'] = $db->escape($course);
        $data['CourseDetails'] = $coursesModel->getCourses(['Course_Id'=>$db->escape($course)])[0];

        $data['Chapter'] = $lessonModel->getChapterFull(['ChapterId'=>$db->escape($item), 'Course_Id'=>$db->escape($course)]);
        if($data['Chapter'] === []){
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        $data['Progress'] = $progressModel->getAllMyProgress(['Account_Id'=>$_SESSION['User_Id'], 'Course_Id'=>$db->escape($course)]);

        $data['ChapterRaw'] = $lessonModel->getChapter(['ChapterId'=>$db->escape($item), 'Course_Id'=>$db->escape($course)]);

        $data['title'] = "Skiller - Course";
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/chapter.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexAdministrator($item = null, $course=null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);
        $coursesModel = new CoursesModel($db, $logger);

        $data['Course'] = $db->escape($course);
        $data['CourseDetails'] = $coursesModel->getCourses(['Course_Id'=>$db->escape($course)])[0];

        $data['Chapter'] = $lessonModel->getChapterFull(['ChapterId'=>$db->escape($item)]);

        $data['ChapterRaw'] = $lessonModel->getChapter(['ChapterId'=>$db->escape($item)]);

        $data['title'] = "Skiller - Lessons Management";

        echo '<script>';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/lessonsManagement.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }



    
}
?>