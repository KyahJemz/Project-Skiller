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
        $CourseId = $this->database->escape($params['Course_Id']);
        // $query = 'SELECT 
        //     results.Id as ResultId,
        //     results.Score as Score,
        //     results.Total as Total,
        //     results.Timestamp as Timestamp,
        //     activity.Id as ActivityId,
        //     activity.Title as ActivityTitle,
        //     lessons.Id as LessonId,
        //     lessons.Title as LessonTitle,
        //     lessons.Chapter_Id as ChapterId
        //     FROM tbl_results AS results
        //     LEFT JOIN tbl_lessons AS lessons ON results.Lesson_Id = lessons.Id
        //     LEFT JOIN tbl_activity AS activity ON results.Activity_Id = activity.Id
        //     LEFT JOIN tbl_chapter AS chapter ON lessons.Chapter_Id = chapter.Id
        //     WHERE results.Id IN (
        //         SELECT MAX(tbl_results.Id) as ResultId
        //         FROM tbl_results
        //         LEFT JOIN tbl_lessons AS lessons ON tbl_results.Lesson_Id = lessons.Id
        //         LEFT JOIN tbl_chapter AS chapter ON lessons.Chapter_Id = chapter.Id
        //         WHERE tbl_results.Account_Id = '.$AccountId.' 
        //         AND chapter.Course_Id = '.$CourseId.'
        //         GROUP BY tbl_results.Activity_Id, tbl_results.Lesson_Id, tbl_results.Account_Id)';

        $query = 'SELECT 
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
            LEFT JOIN tbl_chapter AS chapter ON lessons.Chapter_Id = chapter.Id
            WHERE results.Account_Id = '.$AccountId.' AND chapter.Course_Id = '.$CourseId.'
            AND results.Id IN (
                SELECT MAX(tbl_results.Id) as ResultId
                FROM tbl_results
                LEFT JOIN tbl_lessons AS lessons ON tbl_results.Lesson_Id = lessons.Id
                LEFT JOIN tbl_chapter AS chapter ON lessons.Chapter_Id = chapter.Id
                GROUP BY tbl_results.Activity_Id, tbl_results.Lesson_Id, tbl_results.Account_Id)';

    
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
    
        $query = "SELECT 
            * 
        FROM tbl_results as results
        LEFT JOIN tbl_accounts as accounts ON results.Account_Id = accounts.Id
        LEFT JOIN tbl_activity as activity ON results.Activity_Id = activity.Id
        WHERE results.Id = ?";
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->bind_param('i', $Id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $updatedRows = [];
        while ($row = $result->fetch_assoc()) {
            $updatedRows[] = $row;
        }
    
        $stmt->close();
    
        return $updatedRows; 
    }
    
    public function updateActivityViewResults($params){
        $ToState = $this->database->escape($params['ToState']);
        $Id = $this->database->escape($params['Id']);

        $query = "UPDATE tbl_activity SET IsViewSummary = ? WHERE Id = ?";
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->bind_param('ii', $ToState, $Id);
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

    public function addActivityOnly($params) {
        $fields = [];
        $values = [];
        $types = '';
        $paramsToBind = [];
    
        foreach ($params as $key => $value) {
            if ($value !== "" || !empty($value)) {
                $fields[] = $key;
                $values[] = '?';
                $types .= $key === "Lesson_Id" || $key === "IsViewSummary"  ? 'i' : 's'; 
                $paramsToBind[] = $key === "IsViewSummary" ? $value === "true" ? 1 : 0  : $value;
            }
        }
    
        if (empty($fields)) {
            $this->logger->log('No fields provided for insertion.', 'error');
            return false;
        }
    
        $query = "INSERT IGNORE INTO tbl_activity (";
        $query .= implode(', ', $fields);
        $query .= ") VALUES (";
        $query .= implode(', ', $values);
        $query .= ")";
    
        $stmt = $this->database->prepare($query);

        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;  
        }
        
        // Dynamically bind parameters using call_user_func_array
        $bindParams = array_merge([$types], $paramsToBind);
        $refParams = [];
        foreach ($bindParams as $key => $value) {
            $refParams[$key] = &$bindParams[$key];
        }
        call_user_func_array(array($stmt, 'bind_param'), $refParams);
        
        $stmt->execute();
    
        if ($stmt->affected_rows === -1) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false; 
        }
    
        $stmt->close();
    
        return true; 
    }

    public function updateActivityOnly($params) {
        $fieldsToUpdate = [];
        
        foreach ($params as $key => $value) {
            if ($key !== 'Id' && isset($value)) {
                $fieldsToUpdate[] = "$key = ?";
            }

        }
        
        $setClause = implode(', ', $fieldsToUpdate);
        
        $query = "UPDATE tbl_activity SET $setClause WHERE Id = ?";
        
        $stmt = $this->database->prepare($query);
        
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;  
        }
        
        $valuesToBind = [];
        $types = '';
        foreach ($params as $key => $value) {
            if ($key !== 'Id' && isset($value)) {
                if($key !== 'IsViewSummary') {
                    $valuesToBind[] = $value;
                    $types .= 's'; 
                } else {
                    $valuesToBind[] = $value === "true" ? 1 : 0;
                    $types .= 'i'; 
                }
            }
        }
        
        $valuesToBind[] = $params['Id']; 
        $types .= 'i'; 
        $stmt->bind_param($types, ...$valuesToBind);
        
        $stmt->execute();
        
        if ($stmt->affected_rows === -1) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false; 
        }
        
        $stmt->close();
        
        return true; 
    }

    public function deleteActivity($params) {
        $ActivityId = $this->database->escape($params['Id']);
        
        $this->database->begin_transaction();
        try {
            $queryTable3 = "DELETE FROM tbl_questions WHERE Activity_Id = $ActivityId";
            $stmtTable3 = $this->database->prepare($queryTable3);
            $stmtTable3->execute();
            $stmtTable3->close();
            $queryTable1 = "DELETE FROM tbl_inprogress WHERE Activity_Id = $ActivityId";
            $stmtTable1 = $this->database->prepare($queryTable1);
            $stmtTable1->execute();
            $stmtTable1->close();
            $queryTable4 = "DELETE FROM tbl_results WHERE Activity_Id = $ActivityId";
            $stmtTable4 = $this->database->prepare($queryTable4);
            $stmtTable4->execute();
            $stmtTable4->close();
            $queryTable2 = "DELETE FROM tbl_progress WHERE Activity_Id = $ActivityId";
            $stmtTable2 = $this->database->prepare($queryTable2);
            $stmtTable2->execute();
            $stmtTable2->close();
            $queryTable6 = "DELETE FROM tbl_activity WHERE Id = $ActivityId";
            $stmtTable6 = $this->database->prepare($queryTable6);
            $stmtTable6->execute();
            $stmtTable6->close();
            $this->database->commit();
    
            return true; 
        } catch (Exception $e) {
            $this->database->rollback();
            $this->logger->log('Error deleting records: ' . $e->getMessage(), 'error');
            return false;
        }
    }

    public function getActivityOnly($params) {
        $ActivityId = $this->database->escape($params['Id']);

        $query = "SELECT * FROM tbl_activity WHERE Id = $ActivityId LIMIT 1";

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

    public function updateQuestion($params){
        $Question_Id = $params['Id'];
        $Question = $params['Question'];
        $Points = $params['Points'];
        $Option1 = $params['Option1'];
        $Option2 = $params['Option2'];
        $Option3 = $params['Option3'];
        $Option4 = $params['Option4'];
        $Answer = $params['Answer'];
        
        $query = "UPDATE tbl_questions SET Question = ?, Points = ?, Option1 = ?, Option2 = ?, Option3 = ?, Option4 = ?, Answer = ? WHERE Id = ?";
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->bind_param('sssssssi', $Question, $Points, $Option1, $Option2, $Option3, $Option4, $Answer, $Question_Id);
        $stmt->execute();
    
        if ($stmt->error) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false;
        }
    
        $stmt->close();
    
        return true;
    }

    public function deactivateQuestion($params){
        $query = "UPDATE tbl_questions SET IsActive = 0 WHERE Activity_Id IN (" . implode(',', $params['Ids']) . ")";
        $stmt = $this->database->prepare($query);
        $stmt->execute();
        $stmt->close();
    }

    public function addQuestion($params){
        $Activity_Id = $params['Activity_Id'];
        $Question = $params['Question'];
        $Points = $params['Points'];
        $Option1 = $params['Option1'];
        $Option2 = $params['Option2'];
        $Option3 = $params['Option3'];
        $Option4 = $params['Option4'];
        $Answer = $params['Answer'];

        $query = "INSERT INTO tbl_questions (Activity_Id, Question, Points, Option1, Option2, Option3, Option4, Answer) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->database->prepare($query);

        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }

        $stmt->bind_param('isssssss', $Activity_Id, $Question, $Points, $Option1, $Option2, $Option3, $Option4, $Answer);
        $stmt->execute();

        if ($stmt->error) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false;
        }

        $stmt->close();

        return true;
    }

    public function getQuestionIds($params){
        $Activity_Id = $this->database->escape($params['Activity_Id']);
        $query = "SELECT 
            Id
        FROM tbl_questions 
        WHERE tbl_questions.Activity_Id = $Activity_Id";
    
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
    
        return $data ?? [];
    }

}