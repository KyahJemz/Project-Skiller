<?php

class HomeController {
    public function index() {
        // Logic to fetch data from the model
        $data = // ...

        // Render the view with the data
        include('../views/home.php');
    }
}
?>