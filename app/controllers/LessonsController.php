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

        if(CheckLesson($item)){
            
        } else {
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

    public function indexTeacher($item = null){
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

        $data['title'] = "Skiller - ".$data['Lessons'][0]['LessonTitle'];

        echo '<script>';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/lessons.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexAdministrator($item = null){
        $this->indexTeacher($item);
    }

    public function actionAdministrator($item = null){
        $logger = new Logger();

        if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
            $jsonPayload = file_get_contents("php://input");
            $data = json_decode($jsonPayload, true);
        } else {
            $data = $_POST;
        }

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
                    if (!isset($data['ChapterId']) || !isset($data['Title']) || !isset($data['Objective']) || !isset($data['Description'])) {
                        echo "Error: Required fields are missing in the JSON payload.";
                        http_response_code(400);
                        exit;
                    }
                    $Title = sanitizeInput(filter_var($data['Title'], FILTER_SANITIZE_STRING));
                    $Objective = filter_var($data['Objective'], FILTER_SANITIZE_STRING);
                    $Description = filter_var($data['Description'], FILTER_SANITIZE_STRING);
                    $Image = "";
                    $Video = $data['Video'];
                    $Content = filter_var($data['Content'], FILTER_SANITIZE_STRING);
                    $ChapterId = sanitizeInput(filter_var($data['ChapterId'], FILTER_SANITIZE_STRING));

                    if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
                        $tempFile = $_FILES['Image']['tmp_name'];
                        $targetPath = './images/uploads/'; 
                        $targetFile = $targetPath . basename($_FILES['Image']['name']);
                
                        if (move_uploaded_file($tempFile, $targetFile)) {
                            $Image = $targetFile;
                        } else {
                            $logger->log('FILE FAILED: '. $$targetFile, 'error');
                            echo "Error: Failed to upload the image.";
                            http_response_code(500); 
                            exit;
                        }
                    }

                    $lessonModel->addLessonOnly([
                        'Title'=>$db->escape($Title),
                        'Objective'=>$Objective,
                        'Description'=>$Description,
                        'Image'=>$Image,
                        'Video'=>$Video,
                        'Content'=>$Content,
                        'Chapter_Id'=>$db->escape($ChapterId),
                    ]);
                    echo json_encode(['Success' => true]);
                    break;

                case 'Edit':
                    if (!isset($data['Id']) ||!isset($data['Title']) || !isset($data['Objective']) || !isset($data['Description'])) {
                        echo "Error: Required fields are missing in the JSON payload.";
                        http_response_code(400);
                        exit;
                    }

                    $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_STRING));
                    $Title = sanitizeInput(filter_var($data['Title'], FILTER_SANITIZE_STRING));
                    $Objective = filter_var($data['Objective'], FILTER_SANITIZE_STRING);
                    $Description = filter_var($data['Description'], FILTER_SANITIZE_STRING);
                    $Image = "";
                    $Video = $data['Video'];
                    $Content = filter_var($data['Content'], FILTER_SANITIZE_STRING);

                    if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
                        $tempFile = $_FILES['Image']['tmp_name'];
                        $targetPath = './images/uploads/'; 
                        $targetFile = $targetPath . basename($_FILES['Image']['name']);
                
                        if (move_uploaded_file($tempFile, $targetFile)) {
                            $Image = $targetFile;
                        } else {
                            $logger->log('FILE FAILED: '. $$targetFile, 'error');
                            echo "Error: Failed to upload the image.";
                            http_response_code(500); 
                            exit;
                        }
                    }

                    $lessonModel->updateLessonOnly([
                        'Id'=>$db->escape($Id),
                        'Title'=>$db->escape($Title),
                        'Objective'=>$Objective,
                        'Description'=>$Description,
                        'Image'=>$Image,
                        'Video'=>$Video,
                        'Content'=>$Content,
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

                    $lessonModel->deleteLesson([
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
                    $Parameters = $lessonModel->getLessonOnly(['Id'=>$db->escape($Id)]);
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