<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=course';?>">Course</a></li>
                  <li class="breadcrumb-item active"><?php echo $data['Chapter'][0]['ChapterTitle'];?></li>
                </ol>
              </nav>
        </div>

        <div class="row">
            <h3><?php echo $data['Chapter'][0]['ChapterTitle'];?></h3>
            <p>Chapter <?php echo $data['Chapter'][0]['ChapterId'];?>: <?php echo $data['Chapter'][0]['ChapterTitle'];?></p>
        </div>

        <div class="accordion " id="accordionPanelsStayOpenExample">

            <?php 
                foreach ($data['Chapter'] as $row) {
                    echo '<div class="accordion-item mb-2">';
                    echo '    <h2 class="accordion-header">';
                    echo '    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a'.$row['LessonId'].'" aria-expanded="true" aria-controls="a'.$row['LessonId'].'">';
                    echo '        Lesson: '.$row['LessonTitle'] . ' - Progress: 20%';
                    echo '    </button>';
                    echo '    </h2>';
                    echo '    <div id="a'.$row['LessonId'].'" class="accordion-collapse collapse show">';
                    echo '        <div class="accordion-body">';
                   
                    if(!empty($row['LessonDescription']))
                    echo '<strong class="pb-2">'.$row['LessonTitle'].'</strong>';
                    echo '</br>';
                    echo $row['LessonDescription'];
                    echo '</br>';
                    echo '<a class="btn btn-primary class="mt-2" href="'.BASE_URL.'?page=lessons&item='.$row['LessonId'].'">View</a>';
                    echo '</br></br>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>