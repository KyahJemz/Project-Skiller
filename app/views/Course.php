<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">
        <h2 class="mb-3">Skiller: Tutorial System - General Mathematics</h2>

        <div class="accordion " id="accordionPanelsStayOpenExample">
            <?php 
                foreach ($data['Chapters'] as $row) {
                    echo '<div class="accordion-item mb-2">';
                    echo '    <h2 class="accordion-header">';
                    echo '    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a'.$row['Id'].'" aria-expanded="true" aria-controls="a'.$row['Id'].'">';
                    echo $row['Title'] . ' - Progress: 20%';
                    echo '    </button>';
                    echo '    </h2>';
                    echo '    <div id="a'.$row['Id'].'" class="accordion-collapse collapse show">';
                    echo '        <div class="accordion-body">';
                    foreach ($data['Lessons'] as $row2){
                        if ($row2['ChapterId'] === $row['Id']){
                            echo '<strong class="pb-2">'.$row2['LessonTitle'].'</strong>' . ' - Progress: 20%';
                            echo '</br>';
                            echo $row2['LessonDescription'];
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
            ?>
        </div>
    </div>