<?php 

function RefreshAccessibleContents($ContentList) {
    $LessonsTemplates = [];
    $Lessons = [];

    $lessonAccess = true;

    foreach ($ContentList as $value) {
        $LessonsTemplates[$value['CourseId']][] = $value['LessonId'];
    }
    
    foreach ($_SESSION['CurrentLesson'] as $key => $value) {
        for ($i=0; $i < $value; $i++) { 
            if(isset($LessonsTemplates[$key][$i])) {
                $Lessons[] = (int)$LessonsTemplates[$key][$i];
            }
        }
    }

    updateAccessibleContents([
        'AllowedLessons' => $Lessons,
    ]);
}

function CheckLesson($LessonId){
    if($_SESSION['User_Role'] === 'Student' ){
        if (in_array((int)$LessonId, $_SESSION['AllowedLessons'])) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

?>