<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../../config/Database.php';

class AccountsController {

    public function indexAdministrator($item = null, $course=null) {
        $logger = new Logger();

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $accountModel = new AccountModel($db, $logger);

        $accounts = $accountModel->getAccount([]);
        $data['students'] = [];
        $data['administrators'] = [];

        foreach ($accounts as $account) {
            switch ($account['Role']) {
                case 'Student':
                    $data['students'][] = [
                        'account' => $account,
                    ];
                    break;
                case 'Administrator':
                    $data['administrators'][] = [
                        'account' => $account,
                    ];
                    break;
                default:
                    break;
            }
        }

        $data['title'] = "Welcome to Skiller: My Students";

        echo '<script>';
        echo 'const Students=`'.json_encode($data['students']).'`;';
        echo 'const Administrators=`'.json_encode($data['administrators']).'`;';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';

        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/accounts.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function action($item = null, $course=null){
        $logger = new Logger();
    
        $jsonPayload = file_get_contents("php://input");

        $data = json_decode($jsonPayload, true);

        if ($data === null) {
            http_response_code(400);
            exit;
        } else {
            if (!isset($data['Email']) || !isset($data['FirstName']) || !isset($data['LastName'])) {
                echo "Error: Required fields are missing in the JSON payload.";
                http_response_code(400);
                exit;
            }
            $email = sanitizeInput(filter_var($data['Email'], FILTER_SANITIZE_EMAIL));
            $firstName = sanitizeInput(filter_var($data['FirstName'], FILTER_SANITIZE_STRING));
            $lastName = sanitizeInput(filter_var($data['LastName'], FILTER_SANITIZE_STRING));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $accountModel = new AccountModel($db, $logger);

            $isExist = $accountModel->getAccount([
                'Email'=>$email
            ]);

            if (empty($isExist)) {
                $accountModel->addAccount([
                    'LastName'=>$lastName,
                    'FirstName'=>$firstName,
                    'Email'=>$email,
                    'Role'=>'Student',
                ]);
                echo json_encode(['success' => true]);
                http_response_code(200);

                Email::sendMail([
                    'ReceiverName' => 'Account Registration',
                    'ReceiverEmail' => $email,
                    'Message' => 'Thank you for registering with the Skiller Tutorial System. We\'re delighted to have you on board!\n\nwe want to inform you that your registration is now under process. Our team is reviewing the information you provided, and we\'ll notify you once your account has been approved.'
                ]);

                exit();
            } else {
                echo json_encode(['success' => false]);
                http_response_code(400);
                exit();
            }
        }
    }

    public function actionAdministrator($item = null, $course=null){
        $logger = new Logger();
    
        $jsonPayload = file_get_contents("php://input");

        $data = json_decode($jsonPayload, true);

        if ($data === null) {
            http_response_code(400);
            exit;
        } else {
            if (!isset($data['Email']) || !isset($data['Type'])) {
                echo "Error: Required fields are missing in the JSON payload.";
                http_response_code(400);
                exit;
            }
            $email = sanitizeInput(filter_var($data['Email'], FILTER_SANITIZE_EMAIL));
            $type = sanitizeInput(filter_var($data['Type'], FILTER_SANITIZE_STRING));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $accountModel = new AccountModel($db, $logger);

            $isExist = $accountModel->getAccount([
                'Email'=>$email
            ]);

            if (empty($isExist)) {
                if($type ==="Student"){
                    $accountModel->addAccount([
                        'Email'=>$email,
                        'Role'=>'Student',
                    ]);
                } elseif($type ==="Administrator"){
                    $accountModel->addAccount([
                        'Email'=>$email,
                        'Role'=>'Administrator',
                    ]); 
                }
                echo json_encode(['success' => true]);
                http_response_code(200);

                Email::sendMail([
                    'ReceiverName' => 'New Account',
                    'ReceiverEmail' => $email,
                    'Message' => 'You can now login to Skiller: Tutorial System using this email as an '.$type.', Thank you!'
                ]);
                exit();

            } elseif ($type ==="Approval"){
                $accountModel->getAccount([
                    'Id'=>$isExist['Id'],
                    'IsApproved'=>1,
                ]); 
                echo json_encode(['success' => true]);
                http_response_code(200);

                Email::sendMail([
                    'ReceiverName' => 'Registration Approved',
                    'ReceiverEmail' => $email,
                    'Message' => 'You can now login to Skiller: Tutorial System using this email as an '.$type.', Thank you!'
                ]);
                exit();
            } else {
                echo json_encode(['success' => false]);
                http_response_code(400);
                exit();
            }
        }
    }
}
?>
