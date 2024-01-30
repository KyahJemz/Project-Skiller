<?php

function isLoggedIn() {
    return isset($_SESSION['User_Id']);
}

function createSession($params){
    $_SESSION['User_Id'] = $params['User_Id'];
    $_SESSION['User_Email'] = $params['User_Email'];
    $_SESSION['User_Image'] = $params['User_Image'];
    $_SESSION['User_FirstName'] = $params['User_FirstName'];
    $_SESSION['User_MiddleName'] = $params['User_MiddleName'];
    $_SESSION['User_LastName'] = $params['User_LastName'];
    $_SESSION['User_Group'] = $params['User_Group'];
    $_SESSION['User_Role'] = $params['User_Role'];
}

function logout() {

    session_unset();
    session_destroy();

    header("Location: ".BASE_URL);
    exit();
}
?>