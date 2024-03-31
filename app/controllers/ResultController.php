<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ProgressModel.php';
require_once __DIR__.'/../../config/Database.php';

class ResultController {

    public function index($item = null, $course=null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
        
        $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $activityModel = new ActivityModel($db, $logger);
        $lessonModel = new LessonModel($db, $logger);
        $accountModel = new AccountModel($db, $logger);

        $data['Course'] = $db->escape($course);

        $data['Result'] = $activityModel->getActivityResult(['ResultId'=>$db->escape($item)]);
        if($data['Result'] === []){
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }

        $data['PastAttempts'] = $activityModel->getActivityResults([
            'Activity_Id'=>$db->escape($data['Result'][0]['Activity_Id']),
            'Account_Id'=>$db->escape($data['Result'][0]['Account_Id'])
        ]);

        $data['Activity'] = $activityModel->getActivity(['ActivityId'=>$db->escape($data['Result'][0]['Activity_Id'])]);

        $data['Summary'] = json_decode($data['Result'][0]['Summary']);

        $data['Account'] = $accountModel->getAccountById(['Account_Id'=>$data['Result'][0]['Account_Id']]);

        $data['lastname'] = $data['Account'][0]['LastName'];

        $data['title'] = "Skiller - Assessment Result";

        print_r( $data['Result'][0]['Lesson_Id']);

        $data['LessonNextToAccess'] = end($_SESSION['AllowedLessons']);

        echo '<script>';
        echo 'const BASE_URL=`'.BASE_URL.'`;';
        echo '</script>';
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/result.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher($item = null, $course=null) {
        $this->index($item);
    }

    public function indexAdministrator($item = null, $course=null) {
        $this->index($item);
    }

    public function action($item = null, $course=null) {
        $logger = new Logger();

        if (empty($item)) {
            header('Location: '.BASE_URL.'?page=NotFound');
            exit;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!isset($_POST['ActivityId'])) {
                header('Location: '.BASE_URL.'?page=NotFound');
                exit;
            } 

            $ActivityId = null;
            $LessonId = null;
            $score = 0;
            $summary = [];
            $total = 0;

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $activityModel = new ActivityModel($db, $logger);
            $progressModel = new ProgressModel($db, $logger);
            $accountModel = new AccountModel($db, $logger);
            $lessonModel = new LessonModel($db, $logger);

            $Activity =  $activityModel->getActivity(['ActivityId'=>$db->escape($item)]);

            $ActivityHistory =  $activityModel->getActivity(['ActivityId'=>$db->escape($item)]);
            
            $rawQuestions = $activityModel->getActivityQuestions(['ActivityId'=>$db->escape($item)]);

            $data['Questions'] = [];

            foreach ($rawQuestions as $value) {
                $data['Questions'][$value['Id']] = [
                    'Question' => $value['Question'],
                    'QuestionOption1' => $value['Option1'],
                    'QuestionOption2' => $value['Option2'],
                    'QuestionOption3' => $value['Option3'],
                    'QuestionOption4' => $value['Option4'],
                    'QuestionAnswer' => $value['Answer'],
                    'QuestionPoints' => $value['Points'],
                    'QuestionImage' => $value['Image']
                ];
            }

            foreach ($_POST as $key => $value) {
                $filteredKey = sanitizeInput($key);
                $filteredValue = sanitizeInput($value);
            
                if ($filteredKey === "ActivityId") {
                    $ActivityId = (int)$filteredValue;
                } elseif ($filteredKey === "LessonId") {
                    $LessonId = (int)$filteredValue;
                } else {
                    $QuestionIsCorrect = 0;
                    if (isset($data['Questions'][$filteredKey]['QuestionAnswer']) && $data['Questions'][$filteredKey]['QuestionAnswer'] === $filteredValue) {
                        $score += (int)$data['Questions'][$filteredKey]['QuestionPoints'];
                        $QuestionIsCorrect = 1;
                    }
                    $total += (int)$data['Questions'][$filteredKey]['QuestionPoints'];

                    $summary[] = [
                        'QuestionId' => $filteredKey,
                        'Question' => $data['Questions'][$filteredKey]['Question'],
                        'QuestionOption1' => $data['Questions'][$filteredKey]['QuestionOption1'],
                        'QuestionOption2' => $data['Questions'][$filteredKey]['QuestionOption2'],
                        'QuestionOption3' => $data['Questions'][$filteredKey]['QuestionOption3'],
                        'QuestionOption4' => $data['Questions'][$filteredKey]['QuestionOption4'],
                        'QuestionAnswer' => $value,
                        'QuestionPoints' => $data['Questions'][$filteredKey]['QuestionPoints'],
                        'QuestionIsCorrect' => $QuestionIsCorrect,
                        'QuestionImage' => $data['Questions'][$filteredKey]['QuestionImage']
                    ];
                }
            }

            $Id = $activityModel->createActivityResult([
                'ActivityId'=>$db->escape($ActivityId),
                'LessonId'=>$db->escape($LessonId),
                'AccountId'=>$db->escape($_SESSION['User_Id']),
                'Score'=>$db->escape($score),
                'Summary'=>json_encode($summary),
                'Total'=>$db->escape($total),
            ]);

            $activityModel->deleteActivityInProgress([
                'ActivityId'=>$db->escape($ActivityId),
                'LessonId'=>$db->escape($LessonId),
                'AccountId'=>$db->escape($_SESSION['User_Id']),
            ]);

            if ((($score / $total) * 100) >= 75) { // passed
                $isNew = $progressModel->AddMyProgress([
                    'Lesson_Id'=>$db->escape($LessonId),
                    'Activity_Id'=>$db->escape($ActivityId),
                    'Account_Id'=>$db->escape($_SESSION['User_Id']),
                    'Course_Id'=>$db->escape($course)
                ]);
    
                $data['Progress'] = $progressModel->getAllMyProgress(['Account_Id'=>$_SESSION['User_Id']]);

                $ProgressPercentage =  number_format(((isset($data['Progress']['LessonProgress'][$LessonId]) ? $data['Progress']['LessonProgress'][$LessonId] : 0) / max($data['Progress']['LessonProgressTotal'][$LessonId], 1)) * 100, 2);
                if((int) $ProgressPercentage === 100) {
                    if((int)$isNew > 0) {
                        $accountModel->updateCurrentLesson();
                        $_SESSION['CurrentLesson'] = (int)$_SESSION['CurrentLesson'] + 1;
                        $ContentList = $lessonModel->getAllContents();
                        RefreshAccessibleContents($ContentList);
                    }
                }

                $logger->log('Sending assessment score to ' .$_SESSION['User_Email'], 'info');
                Email::sendMail([
                    'Subject' => 'Assessment Score - Passed',
                    'ReceiverName' => $_SESSION['User_FirstName'],
                    'ReceiverEmail' => $_SESSION['User_Email'],
                    'Message' => 'You have completed your assessment in '.$Activity[0]['ActivityTitle'].'. You have scored '.$score.' out of '.$total.', Thank you!'
                ]);
            } else { // failed
                $logger->log('Sending assessment score to ' .$_SESSION['User_Email'], 'info');
                Email::sendMail([
                    'Subject' => 'Assessment Score - Failed',
                    'ReceiverName' => $_SESSION['User_FirstName'],
                    'ReceiverEmail' => $_SESSION['User_Email'],
                    'Message' => 'You have failed your assessment in '.$Activity[0]['ActivityTitle'].'. You have scored '.$score.' out of '.$total.', The system already sent an request for retake to your teacher. you may now continue reviewing this lesson before proceeding to the next lesson, Good luck!'
                ]);

                $WholeGroup = $accountModel->getAccountByGroup([
                    'Group'=>$_SESSION['User_Group'],
                ]);

                $TeacherEmail = "";
                $TeacherName = "";

                foreach ($WholeGroup as $value) {
                    if($value['Role'] === 'Teacher'){
                        $TeacherEmail = $value['Email'];
                        $TeacherName = $value['FirstName'];
                    }
                }

                if (!empty($TeacherEmail) && !empty($TeacherName)){
                    Email::sendMail([
                        'Subject' => 'Assessment Retake Request',
                        'ReceiverName' => $TeacherName,
                        'ReceiverEmail' => $TeacherEmail,
                        'Message' => 'Your student named "'.$_SESSION['User_FirstName'].' '.$_aSESSION['User_LastName'].'" have failed assessment in '.$Activity[0]['ActivityTitle'].'. With a score of '.$score.' out of '.$total.'. You may let the student continue by enabling the retake option to give another chance.'
                    ]);
                }
            }

            header('Location: '.BASE_URL.'?page=result&item='.$Id);
            exit;
        }
    }

