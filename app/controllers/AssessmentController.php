<?php

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/ActivityModel.php';
require_once __DIR__.'/../../config/Database.php';

class AssessmentController {

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

        $rawQuestions = $activityModel->getActivityQuestions(['ActivityId'=>$db->escape($item)]);

        $data['Questions'] = [];
        $data['Answers'] = [];

        foreach ($rawQuestions as $value) {
            $data['Questions'][] = [
                'QuestionId' => $value['Id'],
                'Question' => $value['Question'],
                'QuestionOptions' => [
                    $value['Option1'],
                    $value['Option2'],
                    $value['Option3'],
                    $value['Option4'],
                ],
                'QuestionPoints' => $value['Points'],
                'QuestionImage' => $value['Image']
            ];
            $data['Answers'][] = "";
        }

        $data['Progress'] = $activityModel->getActivityHasProgress(['ActivityId'=>$db->escape($item), 'AccountId'=>$db->escape($_SESSION['User_Id'])]);
        if(!empty($data['Progress'] )) {
            $data['Questions'] = json_decode($data['Progress'][0]['ActivityQuestions'], true);
            $data['Answers'] = json_decode($data['Progress'][0]['ActivityAnswers'], true);
        }
        
        $data['title'] = "Skiller - ".$data['Activity'][0]['ActivityTitle'];
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/assessment.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher($item = null){
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

        $rawQuestions = $activityModel->getActivityQuestions(['ActivityId'=>$db->escape($item)]);

        $data['Questions'] = [];
        $data['Answers'] = [];

        foreach ($rawQuestions as $value) {
            $data['Questions'][] = [
                'QuestionId' => $value['Id'],
                'Question' => $value['Question'],
                'QuestionOptions' => [
                    $value['Option1'],
                    $value['Option2'],
                    $value['Option3'],
                    $value['Option4'],
                ],
                'QuestionPoints' => $value['Points'],
                'QuestionImage' => $value['Image'],
                'QuestionAnswer' => $value['Answer']
            ];
            $data['Answers'][] = $value['Answer'];
        }

        $data['title'] = "Skiller - ".$data['Activity'][0]['ActivityTitle'];

        if ($_SESSION['User_Role'] === "Administrator") {
            echo '<script>';
            echo 'const QuestionsList = `'. json_encode($data['Questions']) .'`;';
            echo 'const AnswersList=`'.json_encode($data['Answers']).'`;';
            echo 'const Activity_Id=`'.$item.'`;';
            echo 'const BASE_URL=`'.BASE_URL.'`;';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'const BASE_URL=`'.BASE_URL.'`;';
            echo '</script>';
        }

        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/assessment.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexAdministrator($item = null){
        $this->indexTeacher($item);
    }

    public function action($item = null) {
        $logger = new Logger();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (!isset($_POST['ActivityId'])) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid data or validation failed']);
                exit;
            } 

            $ActivityId = null;
            $LessonId = null;
            $Questions = [];
            $Answers = [];

            $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $activityModel = new ActivityModel($db, $logger);

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
                    $Questions[] = [
                        'QuestionId' => $filteredKey,
                        'Question' => $data['Questions'][$filteredKey]['Question'],
                        'QuestionOptions' => [
                            $data['Questions'][$filteredKey]['QuestionOption1'],
                            $data['Questions'][$filteredKey]['QuestionOption2'],
                            $data['Questions'][$filteredKey]['QuestionOption3'],
                            $data['Questions'][$filteredKey]['QuestionOption4'],
                        ],
                        'QuestionPoints' => $data['Questions'][$filteredKey]['QuestionPoints'],
                        'QuestionImage' => $data['Questions'][$filteredKey]['QuestionImage']
                    ];
                    $Answers[] = [$value];
                }
            }

            $activityModel->createActivityInProgress([
                'ActivityId'=>$db->escape($ActivityId),
                'LessonId'=>$db->escape($LessonId),
                'AccountId'=>$db->escape($_SESSION['User_Id']),
                'Questions'=>json_encode($Questions),
                'Answers'=>json_encode($Answers),
            ]);

            echo json_encode(['status' => 'success']);
        }
    }

    public function actionAdministrator($item = null) {
        $logger = new Logger();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $jsonPayload = file_get_contents("php://input");

            $data = json_decode($jsonPayload, true);

            if ($data === null) {
                http_response_code(400);
                exit;
            } else { 
                $Activity_Id = $data['Activity_Id'];
                $Questions = json_decode($data['Questions'], true);

                $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $activityModel = new ActivityModel($db, $logger);

                $Question_Ids_Result = $activityModel->getQuestionIds(['Activity_Id'=>$Activity_Id]);
                $Question_Ids = [];

                foreach ($Question_Ids_Result as $value) {
                    $Question_Ids[] =  $value['Id'];
                }  

                $actions = [];

                $db->begin_transaction();
                try {   
                    foreach ($Questions as $value) {
                        if(
                            !empty($value['Question']) && 
                            !empty($value['QuestionAnswer']) && 
                            !empty($value['QuestionOptions'][0]) && 
                            !empty($value['QuestionOptions'][1]) && 
                            !empty($value['QuestionOptions'][2]) && 
                            !empty($value['QuestionOptions'][3]) && 
                            !empty($value['QuestionPoints'])
                        ) {
                            if(substr($value['QuestionId'], 0, 1) === 'x'){
                                $actions[] = 'A'; 
                                $activityModel->addQuestion([
                                    'Activity_Id' => $Activity_Id,
                                    'Question' => $value['Question'],
                                    'Points' => $value['QuestionPoints'],
                                    'Option1' => $value['QuestionOptions'][0],
                                    'Option2' => $value['QuestionOptions'][1],
                                    'Option3' => $value['QuestionOptions'][2],
                                    'Option4' => $value['QuestionOptions'][3],
                                    'Answer' => $value['QuestionAnswer'],
                                ]);
                            } else {
                                $actions[] = 'U';
                                $activityModel->updateQuestion([
                                    'Id' => $value['QuestionId'],
                                    'Question' => $value['Question'],
                                    'Points' => $value['QuestionPoints'],
                                    'Option1' => $value['QuestionOptions'][0],
                                    'Option2' => $value['QuestionOptions'][1],
                                    'Option3' => $value['QuestionOptions'][2],
                                    'Option4' => $value['QuestionOptions'][3],
                                    'Answer' => $value['QuestionAnswer'],
                                ]);
                                $key = array_search($value['QuestionId'], $Question_Ids);
                                if ($key !== false) {
                                    unset($Question_Ids[$key]);
                                }
                            }
                        }
                    }

                    if(!empty($Question_Ids)){
                        $actions[] = 'R';
                        $activityModel->deactivateQuestion([
                            'Ids' => $Question_Ids
                        ]);
                    }
                    
                    $db->commit();
                } catch (Exception $e) {
                    $db->rollback();
                    $logger->log('Error deleting records: ' . $e->getMessage(), 'error');
                }

                echo json_encode(['status' => 'success', 'message' => '('.implode(',', $actions).')']);
            } 
        }
    }
}

?>