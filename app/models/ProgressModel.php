<?php

require_once __DIR__.'/../models/LessonModel.php';
require_once __DIR__.'/../models/ActivityModel.php';

class ProgressModel {

    private $database; 
    private $logger; 

    public function __construct($db, $logger) {
        $this->database = $db;
        $this->logger = $logger;
    }

    public function getAllMyProgress($params) {
        $AccountId = $this->database->escape($params['Account_Id']);
        $query = "SELECT 
            *
        FROM tbl_progress 
        WHERE tbl_progress.Account_Id = $AccountId ";
    
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return [];
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if (!$result) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return [];
        }
    
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        $stmt->close();

        $Progress = [];
        foreach ($data as $value) {
            
        }

        
        // return $data;
    }

    public function AddMyProgress($params) {
        $ActivityId = $this->database->escape($params['Activity_Id']);
        $LessonId = $this->database->escape($params['Lesson_Id']);
        $AccountId = $this->database->escape($params['Account_Id']);
    
        $query = "INSERT IGNORE INTO tbl_progress (Activity_Id, Lesson_Id, Account_Id) 
                  VALUES (?, ?, ?)";
        
        $stmt = $this->database->prepare($query);
        
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->bind_param('iii', $ActivityId, $LessonId, $AccountId);
        $stmt->execute();
        
        if ($stmt->error) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false;
        }
    
        $stmt->close();
    
        return true;
    }
}
?>
