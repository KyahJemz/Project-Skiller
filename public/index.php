<?php

// ############################ //
//   SKILLER: Tutorial System   //
//            v1.0              //
// ############################ //


// START -----------------------// 


// COMPOSER LOAD
require '../vendor/autoload.php';

// SYSTEM LOAD
require_once '../config/Config.php';
require_once '../config/Database.php';
require_once '../config/Router.php';
require_once '../classes/Logger.php';

// UTILS LOAD
require_once '../utils/input_validation.php';
require_once '../utils/session.php';
require_once '../utils/date_format.php';
require_once '../utils/colors.php';

// SESSION START
session_start();

// UPDATE CLASS DIRECTORIES
spl_autoload_register(function ($class) {
    $classFile = '../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});

// Other Files
$logger = new Logger();

// MAIN START
$router = new Router($logger);
$router->route();


// END -----------------------// 

?>