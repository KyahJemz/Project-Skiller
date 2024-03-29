<?php
use GuzzleHttp\Client;

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../../config/Database.php';

class LoginController {

    private $Error;

    public function index() {
        $logger = new Logger();

        if(isLoggedIn()){
            header("Location: ".BASE_URL."?page=dashboard");
            exit;
        }

        $data['title'] = "Login";
        if($this->Error) {
            $data['error'] = $this->Error;
        }
        echo '<script>const BASE_URL = "'.BASE_URL.'"</script>';

        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/login.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher() {
        $this->index();
    }

    public function indexAdministrator() {
        $this->index();
    }

    public function action($item = null) {
        $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
        $token = sanitizeInput($token);
        $client = new Client();
        $decodedBody = null;
        
        $logger = new Logger();
    
        try {
            $response = $client->post('https://www.googleapis.com/oauth2/v3/tokeninfo', [
                'form_params' => ['id_token' => $token]
            ]);
    
            $body = $response->getBody()->getContents();
            $decodedBody = json_decode($body, true);
    
            $logger->log('Successfully validated Google Sign-In token', 'info');
        } catch (Exception $e) {
            $logger->log('Error validating Google Sign-In token: ' . $e->getMessage(), 'error');
        } finally {
            if ($decodedBody && $decodedBody['email_verified'] === "true") {

                $db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $accountModel = new AccountModel($db, $logger);


                $accountData = $accountModel->getAccount(['Email'=>$decodedBody['email']]);
                if ($accountData === []){
                    $this->Error = "Login Failed, Account not registered!";
                    $this->index();
                } else {
                    if($accountData[0]['Disabled'] === 0){
                        createSession([
                            'User_Id' => $accountData[0]['Id'],
                            'User_Email' => $decodedBody['email'],
                            'User_Image' => $decodedBody['picture'],
                            'User_FirstName' => $decodedBody['given_name'],
                            'User_MiddleName' => "",
                            'User_LastName' => $decodedBody['family_name'],
                            'User_Group' => $accountData[0]['Group'],
                            'User_Role' => $accountData[0]['Role'],
                            'CurrentLesson' => $accountData[0]['CurrentLesson']
                        ]);
                        $accountData = $accountModel->updateAccount([
                            'Id'=>$accountData[0]['Id'],
                            'Image' => $decodedBody['picture'],
                            'FirstName' => $decodedBody['given_name'],
                            'LastName' => $decodedBody['family_name'],
                        ]);
                        if ($_SESSION['User_Role'] === 'Student'){
                            $lessonModel = new LessonModel($db, $logger);
                            $ContentList = $lessonModel->getAllContents();
                            RefreshAccessibleContents($ContentList);
                        }
                        $user_agent = $_SERVER['HTTP_USER_AGENT'];
                        $is_mobile = (bool)preg_match('/Mobile|iP(hone|od|ad)|Android|BlackBerry|IEMobile/', $user_agent);
                        $device_type = $is_mobile ? 'Mobile' : 'Web';

                        $ip_address = $_SERVER['REMOTE_ADDR'];
                        date_default_timezone_set('Asia/Manila');
                        $timestamp = strtotime(date('Y-m-d H:i:s'));
                        $timestamp_human_readable = date('F j, Y, g:i a', $timestamp);

                        Email::sendMail([
                            'Subject' => 'Skiller - Login Alert',
                            'ReceiverName' => $_SESSION['User_FirstName'] . " " .$_SESSION['User_LastName'],
                            'ReceiverEmail' => $_SESSION['User_Email'],
                            'Header' => 'Hi '.$_SESSION['User_FirstName'].',',
                            'Message' => '
                                    <p>Your Skiller Account was just signed in from a device</p>
                                    <ul>
                                        <li>Date -> '.$timestamp_human_readable.'</li>
                                        <li>Platform -> '.$user_agent.'</li>
                                        <li>Device -> '.$device_type.'</li>
                                        <li>Ip Address -> '.$ip_address.'</li>
                                    </ul>
                                    <p>If this was you, then you don\'t have to do anything.</p>
                                    <p>If you don\'t recognize this activity, please change your Google Account Password.</p>',
                            'Footer' => '',
                        ]);
                        header("Location: ".BASE_URL."?page=dashboard");
                    } else {
                        $this->Error = "Login Failed, Account disabled!";
                        $this->index();
                    }
                }
            } else {
                $this->Error = "Email verification failed, try again!";
                $this->index();
            }
        }
    }
}
?>
