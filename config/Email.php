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
            
            $credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
            $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$credentials);
        
            $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
                'subject' => 'Skiller Mail',
                'sender' => ['name' => ''.$SenderName.'', 'email' => ''.$SenderEmail.''],
                'to' => [['name' => ''.$ReceiverName.'', 'email' => ''.$ReceiverEmail.'']],
                'htmlContent' => '
                    <html>
                        <body>
                            <p>{{params.bodyHeader}}</p>
                            <p>{{params.bodyMessage}}</p>
                            <p>{{params.bodyFooter}}</p>
                        </body>
                    </html>',
                'params' => ['bodyHeader' => ''.$Header.'', 'bodyMessage' => ''.$Message.'', 'bodyFooter' => ''.$Footer.'',]
            ]);
        
            try {
                $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
                print_r($result);
            } catch (Exception $e) {
                echo $e->getMessage(),PHP_EOL;
                if($result) {
                    echo 'error sending email';
                }
            }
        }
    }
?>