<?php

class ProgressModel {

    private $database; 
    private $logger; 

    public function __construct($db, $logger) {
        $this->database = $db;
        $this->logger = $logger;
    }

    public function getAllMyProgress($params) {
        $AccountId = $this->database->escape($params['Account_Id']);

        $query1 = "SELECT 
            chapter.Id as Cid,
            lesson.Id as Lid,
        null as Aid
        FROM tbl_chapter as chapter
        RIGHT JOIN tbl_lessons as lesson ON chapter.Id = lesson.Chapter_Id
        
        UNION
        
        SELECT 
            chapter.Id as Cid,
            lesson.Id as Lid,
            activity.Id as Aid
        FROM tbl_chapter as chapter
        RIGHT JOIN tbl_lessons as lesson ON chapter.Id = lesson.Chapter_Id
        LEFT JOIN tbl_activity as activity ON lesson.Id = activity.Lesson_Id";

        $stmt = $this->database->prepare($query1);
    
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
    
        $data1 = $result->fetch_all(MYSQLI_ASSOC);
    
        $stmt->close();

        $query2 = "SELECT 
            progress.Account_Id as AccId,
            progress.Lesson_Id as Lid,
            lesson.Chapter_Id as Cid,
            progress.Activity_Id as Aid
        FROM tbl_progress as progress
        LEFT JOIN tbl_lessons as lesson ON progress.Lesson_Id = lesson.Id
        LEFT JOIN tbl_chapter as chapter ON lesson.Chapter_Id = chapter.Id
        WHERE progress.Account_Id = $AccountId";

        $stmt = $this->database->prepare($query2);
    
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
    
        $data2 = $result->fetch_all(MYSQLI_ASSOC);
    
        $stmt->close();

        $FullProgressTotal = count($data1);
        $ChapterProgressTotal = [];
        $LessonProgressTotal = [];

        foreach ($data1 as $value) {
            $ChapterProgressTotal[$value['Cid']] = isset($ChapterProgressTotal[$value['Cid']]) ? $ChapterProgressTotal[$value['Cid']] + 1 : 1;

            $LessonProgressTotal[$value['Lid']] = isset($LessonProgressTotal[$value['Lid']]) ? $LessonProgressTotal[$value['Lid']] + 1 : 1;
        }

        $FullProgress = 0;
        $ChapterProgress = [];
        $LessonProgress = [];

        foreach ($data2 as $value) {
            $ChapterProgress[$value['Cid']] = isset($ChapterProgress[$value['Cid']]) ? $ChapterProgress[$value['Cid']] + 1 : 1;

            $LessonProgress[$value['Lid']] = isset($LessonProgress[$value['Lid']]) ? $LessonProgress[$value['Lid']] + 1 : 1;

            $FullProgress += 1;
        }

        $Progress = [
            'FullProgress' => $FullProgress,
            'ChapterProgress' => $ChapterProgress,
            'LessonProgress' => $LessonProgress,
            'FullProgressTotal' => $FullProgressTotal,
            'ChapterProgressTotal' => $ChapterProgressTotal,
            'LessonProgressTotal' => $LessonProgressTotal
        ];

        return $Progress;
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
