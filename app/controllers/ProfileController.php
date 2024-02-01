<?php

require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../../config/Database.php';

class ProfileController {

    public function index($item = null) {
        $logger = new Logger();

        if ($_SESSION['User_Role'] === 'Student') {
            if ((int)$_SESSION['User_Id'] !== (int)$item){
                header("Location: ".BASE_URL.'?page=dashboard');
                exit;
            }
        }

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $accountModel = new AccountModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);
        $lessonModel = new LessonModel($db, $logger);

        $account = $accountModel->getAccountById(['Account_Id'=>$db->escape($item)]);

        if(empty($account)) {
            header("Location: ".BASE_URL.'?page=NotFound');
            exit;
        }

        $data['Chapters'] = $lessonModel->getChaptersOnly();
        $data['Progress'] = $progressModel->getAllMyProgress(['Account_Id'=>$db->escape($item)]);
        
        $data['id'] = $account[0]['Id'];
        $data['image'] = $account[0]['Image'];
        $data['name'] = $account[0]['LastName'].', '.$account[0]['FirstName'].' '.$account[0]['MiddleName'];
        $data['role'] = $account[0]['Role'];
        $data['group'] = $account[0]['Group'];
        $data['disabled'] = $account[0]['Disabled'];
        $data['email'] = $account[0]['Email'];

        $data['title'] = "Skiller: ".$account[0]['LastName'];

        echo '<script>';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/profile.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher($item = null){
        $this->index($item);
    }

    public function actionTeacher($item = null) {
        $logger = new Logger();
    
        $jsonPayload = file_get_contents("php://input");

        $data = json_decode($jsonPayload, true);

        if ($data === null) {
            http_response_code(400);
            exit;
        } else {
            if (!isset($data['Action']) || !isset($data['Id'])) {
                echo "Error: Required fields are missing in the JSON payload.";
                http_response_code(400);
                exit;
            }
            $Action = sanitizeInput(filter_var($data['Action'], FILTER_SANITIZE_STRING ));
            $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_NUMBER_INT));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            
            if($Action === "Reset") {
                $progressModel = new ProgressModel($db, $logger);
                $progressModel->ClearProgress(['Account_Id'=>$db->escape($Id)]);
                echo json_encode(['success' => true]);
                http_response_code(200);
                exit();
            } elseif ($Action === "Disabled") {
               if (!isset($data['CurrentState'])) {
                    echo "Error: Required fields are missing in the JSON payload.";
                    http_response_code(400);
                    exit;
                }
                $CurrentState = sanitizeInput(filter_var((int)$data['CurrentState'], FILTER_SANITIZE_NUMBER_INT ));
                $accountModel = new AccountModel($db, $logger);
                if ((int)$CurrentState === 0) {
                    $accountModel->updateAccount([
                        'Id' => $db->escape($Id),
                        'Disabled' => 1
                    ]);
                } else {
                    $accountModel->updateAccount([
                        'Id' => $db->escape($Id),
                        'Disabled' => 0
                    ]);
                }
                echo json_encode(['success' => true]);
                http_response_code(200);
                exit();
            } else {
                echo json_encode(['success' => true, 'message'=>'No Changes']);
                http_response_code(200);
                exit();
            }
        }
    }

}
?>
