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

        $account = $accountModel->getAccountById(['Account_Id'=>$item]);

        if(empty($account)) {
            header("Location: ".BASE_URL.'?page=NotFound');
            exit;
        }

        $data['Chapters'] = $lessonModel->getChaptersOnly();
        $data['Progress'] = $progressModel->getAllMyProgress(['Account_Id'=>$item]);
        
        $data['image'] = $account[0]['Image'];
        $data['name'] = $account[0]['LastName'].', '.$account[0]['FirstName'].' '.$account[0]['MiddleName'];
        $data['role'] = $account[0]['Role'];
        $data['group'] = $account[0]['Group'];
        $data['email'] = $account[0]['Email'];

        $data['title'] = "Skiller: ".$account[0]['LastName'];
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/profile.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher($item = null){
        $this->index($item);
    }

}
?>
