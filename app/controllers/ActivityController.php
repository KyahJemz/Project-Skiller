<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../../config/Database.php';

class ActivityController {

    public function index($item = null, $course=null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);

        $data['Course'] = $db->escape($course);

        $data['Activity'] = $activityModel->getActivity(['ActivityId'=>$db->escape($item)]);
        if($data['Activity'] === []){
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        if(CheckLesson($data['Activity'][0]['LessonId'])){
            
        } else {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        $data['Progress'] = $activityModel->getActivityHasProgress(['ActivityId'=>$db->escape($item), 'AccountId'=>$db->escape($_SESSION['User_Id'])]);

        $data['Result'] = $activityModel->getActivityResultFromActivityId(['ActivityId'=>$db->escape($item), 'AccountId'=>$db->escape($_SESSION['User_Id'])]);
        
        $data['CanTake'] = false;

        if (!empty($data['Progress'])) {
            $data['CanTake'] = true;
        } else {
            $data['CanTake'] = false;
            if (!empty($data['Result'])) {
                $lastResult = end($data['Result']);
                $lastResultValue = $lastResult['IsRetake'];

                if ((int)$lastResultValue === 1) {
                    $data['CanTake'] = true;
                }
            } else {
                $data['CanTake'] = true;
            }
        }

        $data['title'] = "Skiller - ".$data['Activity'][0]['ActivityTitle'];
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/activity.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher($item = null, $course=null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);

        $data['Result'] = $activityModel->getActivityResult(['ResultId'=>$db->escape($item)]);
        if($data['Result'] === []){
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
    }

    public function indexAdministrator($item = null, $course=null) {
        $this->index($item);
    }

    public function actionTeacher($item = null, $course=null){
        $logger = new Logger();
    
        $jsonPayload = file_get_contents("php://input");

        $data = json_decode($jsonPayload, true);

        if ($data === null) {
            http_response_code(400);
            exit;
        } else {
            if (!isset($data['ToState']) || !isset($data['Id'])) {
                echo "Error: Required fields are missing in the JSON payload.";
                http_response_code(400);
                exit;
            }
            $ToState = sanitizeInput(filter_var($data['ToState'], FILTER_SANITIZE_NUMBER_INT ));
            $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_NUMBER_INT));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            
            $activityModel = new ActivityModel($db, $logger);
            $activityModel->updateActivityViewResults([
                'Id' => $db->escape($Id),
                'ToState' => $db->escape($ToState)
            ]);

            echo json_encode(['success' => true]);
            http_response_code(200);
            exit();
            
        }
    }

    public function actionAdministrator($item = null, $course=null){
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
            $activityModel = new ActivityModel($db, $logger);

            switch ($Type) {
                case 'updateCanViewResultState':
                    if (!isset($data['ToState']) || !isset($data['Id'])) {
                        echo "Error: Required fields are missing in the JSON payload.";
                        http_response_code(400);
                        exit;
                    }
                    $ToState = sanitizeInput(filter_var($data['ToState'], FILTER_SANITIZE_NUMBER_INT ));
                    $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_NUMBER_INT));
        
                    $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    
                    $activityModel = new ActivityModel($db, $logger);
                    $activityModel->updateActivityViewResults([
                        'Id' => $db->escape($Id),
                        'ToState' => $db->escape($ToState)
                    ]);
        
                    echo json_encode(['success' => true]);
                    break;
                case 'Add':
                    if (!isset($data['LessonId']) || !isset($data['Title']) || !isset($data['Description'])) {
                        echo "Error: Required fields are missing in the JSON payload.";
                        http_response_code(400);
                        exit;
                    }
                    $Title = sanitizeInput(filter_var($data['Title'], FILTER_SANITIZE_STRING));
                    $Notes = filter_var($data['Notes'], FILTER_SANITIZE_STRING);
                    $Description = filter_var($data['Description'], FILTER_SANITIZE_STRING);
                    $IsViewSummary = filter_var($data['CanViewSummary'], FILTER_SANITIZE_STRING);
                    $LessonId = sanitizeInput(filter_var($data['LessonId'], FILTER_SANITIZE_STRING));

                    $activityModel->addActivityOnly([
                        'Title'=>$Title,
                        'Notes'=>$Notes,
                        'Description'=>$Description,
                        'IsViewSummary'=>$db->escape($IsViewSummary),
                        'Lesson_Id'=>$db->escape($LessonId),
                    ]);
                    echo json_encode(['Success' => true]);
                    break;

                case 'Edit':
                    if (!isset($data['Id']) ||!isset($data['Title']) || !isset($data['Description'])) {
                        echo "Error: Required fields are missing in the JSON payload.";
                        http_response_code(400);
                        exit;
                    }

                    $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_STRING));
                    $Title = sanitizeInput(filter_var($data['Title'], FILTER_SANITIZE_STRING));
                    $Notes = filter_var($data['Notes'], FILTER_SANITIZE_STRING);
                    $Description = filter_var($data['Description'], FILTER_SANITIZE_STRING);
                    $IsViewSummary = filter_var($data['IsViewSummary'], FILTER_SANITIZE_STRING);

                    $activityModel->updateActivityOnly([
                        'Id'=>$db->escape($Id),
                        'Title'=>$db->escape($Title),
                        'Notes'=>$Notes,
                        'Description'=>$Description,
                        'IsViewSummary'=>$IsViewSummary,
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
                    
                    $activityModel->deleteActivity([
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
                    $Parameters = $activityModel->getActivityOnly(['Id'=>$db->escape($Id)]);
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