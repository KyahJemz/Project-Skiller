
<?php

class Logger {
    private $logFile;

    public function __construct($logFile = '../logs/application.log') {
        $this->logFile = $logFile;
    }

    public function log($message, $level = 'info') {
        $formattedMessage = date("[Y-m-d H:i:s] ") . strtoupper($level) . ': ' . $message . PHP_EOL;
        error_log($formattedMessage, 3, $this->logFile);
    }
}

// $logger = new Logger();
// $logger->log('User logged in successfully', 'info');
// $logger->log('An error occurred', 'error');
?>
