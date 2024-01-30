<?php

require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../../config/Database.php';

class ScoresController {

    public function index($item = null) {
        $logger = new Logger();
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);

        $data['Activities'] = $activityModel->getActivitiesResults(['Account_Id'=>$_SESSION['User_Id']]);

        $data['title'] = "Skiller - My Scores";
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/scores.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }
}

?>