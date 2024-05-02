<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">
        <?php if ($_SESSION['User_Role'] === "Administrator") {?>
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=accounts';?>">Accounts</a></li>
                      <li class="breadcrumb-item"><a class="text-dark" href="#" onclick="window.history.back()"><?php echo $data['lastname'];?></a></li>
                      <li class="breadcrumb-item active">Assessments</li>
                    </ol>
                  </nav>
            </div>
        <?php }?>

        <div class="row p-4 bg-white rounded-3 d-flex flex-column">

            <h3 class="mb-4">Assessment Scores</h3>

            <?php if (empty($data['HasCourse'])) { ?>
                <div id="MyCourses">
                    <?php foreach ($data['MyCourses'] as $key => $value) {
                        echo '<a class="courses-card d-flex" href="'.BASE_URL.'?page=scores&item='.$item.'&course='.$value['Id'].'">';
                        echo '  <img height="150" width="150" src="'. BASE_URL . ($value['CourseImage'] ? $value['CourseImage'] : 'images/defaultCourse.jpg') . '" alt="image">';
                        echo '  <div class="w-100 p-3">';
                        echo '      <h5>'.$value['CourseName'].'</h5>';
                        echo '      <p class="mt-2 mb-2 course-description">'.$value['CourseDescription'].'</p>';
                        echo '  </div>';
                        echo '</a>';
                    } ?>
                </div>
            <?php } else { ?>
                <div class="row mb-2">
                <?php 
                    if(!empty($data['Activities'][0])) {
                        $TotalActivities = 0;
                        $TotalScore = 0;
                        $TotalItems = 0;
                        foreach ($data['Activities'] as $row){
                            $TotalScore += (int)$row['Score'];
                            $TotalItems += (int)$row['Total'];
                            $TotalActivities += 1;
                        }
                        $ScoreAverage = number_format(($TotalScore / max($TotalItems, 1)) * 100, 2);
                        if ($_SESSION['User_Role'] === "Teacher" || $_SESSION['User_Role'] === "Administrator") {
                            echo '<p>This student scored <strong>'.$TotalScore.'</strong> out of <strong>'.$TotalItems.'</strong> total items in <strong>'.$TotalActivities.'</strong> assessments, with an total average of <strong>'.$ScoreAverage.'%</strong></p>';
                        } else {
                            echo '<p>You scored <strong>'.$TotalScore.'</strong> out of <strong>'.$TotalItems.'</strong> total items in <strong>'.$TotalActivities.'</strong> assessments, with an total average of <strong>'.$ScoreAverage.'%</strong></p>';
                        }
                    } else {
                        if ($_SESSION['User_Role'] === "Teacher" || $_SESSION['User_Role'] === "Administrator") {
                            echo '<p>This student finished assessments can be viewed here. Don\'t see anything? Then the student is not taking assessments.</p>';
                        } else {
                            echo '<p>All of your finished assessments can be viewed here. Don\'t see anything? Then start taking assessments.</p>';
                        }
                    }
                ?>
            </div>

                <?php 
                if(!empty($data['Activities'][0])) {
                    echo '<ul class="list-group">';
                    foreach ($data['Activities'] as $row){
                        echo '<li class="list-group-item py-3">';
                        echo '      <div class="row">';
                        if($_SESSION['User_Role'] === "Teacher" || $_SESSION['User_Role'] === "Administrator" ) {
                            echo '              <div class="col"><strong><a href="'.BASE_URL.'?page=result&item='.$row['ResultId'].'&course='.$data['HasCourse'].'">'.$row['ActivityTitle']. '</a></strong></div>';   
                        } else {
                            echo '              <div class="col"><strong><a href="'.BASE_URL.'?page=activity&item='.$row['ActivityId'].'&course='.$data['HasCourse'].'">'.$row['ActivityTitle']. '</a></strong></div>';
                        }
                        echo '              <div class="col">';
                        echo '                  Score: <strong>'.$row['Score'].'/'.$row['Total'].'</strong>';
                        echo '              </div>';
                        echo '      </div>';
                        echo '      <div class="row">';
                        echo '              <div>'.$row['LessonTitle'].'</p>';
                        echo ' Date Taken: <strong>'.toFullDateAndTime($row['TimeStarted']).'</strong><br>';
                        echo ' Date Finished: <strong>'.toFullDateAndTime($row['Timestamp']).'</strong>';
                        echo '      </div>';
                        echo '</li>';
                    }
                    echo '</ul>';
                }
            ?>
            <?php } ?>

            
          
        </div>
    </div>