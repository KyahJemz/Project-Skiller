<?php

class Router {
    private $logger;

    const DEFAULT_PAGE = 'home';
    const ERROR_FORBIDDEN = '../app/views/error/Forbidden.php';
    const ERROR_ROLE_NOT_ALLOWED = '../app/views/error/RoleNotAllowed.php';
    const ERROR_NOT_FOUND = '../app/views/error/NotFound.php';

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function route() {
        $page = $this->sanitizeInput(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING) ?? self::DEFAULT_PAGE);
        $item = $this->sanitizeInput(filter_input(INPUT_GET, 'item', FILTER_SANITIZE_STRING) ?? '');
        $course = $this->sanitizeInput(filter_input(INPUT_GET, 'course', FILTER_SANITIZE_STRING) ?? null);
        $action = $this->sanitizeInput(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? '');

        $this->validatePage($page);
        $this->validateItem($item);

        $controllerClass = ucfirst($page) . 'Controller';
        $controllerFile = '../app/controllers/' . $controllerClass . '.php';

        if ($page === "logout") {
            $this->logger->log('Logging Out', 'info');
            logout();
        }

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $this->logger->log('Accessed [' . $page . ']', 'info');

            $controller = new $controllerClass();
            $this->processAction($controller, $action, $item, $course);
        } else {
            $this->logger->log('404 - Page not found [' . $page . ']', 'error');
            include(self::ERROR_NOT_FOUND);
        }
    }

    private function processAction($controller, $action, $item, $course=null) {
        $role = isset($_SESSION['User_Role']) ? $_SESSION['User_Role'] : null;

        if ($action) {
            if($course && $item) {
                $this->executeRoleSpecificAction($controller, $action, $role, $item, $course);
            } elseif ($course) {
                $this->executeRoleSpecificAction($controller, $action, $role, $course);
            } elseif ($item) {
                $this->executeRoleSpecificAction($controller, $action, $role, $item);
            } else {
                $this->executeRoleSpecificAction($controller, $action, $role);
            }
        } else {
            if($course && $item) {
                $this->executeRoleSpecificIndex($controller, $role, $item, $course);
            } elseif ($course) {
                $this->executeRoleSpecificIndex($controller, $role, $course);
            } elseif ($item) {
                $this->executeRoleSpecificIndex($controller, $role, $item);
            } else {
                $this->executeRoleSpecificIndex($controller, $role);
            }
        }
    }

    private function executeRoleSpecificAction($controller, $action, $role, $item=null, $course=null) {
        $methodName = 'action' . ucfirst($role);
        if ($role === "Student"){
            $methodName ='action';
        }
        if (method_exists($controller, $methodName)) {
            $controller->$methodName($item, $course);
        } else {
            $this->handleRoleNotAllowed();
        }
    }

    private function executeRoleSpecificIndex($controller, $role, $item=null, $course=null) {
        $methodName = 'index' . ucfirst($role);
        if ($role === "Student"){
            $methodName ='index';
        }
        if (method_exists($controller, $methodName)) {
            $controller->$methodName($item, $course);
        } else {
            $this->handleRoleNotAllowed();
        }
    }

    private function handleRoleNotAllowed() {
        $this->logger->log('Access Not Allowed', 'error');
        include(self::ERROR_ROLE_NOT_ALLOWED);
        exit;
    }

    private function validatePage($page) {
        $allowedPages = ['home', 'login', 'logout', 'dashboard', 'activity', 'assessment', 'chapter', 'course', 'lessons', 'profile', 'result', 'scores', 'students', 'accounts', 'certificate'];
        $this->logger->log($page, 'info');
        if (!in_array($page, $allowedPages)) {
            $this->redirect(self::ERROR_FORBIDDEN);
        }
    }

    private function validateItem($item) {
        if ($item !== '' && (!is_numeric($item) || $item < 1)) {
            $this->redirect(self::ERROR_FORBIDDEN);
        }
    }

    private function redirect($errorView) {
        include($errorView);
        exit;
    }

    private function sanitizeInput($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
}

?>