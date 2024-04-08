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
            $group = sanitizeInput(filter_var($data['Group'], FILTER_SANITIZE_NUMBER_INT));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $accountModel = new AccountModel($db, $logger);

            $isExist = $accountModel->getAccount([
                'Email'=>$email
            ]);

            if (empty($isExist)) {
                if($type ==="Teacher"){
                    $accountModel->addAccount([
                        'Email'=>$email,
                        'Role'=>'Teacher',
                        'Group'=>$group
                    ]);
                } elseif($type ==="Administrator"){
                    $accountModel->addAccount([
                        'Email'=>$email,
                        'Role'=>'Administrator',
                        'Group'=>null
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
            } else {
                echo json_encode(['success' => false]);
                http_response_code(400);
                exit();
            }
        }
    }
}
?>
