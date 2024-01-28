<?php

class Router {
    private $logger;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function route() {
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) ?? 'home';
        $item = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_STRING) ?? '';

        $page = sanitizeInput($page);
        $item = sanitizeInput($item);

        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? '';

        $controllerClass = ucfirst($page) . 'Controller';
        $controllerFile = '../app/controllers/' . $controllerClass . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $this->logger->log('Accessed ['.$page.']', 'info');

            $controller = new $controllerClass();

            if ($action) {
                $controller->action($item);
            } else {
                if ($item !== '') {
                    $controller->index($item);
                } else {
                    $controller->index();
                }
            }

        } else {
            $this->logger->log('404 - Page not found ['.$page.']', 'error');
            include('../app/views/error/NotFound.php');
        }
    }
}


?>