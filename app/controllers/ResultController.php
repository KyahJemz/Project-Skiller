<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../../config/Database.php';

class ResultController {

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

        // echo '<pre>'; print_r($data['Activity']); echo '</pre>';

        // $data['Progress'] = $lessonModel->getLessonsOnly(); to follow to display ko muna



        $data['title'] = "Skiller - ".$data['Activity'][0]['ActivityTitle'];
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/activity.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function action() {
        $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
        $token = sanitizeInput($token);

        $decodedBody = null;
        
        $logger = new Logger();
    
      
    }


}

?>