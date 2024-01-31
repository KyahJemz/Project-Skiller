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
}
?>
