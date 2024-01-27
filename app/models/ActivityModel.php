<?php

class ActivityModel {

    private $database; 
    private $logger; 

    public function __construct($db, $logger) {
        $this->database = $db;
        $this->logger = $logger;
    }

    public function getLessonActivities($params) {
        $LessonId = $this->database->escape($params['LessonId']);
        $query = "SELECT 
            tbl_activity.Id as ActivityId,
            tbl_activity.Lesson_Id as ActivityLessonId,
            tbl_activity.Title as ActivityTitle,
            tbl_activity.Description as ActivityDescription,
            tbl_activity.Notes as ActivityNotes,
            tbl_activity.CreatedAt as ActivityCreatedAt,
            tbl_activity.UpdatedAt as ActivityUpdatedAt
        FROM tbl_activity 
        WHERE tbl_activity.Lesson_Id = $LessonId";
    
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
    
        return $data;
    }

    public function getActivity($params) {
        $ActivityId = $this->database->escape($params['ActivityId']);
        $query = "SELECT 
            tbl_chapter.Id as ChapterId,
            tbl_chapter.Title as ChapterTitle,
            tbl_lessons.Id as LessonId,
            tbl_lessons.Title as LessonTitle,
            tbl_activity.Id as ActivityId,
            tbl_activity.Title as ActivityTitle,
            tbl_activity.Description as ActivityDescription,
            tbl_activity.Notes as ActivityNotes,
            tbl_activity.CreatedAt as ActivityCreatedAt,
            tbl_activity.UpdatedAt as ActivityUpdatedAt
        FROM tbl_activity 
        LEFT JOIN tbl_lessons ON tbl_activity.Lesson_Id = tbl_lessons.Id
        LEFT JOIN tbl_chapter ON tbl_lessons.Chapter_Id = tbl_chapter.Id
        WHERE tbl_activity.Id = $ActivityId";
    
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
    
        return $data;
    }

    public function getActivityQuestions($params) {
        $LessonId = $this->database->escape($params['ActivityId']);
        $query = "SELECT 
            tbl_activity.Id as ActivityId,
            tbl_activity.Lesson_Id as ActivityLessonId,
            tbl_activity.Title as ActivityTitle,
            tbl_activity.Description as ActivityDescription,
            tbl_activity.Notes as ActivityNotes,
            tbl_activity.CreatedAt as ActivityCreatedAt,
            tbl_activity.UpdatedAt as ActivityUpdatedAt
        FROM tbl_activity 
        WHERE tbl_activity.Id = $LessonId";
    
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
    
        return $data;
    }

    public function getActivityHasProgress($params) {
        $ActivityId = $this->database->escape($params['ActivityId']);
        $AccountId = $this->database->escape($params['AccountId']);
        $query = "SELECT 
            tbl_inprogress.Activity_Id as ActivityId,
            tbl_inprogress.Questions as ActivityQuestions,
            tbl_inprogress.Answers as ActivityAnswers,
            tbl_inprogress.LastAttempt as ActivityLastAttempt
        FROM tbl_inprogress
        WHERE tbl_inprogress.Activity_Id = $ActivityId AND tbl_inprogress.Account_Id = $AccountId";
    
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
    
        return $data;
    }




}