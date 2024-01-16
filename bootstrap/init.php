<?php

// Include configuration settings
require_once '../config/config.php';

// Autoload classes manually
spl_autoload_register(function ($class) {
    $classFile = '../app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});

// ... Additional initialization code

?>