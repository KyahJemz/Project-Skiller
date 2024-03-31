<?php 
    if($data['CanTake'] !== true && !empty($data['Result'])){
        $lastResult = end($data['Result']);
        $lastResultId = $lastResult['Id'];
        header('Location: ' . BASE_URL . '?page=result&item='.$lastResultId.'&course='.$data['Course']);
        exit;
    }
?>

<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=course'.'&course='.$data['Course'];?>"><?php echo $data['CourseDetails']['CourseName']?></a></li>
                    <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=chapter&item='.$data['Activity'][0]['ChapterId'].'&course='.$data['Course'];?>"><?php echo $data['Activity'][0]['ChapterTitle'];?></a></li>
                    <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=lessons&item='.$data['Activity'][0]['LessonId'].'&course='.$data['Course'];?>"><?php echo $data['Activity'][0]['LessonTitle'];?></a></li>
                    <li class="breadcrumb-item active"><?php echo $data['Activity'][0]['ActivityTitle'];?></li>
                </ol>
            </nav>
        </div>
        <div class="row p-4 bg-white rounded-3 d-flex flex-column align-items-center">

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

            <!-- HasRecentProgress -->
            <?php 

                    if(empty($data['Progress'])) {
                        if(empty($data['Result'])) {
                            echo '<div class="w-25">';
                            echo '<a class="btn btn-primary" href="'.BASE_URL.'?page=assessment&item='.$data['Activity'][0]['ActivityId'].'&course='.$data['Course'].'">Take Assessment</a>';
                            echo '</div>';
                        } else {
                            echo '<div class="w-25">';
                            echo '<a class="btn btn-primary" href="'.BASE_URL.'?page=assessment&item='.$data['Activity'][0]['ActivityId'].'&course='.$data['Course'].'">Retake Assessment</a>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="w-25">';
                        echo '  <a class="btn btn-primary" href="'.BASE_URL.'?page=assessment&item='.$data['Progress'][0]['ActivityId'].'&course='.$data['Course'].'">Continue Last Attempt<br><span class="font-italic">'.toFullDateAndTime($data['Progress'][0]['ActivityLastAttempt']).'</span></a>';
                        echo '</div>';
                    }
              
            ?>

        </div>
    </div>