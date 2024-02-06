<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=course';?>">Course</a></li>
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=chapter&item='.$data['Lessons'][0]['ChapterId'];?>"><?php echo $data['Lessons'][0]['ChapterTitle'];?></a></li>
                  <li class="breadcrumb-item active"><?php echo $data['Lessons'][0]['LessonTitle'];?></li>
                </ol>
              </nav>
        </div>
        <div class="row p-4 bg-white rounded-3 d-flex flex-column">

            <h3><?php echo $data['Lessons'][0]['LessonTitle'];?></h3>
            <p>Chapter <?php echo $data['Lessons'][0]['ChapterId'];?>: <?php echo $data['Lessons'][0]['ChapterTitle'];?></p>
            <?php if ($_SESSION['User_Role'] === "Student") { ?>
                <p>Progress: <?php echo number_format(((isset($data['Progress']['LessonProgress'][$data['Lessons'][0]['LessonId']]) ? $data['Progress']['LessonProgress'][$data['Lessons'][0]['LessonId']] : 0) / max($data['Progress']['LessonProgressTotal'][$data['Lessons'][0]['LessonId']], 1)) * 100, 2).'%'  ?></p>
            <?php } ?>

            <!-- OBJECTIVES -->
            <?php 
                if(!empty($data['Lessons'][0]['LessonObjective'])) {
                    echo '<h5 class="mt-4">Objectives</h5>';
                    echo '<p>'.nl2br($data['Lessons'][0]['LessonObjective']).'</p>';
                }
            ?>

            <!-- VIDEO -->
            <?php 
                if(!empty($data['Lessons'][0]['LessonVideo'])) {
                    echo '<h5 class="mt-4">Video Presentation</h5>';
                    echo '<div class="video-container">';
                    echo '  <iframe class="w-100" src="'.$data['Lessons'][0]['LessonVideo'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                    echo '</div>';
                }
            ?>

            <!-- CONTENT -->
            <?php 
                if(!empty($data['Lessons'][0]['LessonContent'])) {
                    echo '<h5 class="mt-4">Lesson</h5>';
                    echo '<div class="">';
                    echo '<span>'.nl2br($data['Lessons'][0]['LessonContent']).'</span>';
                    echo '</div>';
                }
            ?>

            <!-- ACTIVITIES -->
            <?php 
                if($_SESSION['User_Role'] === "Student") {
                    if(!empty($data['Activities'][0])) {
                        echo '<h5 class="mt-4">Activities</h5>';
                        echo '<ul class="list-group">';
                        foreach ($data['Activities'] as $row){
                            echo '<li class="list-group-item py-3"><a href="'.BASE_URL.'?page=activity&item='.$row['ActivityId'].'">'.$row['ActivityTitle']. '</a></li>';
                        }
                        echo '</ul>';
                    }
                } else {
                    if(!empty($data['Activities'][0])) {
                        echo '<h5 class="mt-4">Activities</h5>';
                        echo '<ul class="list-group">';
                        foreach ($data['Activities'] as $row){
                            echo '<li class="list-group-item py-3"><a href="'.BASE_URL.'?page=assessment&item='.$row['ActivityId'].'">'.$row['ActivityTitle']. '</a></li>';
                        }
                        echo '</ul>';
                    }
                }
            ?>

        </div>
    </div>