<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <?php if ($_SESSION['User_Role'] === "Teacher") {?>
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=students';?>">My Students</a></li>
                      <li class="breadcrumb-item"><a class="text-dark" href="#" onclick="window.history.go(-2)"><?php echo $data['lastname']?></a></li>
                      <li class="breadcrumb-item"><a class="text-dark" href="#" onclick="window.history.back()">Assessments</a></li>
                      <li class="breadcrumb-item active">Result</li>
                    </ol>
                  </nav>
            </div>
        <?php } elseif ($_SESSION['User_Role'] === "Administrator") {?>
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=accounts';?>">Accounts</a></li>
                    <li class="breadcrumb-item"><a class="text-dark" href="#" onclick="window.history.go(-2)"><?php echo $data['lastname']?></a></li>
                    <li class="breadcrumb-item"><a class="text-dark" href="#" onclick="window.history.back()">Assessments</a></li>
                    <li class="breadcrumb-item active">Result</li>
                </ol>
                </nav>
        </div>
        <?php } else {?>
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=course&item='.$data['Course'].'&course='.$data['Course'];?>"><?php echo $data['CourseDetails']['CourseName']?></a></li>
                        <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=chapter&item='.$data['Activity'][0]['ChapterId'].'&course='.$data['Course'];?>"><?php echo $data['Activity'][0]['ChapterTitle'];?></a></li>
                        <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=lessons&item='.$data['Activity'][0]['LessonId'].'&course='.$data['Course'];?>"><?php echo $data['Activity'][0]['LessonTitle'];?></a></li>
                        <li class="breadcrumb-item active"><?php echo $data['Activity'][0]['ActivityTitle'];?></li>
                    </ol>
                </nav>
            </div>
        <?php }?>

        <div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">

            <h3><?php echo $data['Activity'][0]['ActivityTitle'];?></h3>
            <p><?php echo $data['Activity'][0]['ChapterTitle'];?>: <?php echo $data['Activity'][0]['LessonTitle'];?></p>

            <!-- DESCRIPTION -->
            <?php 
                if(!empty($data['Activity'][0]['ActivityDescription'])) {
                    echo '<h5 class="mt-4">Description</h5>';
                    echo '<p>'.nl2br($data['Activity'][0]['ActivityDescription']).'</p>';
                }
            ?>

            <!-- NOTES -->
            <?php 
                if(!empty($data['Activity'][0]['ActivityNotes'])) {
                    echo '<p>Note: <span class="text-danger">'.nl2br($data['Activity'][0]['ActivityNotes']).'</span></p>';
                }
            ?>

            <!-- SCORE -->
            <?php 
                $lastResult = end($data['Result']);
                $lastResultId = $lastResult['Id'];

                $score = $lastResult['Score'];
                $total = $lastResult['Total'];
                $averageScore = ($total > 0) ? round(($score / $total) * 100, 2) : 0;

                $colorClass = '';

                if ($averageScore >= 85) {
                    $colorClass = 'text-success'; // green
                } elseif ($averageScore >= 75) {
                    $colorClass = 'text-warning'; // yellow
                } else {
                    $colorClass = 'text-danger'; // red
                }

                echo '<p>Scored <span class="' . $colorClass . '"><strong>' . $score .'</strong></span> out of <strong>'. $total .' items</strong>, with an average of <span class="' . $colorClass . '"><strong>'.$averageScore.'%</strong></span></p>';

                echo '<p>Retakes: <strong>' . (sizeof($data['PastAttempts']) - 1) . '</strong></p>';

                if ($_SESSION['User_Role'] === "Teacher" || $_SESSION['User_Role'] === "Administrator"){
                    if($lastResult['IsRetake'] === 0){
                        echo '<div><button id="ResultRetakeBtn" class="btn btn-danger" data-tostate="Enable" data-result="'.$lastResult['Id'].'">Enable Retake</button></div>';
                    } else {
                        echo '<div><button id="ResultRetakeBtn" class="btn btn-danger" data-tostate="Disable" data-result="'.$lastResult['Id'].'">Disable Retake</button></div>';
                    }
                }
            ?>

            <!-- NEXT LESSON -->
            <?php 
                if($_SESSION['User_Role'] === "Student") {
                    if ((int)$data['Result'][0]['Lesson_Id'] === 21){
                        echo '<div><a class="btn btn-primary" href="'.BASE_URL.'?page=course&item='.$data['Course'].'&course='.$data['Course'].'">Back To Course</a></div>';
                    } else {
                        echo '<div><a class="btn btn-primary" href="'.BASE_URL.'?page=lessons&item='. $data['LessonNextToAccess'].'">Go to next lesson</a></div>';
                    }
                }
            ?>
        </div>

        <?php
            if ((int)$data['Activity'][0]['ActivityIsViewSummary'] === 1){
                if (!empty($data['Summary'])) {
                    foreach ($data['Summary'] as $value) {
                        echo '<div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">';
                        echo '    <p>Question: ' . $value->Question . '</p>';
                        if ((int)$value->QuestionIsCorrect === 0) {
                            echo '    <p>Score: <strong class="text-danger">0/' . $value->QuestionPoints . '</strong></p>';
                        } else {
                            echo '    <p>Score: <strong class="text-success">' . $value->QuestionPoints . '/' . $value->QuestionPoints . '</strong></p>';
                        }
                        if (isset($value->Image) && !empty($value->Image)) {
                            echo '    <img src="' . $value->Image . '" alt="">';
                        }
                        echo '    <div class="row">';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="' . $value->QuestionOption1 . '" type="radio" name="' . $value->QuestionId . '" id="' . $value->QuestionId . '-1" disabled '. ($value->QuestionOption1 === $value->QuestionAnswer ? "checked" : "") . '>';
                        echo '            <label class="form-check-label cursor-pointer" for="' . $value->QuestionId . '-1">' . $value->QuestionOption1 . '</label>';
                        echo '        </div>';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="' . $value->QuestionOption2 . '" type="radio" name="' . $value->QuestionId . '" id="' . $value->QuestionId . '-2" disabled '. ($value->QuestionOption2 === $value->QuestionAnswer ? "checked" : "") . '>';
                        echo '            <label class="form-check-label cursor-pointer" for="' . $value->QuestionId . '-2">' . $value->QuestionOption2 . '</label>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '    <div class="row mt-3">';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="' . $value->QuestionOption3 . '" type="radio" name="' . $value->QuestionId . '" id="' . $value->QuestionId . '-3" disabled '. ($value->QuestionOption3 === $value->QuestionAnswer ? "checked" : "") . '>';
                        echo '            <label class="form-check-label cursor-pointer" for="' . $value->QuestionId . '-3">' . $value->QuestionOption3 . '</label>';
                        echo '        </div>';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="' . $value->QuestionOption4 . '" type="radio" name="' . $value->QuestionId . '" id="' . $value->QuestionId . '-4" disabled '. ($value->QuestionOption4 === $value->QuestionAnswer ? "checked" : "") . '>';
                        echo '            <label class="form-check-label cursor-pointer" for="' . $value->QuestionId . '-4">' . $value->QuestionOption4 . '</label>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                }
            } else {
                echo '<div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">';
                echo '    <p>Summary not allowed to be viewed, contact your teacher if this was a mistake.</p>';
                echo '</div>';
            }
        ?>

    </div>