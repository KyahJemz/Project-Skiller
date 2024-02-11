<?php
class Email {
    static function sendMail($params){
        require_once(__DIR__ . './../vendor/autoload.php');
        $Subject = "";
        $SenderName = "Skiller - Tutorial System";
        $SenderEmail = "skiller.ts.mail@gmail.com";
        $ReceiverName = "Stephen";
        $ReceiverEmail = "jameslayson.0@gmail.com";

        $Header = "Good Day,";
        $Message = "Empty Message";
        $Footer = "- Skiller Team";

        if(isset($params['ReceiverName']) && isset($params['ReceiverEmail'])){
            $ReceiverName = $params['ReceiverName'];
            $ReceiverEmail = $params['ReceiverEmail'];
        } else {
            return false;
        }

        if(isset($params['Header'])){
            $Header = $params['Header'];
        }

        if(isset($params['Message'])){
            $Message = $params['Message'];
        }

        if(isset($params['Footer'])){
            $Footer = $params['Footer'];
        }
        
        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', API_KEY);
        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(), $config);
    
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'subject' => 'Skiller Mail',
            'sender' => ['name' => $SenderName, 'email' => $SenderEmail],
            'to' => [['name' => $ReceiverName, 'email' => $ReceiverEmail]],
            'htmlContent' => "
                <html>
                    <body>
                        <p>$Header</p>
                        <p>$Message</p>
                        <p>$Footer</p>
                    </body>
                </html>",
        ]);

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            print_r($result);
        } catch (Exception $e) {
            echo $e->getMessage(), PHP_EOL;
            if (isset($result)) {
                echo 'error sending email';
            }
        }
    }
}
?>
