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
            courses.CourseImage as CourseImage
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
}
?>
