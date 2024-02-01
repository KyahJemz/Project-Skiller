<?php
class HomeController {

    public function index() {
        $logger = new Logger();
        $data['title'] = "Welcome to Skiller: Tutorial System";
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedOut.php');
        include(__DIR__ . '/../views/home.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }

    public function indexTeacher() {
        $this->index();
    }

    public function indexAdministrator() {
        $this->index();
    }



    
}
?>