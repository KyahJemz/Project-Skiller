<?php

class LessonModel {

    private $database; 
    private $logger; 

    public function __construct($db, $logger) {
        $this->database = $db;
        $this->logger = $logger;
    }

    public function getChaptersOnly() {
        $query = "SELECT * FROM tbl_chapter";

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

    public function getChapterOnly($params) {
        $ChapterId = $this->database->escape($params['Id']);

        $query = "SELECT * FROM tbl_chapter WHERE Id = $ChapterId LIMIT 1";

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

   

    public function updateChapterOnly($params) {
        $ChapterId = $this->database->escape($params['Id']);
        $ChapterTitle = $this->database->escape($params['Title']);
        $ChapterCodes = $this->database->escape($params['Codes']);
    
        $query = "UPDATE tbl_chapter SET Title = ?, Codes = ? WHERE Id = ?";
        
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;  
        }
    
        $stmt->bind_param('ssi', $ChapterTitle, $ChapterCodes, $ChapterId);

        $stmt->execute();
    
        if ($stmt->affected_rows === -1) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false; 
        }
    
        $stmt->close();
    
        return true; 
    }

    public function addChapterOnly($params) {
        $ChapterTitle = $this->database->escape($params['Title']);
        $ChapterCodes = $this->database->escape($params['Codes']);
    
        $query = "INSERT IGNORE INTO tbl_chapter (Title, Codes) VALUES (?, ?)";
        
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;  
        }
    
        $stmt->bind_param('ss', $ChapterTitle, $ChapterCodes);
    
        $stmt->execute();
    
