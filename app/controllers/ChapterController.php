<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../../config/Database.php';

class ChapterController {

    public function index($item = null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $lessonModel = new LessonModel($db, $logger);

        $data['Chapter'] = $lessonModel->getChapterFull(['ChapterId'=>$db->escape($item)]);
        if($data['Chapter'] === []){
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        $data['title'] = "Skiller - Course";
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/chapter.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }



    
}
?>