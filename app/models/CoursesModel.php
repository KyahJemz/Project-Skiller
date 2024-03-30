<?php

class CoursesModel {

    private $database; 
    private $logger; 

    public function __construct($db, $logger) {
        $this->database = $db;
        $this->logger = $logger;
    }

    public function getAllCourses(){
        $query = "SELECT 
            courses.id as Id
            courses.CourseName as CourseName
            courses.CourseImage as CourseImage
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
                courses.id as Id,
                courses.CourseName as CourseName,
                courses.CourseImage as CourseImage
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
            courses.id as Id,
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


}
?>
