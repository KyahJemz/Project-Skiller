<?php

class Router {
    public function route() {
        // Extract the page and item parameters from the URL
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $item = isset($_GET['item']) ? $_GET['item'] : '';

        // Form the controller class name
        $controllerClass = ucfirst($page) . 'Controller';
        
        // Form the controller file path
        $controllerFile = '../app/controllers/' . $controllerClass . '.php';

        // Check if the controller file exists
        if (file_exists($controllerFile)) {
            // Include the controller file
            require_once $controllerFile;

            // Create an instance of the controller
            $controller = new $controllerClass();

            // Call the appropriate method based on the presence of the "item" parameter
            if ($item !== '') {
                $controller->index($item);
            } else {
                $controller->index();
            }
        } else {
            // Controller not found, handle accordingly (e.g., show a 404 page)
            echo '404 - Page not found';
        }
    }
}

?>