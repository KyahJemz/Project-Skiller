<?php

require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../../config/Database.php';

class CertificateController {

    public function index($item = null) {
        $logger = new Logger();
        $data['title'] = "Skiller - Certificate";

        if (empty($item)) {
            // $logger->log("## empty ITEM ", 'info');
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        if ($_SESSION['User_Role'] === "Student") {
            // $logger->log("## ROLE ITEM ", 'info');
            if ((int)$_SESSION['User_Id'] !== (int)$item) {
                // $logger->log("## empty NO ROLE ", 'info');
                header('Location: '.BASE_URL.'?page=NotFound');
                exit;
            }
        }

        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);
        $progressModel = new ProgressModel($db, $logger);
        $accountModel = new AccountModel($db, $logger);

        $data['Chapters'] = $lessonModel->getChaptersOnly();
        $data['Lessons'] = $lessonModel->getLessonsOnly();

        $data['Progress'] = $progressModel->getAllMyProgress(['Account_Id'=>$item]);

        $data['Account'] = $accountModel->getAccountById(['Account_Id'=>$item]);

        $Percentage = number_format(((isset($data['Progress']['FullProgress']) ? $data['Progress']['FullProgress'] : 0) / max($data['Progress']['FullProgressTotal'], 1)) * 100, 2);

        if ((int)$Percentage === 100){
            $filename = __DIR__.'./../../public/certificates/certificate_'.$item.'.pdf';
            // $logger->log("FINDING::: ".$filename, 'info');
            if (file_exists($filename)) {
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . basename($filename) . '"');
                header('Content-Length: ' . filesize($filename));
                readfile($filename);
                exit;
            } else {
                // $logger->log("NOT FOUND::: ".$filename, 'info');
                Email::sendMail([
                    'Subject' => 'Certificate Of Completion',
                    'ReceiverName' => $data['Account'][0]['FirstName'] . ' ' . $data['Account'][0]['LastName'],
                    'ReceiverEmail' => $data['Account'][0]['Email'],
                    'Message' => 'Congratulations! ,You have completed your course. You can now view your certificate in your portal, Thank you!'
                ]);
                PDF::createPdf(['certName'=>$data['Account'][0]['FirstName'] . ' ' . $data['Account'][0]['LastName'], 'certId'=>$data['Account'][0]['Id']]);
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . basename($filename) . '"');
                header('Content-Length: ' . filesize($filename));
                readfile($filename);
            }
        } else {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
    }
}
?>