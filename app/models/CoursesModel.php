<?php

class CoursesModel {

    private $database; 
    private $logger; 

    public function __construct($db, $logger) {
        $this->database = $db;
        $this->logger = $logger;
    }

    public function getCourses($params) {
        $query = "SELECT 
            courses.Id as Id,
            courses.CourseName as CourseName,
            courses.CourseImage as CourseImage,
            courses.CourseDescription as CourseDescription
            FROM tbl_courses as courses
            WHERE courses.Id = ".$params['Course_Id'];

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

    public function getAllCourses(){
        $query = "SELECT 
            courses.id as Id,
            courses.CourseName as CourseName,
            courses.CourseImage as CourseImage,
            courses.CourseDescription as CourseDescription
            FROM tbl_courses as courses";

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

    public function getUserCourses($params) {
        $query = "SELECT 
                courses.Id as Id,
                courses.CourseName as CourseName,
                courses.CourseImage as CourseImage,
                courses.CourseDescription as CourseDescription
                FROM tbl_sections  as sections
                LEFT JOIN tbl_courses as courses
                ON sections.Course_Id = courses.Id
                WHERE sections.Account_Id = ". $params['Account_Id'];

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

    public function getUserOtherCourses($params){
        $MyCoursesRaw = $this->getUserCourses(['Account_Id'=>$params['Account_Id']]);
        $MyCourses = [];
        foreach ($MyCoursesRaw as $value) {
            $MyCourses[] = $value['Id'];
        }

        $notInClause = !empty($MyCourses) ? 'NOT IN (' . implode(',', $MyCourses) . ')' : '';

        $query = "SELECT 
            courses.Id as Id,
            courses.CourseName as CourseName,
            courses.CourseImage as CourseImage,
            courses.CourseDescription as CourseDescription
            FROM tbl_courses as courses
            WHERE courses.Id $notInClause";

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

    public function enrollStudentHere($params){
        $AccountId = $params['Account_Id'];
        $CourseId = $params['Course_Id'];
        
        $query ="INSERT IGNORE INTO tbl_sections (Account_Id, Course_Id, Progress) VALUES ('".$AccountId."', '".$CourseId."', '1')";
      
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;
        }
    
        $stmt->execute();
    
        if ($stmt->error) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false;
        }
    
        $stmt->close();
    
        return true;
    }

    public function updateChapterProgress($params){
        $query = "UPDATE tbl_sections SET Progress = Progress + 1 WHERE Account_Id = ? AND Course_Id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ii", $params['Account_Id'], $params['Course_Id']);
        $stmt->execute();
        $stmt->close();
    }

    public function resetChapterProgress($params){
        $query = "UPDATE tbl_sections SET Progress = 1 WHERE Account_Id = ? AND Course_Id = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ii", $params['Account_Id'], $params['Course_Id']);
        $stmt->execute();
        $stmt->close();
    }

    public function getChapterProgress($params){
        $AccountId = $params['Account_Id'];
        
        $query = "SELECT * FROM tbl_sections WHERE Account_Id = ".$AccountId;

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

    public function getCoursesOnly($params) {
        $CourseId = $this->database->escape($params['Id']);

        $query = "SELECT * FROM tbl_courses WHERE Id = ". $CourseId;

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
    
    public function updateCourseOnly($params) {
        $Id = $this->database->escape($params['Id']);
        $Title = $this->database->escape($params['Title']);
        $Description = $this->database->escape($params['Description']);
        $Image = $this->database->escape($params['Image']);
    
        if (empty($Image)){
            $query = "UPDATE tbl_courses SET CourseName = ?, CourseDescription = ? WHERE Id = ?";
        
            $stmt = $this->database->prepare($query);
        
            if (!$stmt) {
                $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
                return false;  
            }
        
            $stmt->bind_param('ssi', $Title, $Description, $Id);
    
            $stmt->execute();
        
            if ($stmt->affected_rows === -1) {
                $this->logger->log('Error executing query: ' . $stmt->error, 'error');
                $stmt->close();
                return false; 
            }
        
            $stmt->close();
        } else {
            $query = "UPDATE tbl_courses SET CourseName = ?, CourseImage = ?, CourseDescription = ? WHERE Id = ?";
        
            $stmt = $this->database->prepare($query);
        
            if (!$stmt) {
                $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
                return false;  
            }
        
            $stmt->bind_param('sssi', $Title, $Image, $Description, $Id);
    
            $stmt->execute();
        
            if ($stmt->affected_rows === -1) {
                $this->logger->log('Error executing query: ' . $stmt->error, 'error');
                $stmt->close();
                return false; 
            }
        
            $stmt->close();
        }

    
        return true; 
    }


    public function deleteCourse($params) {
        $CourseId = $this->database->escape($params['Id']);
    
        $this->database->begin_transaction();
    
        try {

            // SELECT ALL LESSONS
            $query = "SELECT Id FROM tbl_lessons WHERE tbl_lessons.Chapter_Id = ?";
            $stmt = $this->database->prepare($query);
            if (!$stmt) {
                $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
                return [];
            }
            $stmt->bind_param('i', $CourseId);
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
            
            $queryTable7 = "DELETE FROM tbl_chapter WHERE Course_Id = ?";
            $stmtTable7 = $this->database->prepare($queryTable7);
            $stmtTable7->bind_param('i', $CourseId);
            $stmtTable7->execute();
            $stmtTable7->close();

            $queryTable7 = "DELETE FROM tbl_courses WHERE Id = ?";
            $stmtTable7 = $this->database->prepare($queryTable7);
            $stmtTable7->bind_param('i', $CourseId);
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

    
    public function addCourseOnly($params) {
        $CourseTitle = $this->database->escape($params['Title']);
        $CourseDescription = $this->database->escape($params['Description']);
        $CourseImage = $this->database->escape($params['Image']);
    
        $query = "INSERT IGNORE INTO tbl_courses (CourseName, CourseDescription, CourseImage) VALUES (?, ?, ?)";
        
        $stmt = $this->database->prepare($query);
    
        if (!$stmt) {
            $this->logger->log('Error preparing query: ' . $this->database->error, 'error');
            return false;  
        }
    
        $stmt->bind_param('sss', $CourseTitle, $CourseDescription, $CourseImage);
    
        $stmt->execute();
    
        if ($stmt->affected_rows === -1) {
            $this->logger->log('Error executing query: ' . $stmt->error, 'error');
            $stmt->close();
            return false; 
        }
    
        $stmt->close();
    
        return true; 
    }
}
?>
