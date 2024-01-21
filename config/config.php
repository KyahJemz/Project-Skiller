<?php

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'BCASH');
define('DB_PASSWORD', '#12Characters');
define('DB_NAME', 'skillerdb');

// Other configurations
define('BASE_URL', 'http://localhost/public/');  
define('SITE_NAME', 'Skiller: Tutorial System');

// ... Other configuration constants



// ####################################################
//
//      DATABASE
//
//     1. tbl_accounts Table:
//          Id (int, length: 11)
//          Email (varchar, length: 50)
//          Image (text)
//          FirstName (varchar, length: 50)
//          MiddleName (varchar, length: 50)
//          LastName (varchar, length: 50)
//          Role (varchar, length: 25, default: 'Student')
//          Timestamp (timestamp)
//
//    2. tbl_activity Table:
//          Id (int, length: 11)
//          Lesson_Id (int, length: 11)
//          Question (text)
//          Options (text)
//          CorrectAnswer (text)
//
//    3. tbl_inprogress Table:
//          Account_Id (int, length: 11)
//          Lesson_Id (int, length: 11)
//          Activity_Id (int, length: 11)
//          Questions (text)
//          Answers (int, length: 11)
//          LastAttempt (timestamp)
//
//    4. tbl_lessons Table:
//          Id (int, length: 11)
//          Title (varchar, length: 100)
//          Chapter (int, length: 11)
//          Content (text)
//
//    5. tbl_results Table:
//          Activity_Id (int, length: 11)
//          Lesson_Id (int, length: 11)
//          Account_Id (int, length: 11)
//          Score (varchar, length: 5)
//          Total (varchar, length: 5)
//          Timestamp (timestamp)
//
// ####################################################







?>