<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">
        <h2 class="mb-3">Skiller: Tutorial System - General Mathematics</h2>
        <?php if ($_SESSION['User_Role'] === "Student") { ?>
            <p>Course Progress: <?php echo number_format(((isset($data['Progress']['FullProgress']) ? $data['Progress']['FullProgress'] : 0) / max($data['Progress']['FullProgressTotal'], 1)) * 100, 2).'%' ?></p>
        <?php } ?>
        <div class="accordion " id="accordionPanelsStayOpenExample">
            <?php 
                if($_SESSION['User_Role'] === "Student") {
                    foreach ($data['Chapters'] as $row) {
                        $ChapterProgress = number_format(((isset($data['Progress']['ChapterProgress'][$row["Id"]]) ? $data['Progress']['ChapterProgress'][$row["Id"]] : 0) / max($data['Progress']['ChapterProgressTotal'][$row["Id"]], 1)) * 100, 2);
                        echo '<div class="accordion-item mb-2">';
                        echo '    <h2 class="accordion-header">';
                        echo '    <button class="accordion-button '.((int)$ChapterProgress === 100 ? "collapsed" : "").'" type="button" data-bs-toggle="collapse" data-bs-target="#a'.$row['Id'].'" aria-expanded="'.((int)$ChapterProgress === 100 ? "true" : "false").'" aria-controls="a'.$row['Id'].'">';
                        echo $row['Title'] . ' - Progress: ' . $ChapterProgress . '%';
                        echo '    </button>';
                        echo '    </h2>';
                        echo '    <div id="a'.$row['Id'].'" class="accordion-collapse collapse '.((int)$ChapterProgress === 100 ? "" : "show").'">';
                        echo '        <div class="accordion-body">';
                        foreach ($data['Lessons'] as $row2){
                            if ($row2['ChapterId'] === $row['Id']){
                                $LessonProgress = number_format(((isset($data['Progress']['LessonProgress'][$row2["LessonId"]]) ? $data['Progress']['LessonProgress'][$row2["LessonId"]] : 0) / max($data['Progress']['LessonProgressTotal'][$row2["LessonId"]], 1)) * 100, 2);
                                echo '<strong class="pb-2">'.$row2['LessonTitle'].'</strong>' . ' - Progress: ' . $LessonProgress . '%';
                                echo '</br>';
                                echo nl2br($row2['LessonDescription']);
                                echo '</br>';
                                echo '<a class="btn btn-primary class="mt-2" href="'.BASE_URL.'?page=lessons&item='.$row2['LessonId'].'">View</a>';
                                echo '</br></br>';
                            }
                        }
                        echo '              Scope: '.$row['Codes'];
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                } else {
                    foreach ($data['Chapters'] as $row) {
                        echo '<div class="accordion-item mb-2">';
                        echo '    <h2 class="accordion-header">';
                        echo '    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a'.$row['Id'].'" aria-expanded="true" aria-controls="a'.$row['Id'].'">';
                        echo $row['Title'];
                        echo '    </button>';
                        echo '    </h2>';
                        echo '    <div id="a'.$row['Id'].'" class="accordion-collapse collapse show">';
                        echo '        <div class="accordion-body">';
                        foreach ($data['Lessons'] as $row2){
                            if ($row2['ChapterId'] === $row['Id']){
                                echo '<strong class="pb-2">'.$row2['LessonTitle'].'</strong>';
                                echo '</br>';
                                echo nl2br($row2['LessonDescription']);
                                echo '</br>';
                                echo '<a class="btn btn-primary class="mt-2" href="'.BASE_URL.'?page=lessons&item='.$row2['LessonId'].'">View</a>';
                                echo '</br></br>';
                            }
                        }
                        echo '              Scope: '.$row['Codes'];
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                }
                
            ?>
        </div>
    </div>