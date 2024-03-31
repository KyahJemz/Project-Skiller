<?php

require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../models/CoursesModel.php';
require_once __DIR__.'/../../config/Database.php';

class CourseController {

    public function index($item = null, $course = null) {
        $logger = new Logger();
        $data['title'] = "Skiller - Course";

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);
        $coursesModel = new CoursesModel($db, $logger);

        $StudentCourses = $coursesModel->getUserCourses(['Account_Id'=>$_SESSION['User_Id'], 'Course_Id'=>$db->escape($item)]);
        $data['IsEnrolled'] = FALSE;
        foreach ($StudentCourses as $key => $value) {
            if((int)$value['Id'] === (int)$course){
                $data['IsEnrolled'] = TRUE;
            }
        }

        $data['Course'] = $coursesModel->getCourses(['Course_Id'=>$db->escape($item)])[0];
        $data['Chapters'] = $lessonModel->getChaptersOnly(['Course_Id'=>$db->escape($item)]);
        $data['Lessons'] = $lessonModel->getLessonsOnly(['Course_Id'=>$db->escape($item)]);

        $data['Progress'] = $progressModel->getAllMyProgress(['Account_Id'=>$_SESSION['User_Id'], 'Course_Id'=>$db->escape($item)]);
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/course.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexAdministrator($item = null, $course=null){
        $logger = new Logger();
        $data['title'] = "Skiller - Chapters Management";

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);

        $data['Chapters'] = $lessonModel->getChaptersOnly();
        $data['Lessons'] = $lessonModel->getLessonsOnly();

        echo '<script>';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/ChaptersManagement.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function action($item = null, $course=null){
        $logger = new Logger();

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $coursesModel = new CoursesModel($db, $logger);
        $lessonModel = new LessonModel($db, $logger);

        $coursesModel->enrollStudentHere(['Account_Id'=>$_SESSION['User_Id'], 'Course_Id'=>$db->escape($item)]);

        $MyCourses = $coursesModel->getChapterProgress(['Account_Id'=>$_SESSION['User_Id']]);
        $CurrentLessons = [];
        foreach ($MyCourses as $key => $value) {
            $CurrentLessons[$value['Course_Id']] = (int)$value['Progress'];
        };
        createCurrentLessons([
            'CurrentLesson' => $CurrentLessons
        ]);
        $ContentList = $lessonModel->getAllContents();
        RefreshAccessibleContents($ContentList);

        header('Location: '.BASE_URL.'?page=course&item='.$item.'&course='.$item);
        exit;
    }

    public function actionAdministrator($item = null, $course=null){
        $logger = new Logger();

        $jsonPayload = file_get_contents("php://input");

        $data = json_decode($jsonPayload, true);

        if ($data === null) {
            http_response_code(400);
            exit;
        } else {
            if (!isset($data['Type'])) {
                echo "Error: Required fields are missing in the JSON payload.";
                http_response_code(400);
                exit;
            }
            $Type = sanitizeInput(filter_var($data['Type'], FILTER_SANITIZE_STRING));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $lessonModel = new LessonModel($db, $logger);

            switch ($Type) {
                case 'Add':
                    if (!isset($data['Title'])) {
                        echo "Error: Required fields are missing in the JSON payload.";
                        http_response_code(400);
                        exit;
                    }
                    $Codes = sanitizeInput(filter_var($data['Codes'], FILTER_SANITIZE_STRING));
                    $Title = sanitizeInput(filter_var($data['Title'], FILTER_SANITIZE_STRING));

                    $lessonModel->addChapterOnly([
                        'Codes'=>$db->escape($Codes),
                        'Title'=>$db->escape($Title),
                    ]);
                    echo json_encode(['Success' => true]);
                    break;

                case 'Edit':
                    if (!isset($data['Title'])) {
                        echo "Error: Required fields are missing in the JSON payload.";
                        http_response_code(400);
                        exit;
                    }
                    $Codes = sanitizeInput(filter_var($data['Codes'], FILTER_SANITIZE_STRING));
                    $Title = sanitizeInput(filter_var($data['Title'], FILTER_SANITIZE_STRING));
                    $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_STRING));

                    $lessonModel->updateChapterOnly([
                        'Id'=>$db->escape($Id),
                        'Codes'=>$db->escape($Codes),
                        'Title'=>$db->escape($Title),
                    ]);
                    echo json_encode(['Success' => true]);
                    break;

                case 'Delete':
                    if (!isset($data['Id'])) {
                        echo "Error: Required fields are missing in the JSON payload.";
                        http_response_code(400); 
                        exit;
                    }
                    $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_STRING));

                    $lessonModel->deleteChapter([
                        'Id'=>$db->escape($Id)
                    ]);
                    echo json_encode(['Success' => true]);
                    break;

                case 'Read':
                    if (!isset($data['Id'])) {
                        echo "Error: Required fields are missing in the JSON payload.";
                        http_response_code(400); 
                        exit;
                    }
                    $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_STRING));
                    $Parameters = $lessonModel->getChapterOnly(['Id'=>$db->escape($Id)]);
                    echo json_encode(['Success' => true, 'Parameters'=> $Parameters]);
                    break;
                
                default:
                    echo "Error: Type is not recognized!";
                    http_response_code(400);
                    exit();
                    break;
            }
            http_response_code(200);
            exit();
        }
    }


}
?>