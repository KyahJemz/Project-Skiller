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
        RIGHT JOIN tbl_chapter ON tbl_lessons.Chapter = tbl_chapter.Id";
    
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
            tbl_chapter.Code as ChapterCode,
            tbl_lessons.Title as LessonTitle
        FROM tbl_lessons 
        RIGHT JOIN tbl_chapter ON tbl_lessons.Chapter = tbl_chapter.Id
        WHERE tbl_lessons.Chapter = $ChapterId";
    
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
            tbl_chapter.Code as ChapterCode,
            tbl_lessons.Title as LessonTitle,
            tbl_lessons.Objective as LessonObjective,
            tbl_lessons.Description as LessonDescription,
            tbl_lessons.Image as LessonImage,
            tbl_lessons.Video as LessonVideo,
            tbl_lessons.Content as LessonContent
        FROM tbl_lessons 
        RIGHT JOIN tbl_chapter ON tbl_lessons.Id = tbl_chapter.Id
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

    public function getActivity($params) {
        $LessonId = $this->database->escape($params['LessonId']);
        $query = "SELECT 
            tbl_chapter.Id as ChapterId,
            tbl_chapter.Title as ChapterTitle,
            tbl_chapter.Code as ChapterCode,
            tbl_lessons.Title as LessonTitle,
            tbl_lessons.Objective as LessonObjective,
            tbl_lessons.Description as LessonDescription,
            tbl_lessons.Image as LessonImage,
            tbl_lessons.Video as LessonVideo,
            tbl_lessons.Content as LessonContent
        FROM tbl_lessons 
        RIGHT JOIN tbl_chapter ON tbl_lessons.Id = tbl_chapter.Id
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
