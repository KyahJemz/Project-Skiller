<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=course&item='.$data['Course'].'&course='.$data['Course'];?>"><?php echo $data['CourseDetails']['CourseName']?></a></li>
                  <li class="breadcrumb-item active"><?php echo $data['ChapterRaw'][0]['Title'];?></li>
                </ol>
              </nav>
        </div>

        <div class="row">
            <h3><?php echo $data['ChapterRaw'][0]['Title'];?></h3>
            <p>Chapter: <?php echo $data['ChapterRaw'][0]['Title'];?></p>
            <?php if ($_SESSION['User_Role'] === "Student") { 
                $progress = number_format(((isset($data['Progress']['ChapterProgress'][$data['Chapter'][0]['ChapterId']]) ? $data['Progress']['ChapterProgress'][$data['Chapter'][0]['ChapterId']] : 0) / max($data['Progress']['ChapterProgressTotal'][$data['Chapter'][0]['ChapterId']], 1)) * 100, 2);
            ?>
                <p><?php echo ((int)$progress === 100 ? "Progress: <b>Chapter Complete</b>" : "Progress: ".$progress."%")?></p>
            <?php } ?>
        </div>

        <div class="accordion " id="accordionPanelsStayOpenExample">

            <?php 
                if($_SESSION['User_Role'] === "Student") {
                    foreach ($data['Chapter'] as $row) {
                        $LessonProgress = number_format(((isset($data['Progress']['LessonProgress'][$row["LessonId"]]) ? $data['Progress']['LessonProgress'][$row['LessonId']] : 0) / max($data['Progress']['LessonProgressTotal'][$row["LessonId"]], 1)) * 100, 2);
                        echo '<div class="accordion-item mb-2">';
                        echo '    <h2 class="accordion-header">';
                        echo '    <button class="accordion-button '.((int)$LessonProgress === 100 ? "collapsed" : "").'" type="button" data-bs-toggle="collapse" data-bs-target="#a'.$row['LessonId'].'" aria-expanded="'.((int)$LessonProgress === 100 ? "true" : "false").'" aria-controls="a'.$row['LessonId'].'">';
                        
                        echo $row['LessonTitle'] . ' -&nbsp;'.((int)$LessonProgress === 100 ? "<b>Complete</b>" :  "Progress: ".$LessonProgress."%");
                        echo '    </button>';
                        echo '    </h2>';
                        echo '    <div id="a'.$row['LessonId'].'" class="accordion-collapse collapse '.((int)$LessonProgress === 100 ? "" : "show").'">';
                        echo '        <div class="accordion-body">';
                    
                        if(!empty($row['LessonDescription']))
                        echo '          <strong class="pb-2">'.$row['LessonTitle'].'</strong>';
                        echo '          </br>';
                        echo            $row['LessonDescription'];
                        echo '          </br>';
                        if(CheckLesson($row["LessonId"])){
                            echo '<a class="btn btn-primary mt-2" href="'.BASE_URL.'?page=lessons&item='.$row['LessonId'].'&course='.$data['Course'].'">View</a>';
                        } else {
                            echo '<a class="btn btn-secondary mt-2">Locked</a>';
                        }
                        echo '          </br></br>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    foreach ($data['Chapter'] as $row) {
                        echo '<div class="accordion-item mb-2">';
                        echo '    <h2 class="accordion-header">';
                        echo '    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a'.$row['LessonId'].'" aria-expanded="true" aria-controls="a'.$row['LessonId'].'">';
                        
                        echo $row['LessonTitle'];
                        echo '    </button>';
                        echo '    </h2>';
                        echo '    <div id="a'.$row['LessonId'].'" class="accordion-collapse collapse show">';
                        echo '        <div class="accordion-body">';
                    
                        if(!empty($row['LessonDescription']))
                        echo '          <strong class="pb-2">'.$row['LessonTitle'].'</strong>';
                        echo '          </br>';
                        echo            $row['LessonDescription'];
                        echo '          </br>';
                        echo '          <a class="btn btn-primary class="mt-2" href="'.BASE_URL.'?page=lessons&item='.$row['LessonId'].'&course='.$data['Course'].'">View</a>';
                        echo '          </br></br>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </div>