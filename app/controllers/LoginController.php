<?php
use GuzzleHttp\Client;

require_once __DIR__.'/../models/AccountModel.php';
require_once __DIR__.'/../../config/Database.php';

class LoginController {

    private $Error;

    public function index() {
        $logger = new Logger();

        $data['title'] = "Login";
        if($this->Error) {
            $data['error'] = $this->Error;
        }
        echo '<script>const BASE_URL = "'.BASE_URL.'"</script>';

        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/login.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function action() {
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
                    createSession([
                        'User_Id' => $accountData[0]['Id'],
                        'User_Email' => $decodedBody['email'],
                        'User_Image' => $decodedBody['picture'],
                        'User_FirstName' => $decodedBody['given_name'],
                        'User_MiddleName' => "",
                        'User_LastName' => $decodedBody['family_name'],
                        'User_Group' => $accountData[0]['Group'],
                        'User_Role' => $accountData[0]['Role']
                    ]);
                    $accountData = $accountModel->updateAccount([
                        'Id'=>$accountData[0]['Id'],
                        'Image' => $decodedBody['picture'],
                        'FirstName' => $decodedBody['given_name'],
                        'LastName' => $decodedBody['family_name'],
                    ]);
                    header("Location: ".BASE_URL."?page=dashboard");
                }
            } else {
                $this->Error = "Email verification failed, try again!";
                $this->index();
            }
        }
    }
}
?>
