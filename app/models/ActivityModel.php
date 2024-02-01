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

    public function getActivitiesResults($params) {
        $AccountId = $this->database->escape($params['Account_Id']);
        $query = "SELECT 
            results.Id as ResultId,
            results.Score as Score,
            results.Total as Total,
            results.Timestamp as Timestamp,
            activity.Id as ActivityId,
            activity.Title as ActivityTitle,
            lessons.Id as LessonId,
            lessons.Title as LessonTitle,
            lessons.Chapter_Id as ChapterId
        FROM tbl_results AS results
        LEFT JOIN tbl_lessons AS lessons ON results.Lesson_Id = lessons.Id
        LEFT JOIN tbl_activity AS activity ON results.Activity_Id = activity.Id
        WHERE results.Id IN (
            SELECT MAX(tbl_results.Id) as ResultId
            FROM tbl_results
            WHERE tbl_results.Account_Id = $AccountId
            GROUP BY tbl_results.Activity_Id, tbl_results.Lesson_Id, tbl_results.Account_Id)";
    
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
            tbl_activity.IsViewSummary as ActivityIsViewSummary,
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

    public function updateResultRetake($params){
        $Value = $this->database->escape($params['Value']);
        $Id = $this->database->escape($params['Id']);

        $query = "UPDATE tbl_results SET IsRetake = ? WHERE Id = ?";
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->bind_param('ii', $Value, $Id);
        $stmt->execute();
    
        if ($stmt->error) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false;
        }
    
        $stmt->close();
    
        return true;
    }

    public function getActivityQuestions($params) {
        $ActivityId = $this->database->escape($params['ActivityId']);
        $query = "SELECT 
            *
        FROM tbl_questions 
        WHERE tbl_questions.Activity_Id = $ActivityId
        ORDER BY RAND()";
    
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

    public function createActivityResult($params) {
        $ActivityId = $this->database->escape($params['ActivityId']);
        $LessonId = $this->database->escape($params['LessonId']);
        $AccountId = $this->database->escape($params['AccountId']);
        $Score = $this->database->escape($params['Score']);
        $Summary = $params['Summary'];
        $Total = $this->database->escape($params['Total']);
    
        $query = "INSERT INTO tbl_results (Activity_Id, Lesson_Id, Account_Id, Score, Summary, Total) 
                  VALUES (?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->bind_param('iiisss', $ActivityId, $LessonId, $AccountId, $Score, $Summary, $Total);
    
        $stmt->execute();
    
        if ($stmt->error) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false;
        }
    
        $insertedId = $stmt->insert_id;
    
        $stmt->close();
    
        return $insertedId;
    }

    public function getActivityResult($params) {
        $ResultId = $this->database->escape($params['ResultId']);
        $query = "SELECT 
            *
        FROM tbl_results 
        WHERE tbl_results.Id = $ResultId";
    
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

    public function getActivityResults($params) {
        $ActivityId = $this->database->escape($params['Activity_Id']);
        $AccountId = $this->database->escape($params['Account_Id']);
        $query = "SELECT 
            *
        FROM tbl_results 
        WHERE tbl_results.Activity_Id = $ActivityId AND tbl_results.Account_Id = $AccountId ";
    
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

    public function getActivityResultFromActivityId($params){
        $ActivityId = $this->database->escape($params['ActivityId']);
        $AccountId = $this->database->escape($params['AccountId']);
        $query = "SELECT 
            tbl_results.Id as Id,
            tbl_results.IsRetake as IsRetake
        FROM tbl_results 
        WHERE tbl_results.Activity_Id = $ActivityId AND tbl_results.Account_Id = $AccountId";
    
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

    public function deleteActivityInProgress($params) {
        $ActivityId = $this->database->escape($params['ActivityId']);
        $LessonId = $this->database->escape($params['LessonId']);
        $AccountId = $this->database->escape($params['AccountId']);
    
        $query = "DELETE FROM tbl_inprogress WHERE Activity_Id = ? AND Lesson_Id = ? AND Account_Id = ?";
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

    public function createActivityInProgress($params) {
        $ActivityId = $this->database->escape($params['ActivityId']);
        $LessonId = $this->database->escape($params['LessonId']);
        $AccountId = $this->database->escape($params['AccountId']);
        $Questions = $params['Questions'];
        $Answers = $params['Answers'];
    
        $existingRecordId = $this->getExistingRecordId($ActivityId, $LessonId, $AccountId);
    
        if ($existingRecordId !== false) {
            return $this->updateActivityInProgress($ActivityId, $LessonId, $AccountId, $Questions, $Answers);
        } else {
            return $this->insertActivityInProgress($ActivityId, $LessonId, $AccountId, $Questions, $Answers);
        }
    }
    
    private function getExistingRecordId($ActivityId, $LessonId, $AccountId) {
        $query = "SELECT Activity_Id FROM tbl_inprogress WHERE Activity_Id = ? AND Lesson_Id = ? AND Account_Id = ? LIMIT 1";
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->bind_param('iii', $ActivityId, $LessonId, $AccountId);
        $stmt->execute();
    
        $recordExists = $stmt->fetch();
    
        $stmt->close();
    
        return $recordExists ? true : false;
    }
    
    private function insertActivityInProgress($ActivityId, $LessonId, $AccountId, $Questions, $Answers) {
        $query = "INSERT INTO tbl_inprogress (Activity_Id, Lesson_Id, Account_Id, Questions, Answers) 
                  VALUES (?, ?, ?, ?, ?)";
    
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->bind_param('iiiss', $ActivityId, $LessonId, $AccountId, $Questions, $Answers);
        $stmt->execute();
    
        if ($stmt->error) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false;
        }
    
        $stmt->close();
    
        return true;
    }
    
    private function updateActivityInProgress($ActivityId, $LessonId, $AccountId, $Questions, $Answers) {
        $query = "UPDATE tbl_inprogress SET Questions = ?, Answers = ? WHERE Activity_Id = ? AND Lesson_Id = ? AND Account_Id = ?";
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->bind_param('ssiii', $Questions, $Answers, $ActivityId, $LessonId, $AccountId);
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