<?php 

function RefreshAccessibleContents($ContentList) {
    $Chapters = [];
    $Lessons = [];

    $lessonAccess = true;

    for ($i=0; $i < (int)$_SESSION['CurrentLesson']; $i++) { 

        if (!in_array($ContentList[$i]['ChapterId'], $Chapters)) {
            $Chapters[] = $ContentList[$i]['ChapterId'];
        }

        if (!in_array($ContentList[$i]['LessonId'], $Lessons)) {
            $Lessons[] = $ContentList[$i]['LessonId'];
        }
    }

    updateAccessibleContents([
        'AllowedChapters' => $Chapters,
        'AllowedLessons' => $Lessons,
    ]);
}

function CheckLesson($LessonId){
    if($_SESSION['User_Role'] === 'Student' ){
        if (in_array($LessonId, $_SESSION['AllowedLessons'])) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

?>