    public function actionTeacher($item = null, $course=null){
        $logger = new Logger();
    
        $jsonPayload = file_get_contents("php://input");

        $data = json_decode($jsonPayload, true);

        if ($data === null) {
            http_response_code(400);
            exit;
        } else {
            if (!isset($data['ToState']) || !isset($data['Id'])) {
                echo "Error: Required fields are missing in the JSON payload.";
                http_response_code(400);
                exit;
            }
            $ToState = sanitizeInput(filter_var($data['ToState'], FILTER_SANITIZE_STRING ));
            $Id = sanitizeInput(filter_var($data['Id'], FILTER_SANITIZE_NUMBER_INT));

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $activityModel = new ActivityModel($db, $logger);
            $accountModel = new AccountModel($db, $logger);

            $result = $activityModel->getActivityResult(['ResultId'=>$data['Id']]);

            $Account = $accountModel->getAccountById(['Account_Id'=>$result[0]['Account_Id']]);

            $activity = $activityModel->getActivityOnly(['Id'=>$result[0]['Activity_Id']]);

            if ($data['ToState'] === "Enable"){
                $activityModel->updateResultRetake([
                    'Value'=>'1',
                    'Id'=>$Id
                ]);
                Email::sendMail([
                    'Subject' => 'Assessment Retake Enabled',
                    'ReceiverName' => $Account[0]['FirstName'],
                    'ReceiverEmail' => $Account[0]['Email'],
                    'Message' => 'Your assessment in '.$activity[0]['Title'].' has retake now enabled. You can now retake your assessment, Thank you!'
                ]);
            } else {
                $activityModel->updateResultRetake([
                    'Value'=>'0',
                    'Id'=>$Id
                ]);
                Email::sendMail([
                    'Subject' => 'Assessment Retake Disabled',
                    'ReceiverName' => $Account[0]['FirstName'],
                    'ReceiverEmail' => $Account[0]['Email'],
                    'Message' => 'Your assessment in '.$activity[0]['Title'].' has retake now disabled. Retake is not possible, Thank you!'
                ]);
            }
            echo json_encode(['success' => true]);
            http_response_code(200);
            exit();
        }
    }
}

?>