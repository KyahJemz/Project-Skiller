<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../../config/Database.php';

class StudentsController {

    public function indexTeacher() {
        $logger = new Logger();

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);
        $accountModel = new AccountModel($db, $logger);
        $lessonModel = new LessonModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);

        $students = $accountModel->getAccountByGroup(['Group' => $_SESSION['User_Group']]);
        $data['students'] = [];

        foreach ($students as $student) {
            $data['students'][] = [
                'student' => $student,
                'progress' => $progressModel->getAllMyProgress(['Account_Id' => $student['Id']])
            ];
        }

        $data['chapters'] = $lessonModel->getChaptersOnly();

        $data['groups'] = $accountModel->getGroups();

        $data['title'] = "Welcome to Skiller: My Students";

        // echo '<pre>'.print_r($data['students']).'</pre>';

        echo '<script>';
        echo 'const Students=`'.json_encode($data['students']).'`;';
        echo 'const Chapters=`'.json_encode($data['chapters']).'`;';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';

        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/students.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function actionTeacher($item = null){
        $logger = new Logger();
    
        $jsonPayload = file_get_contents("php://input");

        $data = json_decode($jsonPayload, true);

        if ($data === null) {
            http_response_code(400);
            exit;
        } else {
            if (!isset($data['Email']) || !isset($data['Group'])) {
                echo "Error: Required fields are missing in the JSON payload.";
                http_response_code(400);
                exit;
            }
            $email = sanitizeInput(filter_var($data['Email'], FILTER_SANITIZE_EMAIL));
            $group = sanitizeInput(filter_var($data['Group'], FILTER_SANITIZE_NUMBER_INT));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $accountModel = new AccountModel($db, $logger);

            $isExist = $accountModel->getAccount([
                'Email'=>$email
            ]);

            if (empty($isExist)) {
                $accountModel->addAccount([
                    'Email'=>$email,
                    'Role'=>'Student',
                    'Group'=>$group
                ]);

                Email::sendMail([
                    'ReceiverName' => 'New Account',
                    'ReceiverEmail' => $email,
                    'Message' => 'You can now login to Skiller: Tutorial System using this email, Thank you!'
                ]);

                echo json_encode(['success' => true]);
                http_response_code(200);
                exit();
            } else {
                echo json_encode(['success' => false]);
                http_response_code(400);
                exit();
            }
        }
    }

    public function actionAdministrator($item = null){
        $logger = new Logger();
    
        $jsonPayload = file_get_contents("php://input");

        $data = json_decode($jsonPayload, true);

        if ($data === null) {
            http_response_code(400);
            exit;
        } else {
            if (!isset($data['Email']) || !isset($data['Group'])) {
                echo "Error: Required fields are missing in the JSON payload.";
                http_response_code(400);
                exit;
            }
            $email = sanitizeInput(filter_var($data['Email'], FILTER_SANITIZE_EMAIL));
            $group = sanitizeInput(filter_var($data['Group'], FILTER_SANITIZE_NUMBER_INT));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $accountModel = new AccountModel($db, $logger);

            $isExist = $accountModel->getAccount([
                'Email'=>$email
            ]);

            if (empty($isExist)) {
                $accountModel->addAccount([
                    'Email'=>$email,
                    'Role'=>'Student',
                    'Group'=>$group
                ]);

                Email::sendMail([
                    'ReceiverName' => 'New Account',
                    'ReceiverEmail' => $email,
                    'Message' => 'You can now login to Skiller: Tutorial System using this email, Thank you!'
                ]);

                echo json_encode(['success' => true]);
                http_response_code(200);
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
