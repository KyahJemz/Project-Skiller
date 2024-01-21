<?php
class DashboardController {

    public function index() {
        $logger = new Logger();
        $data['title'] = "Welcome to Skiller: Tutorial System";
 
        include(__DIR__ . '/../views/headers/Default.php');
        include(__DIR__ . '/../views/headers/SignedIn.php');
        include(__DIR__ . '/../views/dashboard.php');
        include(__DIR__ . '/../views/footers/Default.php');
    }



    
}
?>