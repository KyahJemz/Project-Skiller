<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../../config/Database.php';

class ActivityController {

    public function index($item = null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);

        $data['Activity'] = $activityModel->getActivity(['ActivityId'=>$db->escape($item)]);
        if($data['Activity'] === []){
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

    public function indexTeacher($item = null) {
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

    public function actionTeacher($item = null){
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

}

?>