        if ($stmt->affected_rows === -1) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false; 
        }
    
        $stmt->close();
    
        return true; 
    }

    public function deleteChapter($params) {
        $ChapterId = $this->database->escape($params['Id']);
    
        $this->database->begin_transaction();
    
        try {

            // SELECT ALL LESSONS
            $query = "SELECT Id FROM tbl_lessons WHERE tbl_lessons.Chapter_Id = ?";
            $stmt = $this->database->prepare($query);
            if (!$stmt) {
                $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
                return [];
            }
            $stmt->bind_param('i', $ChapterId);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result) {
                $this->logger->log('Error executing query: ' . $stmt->error, 'error');
                $stmt->close();
                return [];
            }
            $data = $result->fetch_all(MYSQLI_ASSOC);  
            $stmt->close();

            if(!empty($data)){
                // SELECT ALL ACTIVITIES WITH LESSONS
                $lessonIds = array_column($data, 'Id');  
                $query2 = "SELECT Id FROM tbl_activity WHERE Lesson_Id IN (" . implode(',', $lessonIds) . ")";
                $stmt2 = $this->database->prepare($query2);
                if (!$stmt2) {
                    $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
                    return [];
                }
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                if (!$result2) {
                    $this->logger->log('Error executing query: ' . $stmt2->error, 'error');
                    $stmt2->close();
                    return [];
                }
                $data2 = $result2->fetch_all(MYSQLI_ASSOC);
                $stmt2->close();

                $activityIds = array_column($data2, 'Id');  

                if(!empty($data2)){
                    $queryTable3 = "DELETE FROM tbl_questions WHERE Activity_Id IN (" . implode(',', $activityIds) . ")";
                    $stmtTable3 = $this->database->prepare($queryTable3);
                    $stmtTable3->execute();
                    $stmtTable3->close();
                }

                $queryTable1 = "DELETE FROM tbl_inprogress WHERE Lesson_Id IN (" . implode(',', $lessonIds) . ")";
                $stmtTable1 = $this->database->prepare($queryTable1);
                $stmtTable1->execute();
                $stmtTable1->close();

                $queryTable4 = "DELETE FROM tbl_results WHERE Lesson_Id IN (" . implode(',', $lessonIds) . ")";
                $stmtTable4 = $this->database->prepare($queryTable4);
                $stmtTable4->execute();
                $stmtTable4->close();

                $queryTable5 = "DELETE FROM tbl_activity WHERE Lesson_Id IN (" . implode(',', $lessonIds) . ")";
                $stmtTable5 = $this->database->prepare($queryTable5);
                $stmtTable5->execute();
                $stmtTable5->close();

                $queryTable2 = "DELETE FROM tbl_progress WHERE Lesson_Id IN (" . implode(',', $lessonIds) . ")";
                $stmtTable2 = $this->database->prepare($queryTable2);
                $stmtTable2->execute();
                $stmtTable2->close();

                $queryTable6 = "DELETE FROM tbl_lessons WHERE Id IN (" . implode(',', $lessonIds) . ")";
                $stmtTable6 = $this->database->prepare($queryTable6);
                $stmtTable6->execute();
                $stmtTable6->close();
            }
            
            $queryTable7 = "DELETE FROM tbl_chapter WHERE Id = ?";
            $stmtTable7 = $this->database->prepare($queryTable7);
            $stmtTable7->bind_param('i', $ChapterId);
            $stmtTable7->execute();
            $stmtTable7->close();

            $this->database->commit();
    
            return true; 
        } catch (Exception $e) {
            $this->database->rollback();
            $this->logger->log('Error deleting records: ' . $e->getMessage(), 'error');
            return false;
        }
    }


    public function getLessonsOnly() {
        $query = "SELECT 
            tbl_chapter.Id as ChapterId,
            tbl_chapter.Title as ChapterTitle,
            tbl_chapter.Codes as ChapterCodes,
            tbl_lessons.Id as LessonId,
            tbl_lessons.Title as LessonTitle,
            tbl_lessons.Objective as LessonObjective,
            tbl_lessons.Description as LessonDescription
        FROM tbl_lessons 
        RIGHT JOIN tbl_chapter ON tbl_lessons.Chapter_Id = tbl_chapter.Id";
    
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

    public function getLessonOnly($params) {
        $LessonId = $this->database->escape($params['Id']);

        $query = "SELECT * FROM tbl_lessons WHERE Id = $LessonId LIMIT 1";

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

    public function addLessonOnly($params) {
        $fields = [];
        $values = [];
        $types = '';
        $paramsToBind = [];
    
        foreach ($params as $key => $value) {
            if ($value !== "" || !empty($value)) {
                $fields[] = $key;
                $values[] = '?';
                $types .= $key === "Chapter_Id" ? 'i' : 's'; 
                $paramsToBind[] = $value;
            }
        }
    
        if (empty($fields)) {
            $this->logger->log('No fields provided for insertion.', 'error');
            return false;
        }
    
        $query = "INSERT IGNORE INTO tbl_lessons (";
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
    
    public function updateLessonOnly($params) {
        $fieldsToUpdate = [];
        
        foreach ($params as $key => $value) {
            if ($key !== 'Id' && isset($value)) {
                $fieldsToUpdate[] = "$key = ?";
            }
        }
        
        $setClause = implode(', ', $fieldsToUpdate);
        
        $query = "UPDATE tbl_lessons SET $setClause WHERE Id = ?";
        
        $stmt = $this->database->prepare($query);
        
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;  
        }
        
        $valuesToBind = [];
        $types = '';
        foreach ($params as $key => $value) {
            if ($key !== 'Id' && isset($value)) {
                $valuesToBind[] = $value;
                $types .= 's'; 
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

    public function deleteLesson($params) {
        $LessonId = $this->database->escape($params['Id']);
    
        $this->database->begin_transaction();
    
        try {
            $query2 = "SELECT Id FROM tbl_activity WHERE Lesson_Id = $LessonId";
            $stmt2 = $this->database->prepare($query2);
            if (!$stmt2) {
                $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
                return [];
            }
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            if (!$result2) {
                $this->logger->log('Error executing query: ' . $stmt2->error, 'error');
                $stmt2->close();
                return [];
            }
            $data2 = $result2->fetch_all(MYSQLI_ASSOC);
            $stmt2->close();

            $activityIds = array_column($data2, 'Id');  

            if(!empty($data2)){
                $queryTable3 = "DELETE FROM tbl_questions WHERE Activity_Id IN (" . implode(',', $activityIds) . ")";
                $stmtTable3 = $this->database->prepare($queryTable3);
                $stmtTable3->execute();
                $stmtTable3->close();
            }

            $queryTable1 = "DELETE FROM tbl_inprogress WHERE Lesson_Id = $LessonId";
            $stmtTable1 = $this->database->prepare($queryTable1);
            $stmtTable1->execute();
            $stmtTable1->close();

            $queryTable4 = "DELETE FROM tbl_results WHERE Lesson_Id = $LessonId";
            $stmtTable4 = $this->database->prepare($queryTable4);
            $stmtTable4->execute();
            $stmtTable4->close();

            $queryTable5 = "DELETE FROM tbl_activity WHERE Lesson_Id = $LessonId";
            $stmtTable5 = $this->database->prepare($queryTable5);
            $stmtTable5->execute();
            $stmtTable5->close();

            $queryTable2 = "DELETE FROM tbl_progress WHERE Lesson_Id = $LessonId";
            $stmtTable2 = $this->database->prepare($queryTable2);
            $stmtTable2->execute();
            $stmtTable2->close();

            $queryTable6 = "DELETE FROM tbl_lessons WHERE Id = $LessonId";
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
    
    public function getChapter($params) {
        $ChapterId = $this->database->escape($params['ChapterId']);
    
        $query = "SELECT 
            *
        FROM tbl_chapter 
        WHERE tbl_chapter.Id = $ChapterId";
    
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

    public function getChapterFull($params) {
        $ChapterId = $this->database->escape($params['ChapterId']);
    
        $query = "SELECT 
            tbl_chapter.Id as ChapterId,
            tbl_chapter.Title as ChapterTitle,
            tbl_chapter.Codes as ChapterCodes,
            tbl_lessons.Id as LessonId,
            tbl_lessons.Title as LessonTitle,
            tbl_lessons.Description as LessonDescription
        FROM tbl_lessons 
        RIGHT JOIN tbl_chapter ON tbl_lessons.Chapter_Id = tbl_chapter.Id
        WHERE tbl_lessons.Chapter_Id = $ChapterId";
    
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
    
    public function getLessonFull($params) {
        $LessonId = $this->database->escape($params['LessonId']);
        $query = "SELECT 
            tbl_chapter.Id as ChapterId,
            tbl_chapter.Title as ChapterTitle,
            tbl_chapter.Codes as ChapterCodes,
            tbl_lessons.Title as LessonTitle,
            tbl_lessons.Id as LessonId,
            tbl_lessons.Objective as LessonObjective,
            tbl_lessons.Description as LessonDescription,
            tbl_lessons.Image as LessonImage,
            tbl_lessons.Video as LessonVideo,
            tbl_lessons.Content as LessonContent
        FROM tbl_lessons 
        RIGHT JOIN tbl_chapter ON tbl_lessons.Chapter_Id = tbl_chapter.Id
        WHERE tbl_lessons.Id = $LessonId";
    
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
?>
