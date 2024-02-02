<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <form id="Assessment" class="container flex-fill" method="post" action="<?php echo '?page=result&item='.$data['Activity'][0]['ActivityId'].'&action=true'; ?>">

        <div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">

            <h3><?php echo $data['Activity'][0]['ActivityTitle'];?></h3>
            <p><?php echo $data['Activity'][0]['ChapterTitle'];?>: <?php echo $data['Activity'][0]['LessonTitle'];?></p>

            <!-- DESCRIPTION -->
            <?php 
                if(!empty($data['Activity'][0]['ActivityDescription'])) {
                    echo '<h5 class="mt-4">Description</h5>';
                    echo '<p>'.$data['Activity'][0]['ActivityDescription'].'</p>';
                }
            ?>

            <!-- NOTES -->
            <?php 
                if(!empty($data['Activity'][0]['ActivityNotes'])) {
                    echo '<p>Note: <span class="text-danger">'.$data['Activity'][0]['ActivityNotes'].'</span></p>';
                }
            ?>

            <?php 
                if ($_SESSION['User_Role'] === "Teacher" || $_SESSION['User_Role'] === "Administrator"){
                    if((int)$data['Activity'][0]['ActivityIsViewSummary'] === 0){
                        echo '<div><button id="AssessmentViewSummaryBtn" type="button" class="btn btn-danger" data-tostate="1" data-activity="'.$data['Activity'][0]['ActivityId'].'">Enable View Result</button></div>';
                    } else {
                        echo '<div><button id="AssessmentViewSummaryBtn" type="button" class="btn btn-danger" data-tostate="0" data-activity="'.$data['Activity'][0]['ActivityId'].'">Disable View Result</button></div>';
                    }
                }
            ?>

            <input name="ActivityId" type="text" value="<?php echo $data['Activity'][0]['ActivityId']?>" readonly hidden>
            <input name="LessonId" type="text" value="<?php echo $data['Activity'][0]['LessonId']?>" readonly hidden>
        </div>

        <?php
            if ($_SESSION['User_Role'] === "Student") {
                if(!empty($data['Questions'])) {
                    $index = 0;
                    foreach ($data['Questions'] as $value) {
                        
                        echo '<div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">';
                        echo '    <p>Question: '.$value['Question'].'</p>';
                        echo '    <p class="text-warning">Points: '.$value['QuestionPoints'].'</p>';
                        if(isset($value['Image']) && !empty($value['Image'])){
                            echo '    <img src="'.$value['Image'].'" alt="">';
                        }
                        echo '    <div class="row">';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="'.$value['QuestionOptions'][0].'" type="radio" name="'.$value['QuestionId'].'" id="'.$value['QuestionId'].'-1" required '.(isset($data['Answers'][$index][0]) && $data['Answers'][$index][0] === $value['QuestionOptions'][0] ? 'checked' : '').'>';
                        echo '            <label class="form-check-label cursor-pointer" for="'.$value['QuestionId'].'-1">'.$value['QuestionOptions'][0].'</label>';
                        echo '        </div>';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="'.$value['QuestionOptions'][1].'" type="radio" name="'.$value['QuestionId'].'" id="'.$value['QuestionId'].'-2" required '.(isset($data['Answers'][$index][0]) && $data['Answers'][$index][0] === $value['QuestionOptions'][1] ? 'checked' : '').'>';
                        echo '            <label class="form-check-label cursor-pointer" for="'.$value['QuestionId'].'-2">'.$value['QuestionOptions'][1].'</label>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '    <div class="row mt-3">';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="'.$value['QuestionOptions'][2].'" type="radio" name="'.$value['QuestionId'].'" id="'.$value['QuestionId'].'-3" required '.(isset($data['Answers'][$index][0]) && $data['Answers'][$index][0] === $value['QuestionOptions'][2] ? 'checked' : '').'>';
                        echo '            <label class="form-check-label cursor-pointer" for="'.$value['QuestionId'].'-3">'.$value['QuestionOptions'][2].'</label>';
                        echo '        </div>';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="'.$value['QuestionOptions'][3].'" type="radio" name="'.$value['QuestionId'].'" id="'.$value['QuestionId'].'-4" required '.(isset($data['Answers'][$index][0]) && $data['Answers'][$index][0] === $value['QuestionOptions'][3] ? 'checked' : '').'>';
                        echo '            <label class="form-check-label cursor-pointer" for="'.$value['QuestionId'].'-4">'.$value['QuestionOptions'][3].'</label>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                        $index++;
                    }
                }
            } else {
                if (!empty($data['Questions'])) {
                    foreach ($data['Questions'] as $value) {
                        echo '<div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">';
                        echo '    <p>Question: ' . $value['Question'] . '</p>';
                        echo '    <p class="text-warning">Points: '.$value['QuestionPoints'].'</p>';
                        if (isset($value['Image']) && !empty($value['Image'])) {
                            echo '    <img src="' . $value['Image'] . '" alt="">';
                        }
                        echo '    <div class="row">';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="' . $value['QuestionOptions'][0] . '" type="radio" name="' . $value['QuestionId'] . '" id="' . $value['QuestionId'] . '-1" disabled '. ($value['QuestionOptions'][0] === $value['QuestionAnswer'] ? "checked" : "") . '>';
                        echo '            <label class="form-check-label cursor-pointer" for="' . $value['QuestionId'] . '-1">' . $value['QuestionOptions'][0] . '</label>';
                        echo '        </div>';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="' . $value['QuestionOptions'][1] . '" type="radio" name="' . $value['QuestionId'] . '" id="' . $value['QuestionId'] . '-2" disabled '. ($value['QuestionOptions'][1] === $value['QuestionAnswer'] ? "checked" : "") . '>';
                        echo '            <label class="form-check-label cursor-pointer" for="' . $value['QuestionId'] . '-2">' . $value['QuestionOptions'][1] . '</label>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '    <div class="row mt-3">';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="' . $value['QuestionOptions'][2] . '" type="radio" name="' . $value['QuestionId'] . '" id="' . $value['QuestionId'] . '-3" disabled '. ($value['QuestionOptions'][2] === $value['QuestionAnswer'] ? "checked" : "") . '>';
                        echo '            <label class="form-check-label cursor-pointer" for="' . $value['QuestionId'] . '-3">' . $value['QuestionOptions'][2] . '</label>';
                        echo '        </div>';
                        echo '        <div class="col">';
                        echo '            <input class="form-check-input cursor-pointer" value="' . $value['QuestionOptions'][3] . '" type="radio" name="' . $value['QuestionId'] . '" id="' . $value['QuestionId'] . '-4" disabled '. ($value['QuestionOptions'][3] === $value['QuestionAnswer'] ? "checked" : "") . '>';
                        echo '            <label class="form-check-label cursor-pointer" for="' . $value['QuestionId'] . '-4">' . $value['QuestionOptions'][3] . '</label>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                }
            }
        ?>
        <?php if ($_SESSION['User_Role'] === "Student") { ?>
            <div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">
                <button class="btn btn-primary w-25" type="submit">Submit Assessment</button>
            </div>
        <?php } ?>
    </form>
    
    <?php if ($_SESSION['User_Role'] === "Student") { ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('Assessment');

                form.addEventListener('change', function () {
                    const formData = new FormData(form);

                    form.querySelectorAll('input[type="radio"]').forEach(function (radio) {
                        const name = radio.getAttribute('name');

                        if (!formData.has(name)) {
                            formData.append(name, "");
                        }
                    });

                    fetch('<?php echo BASE_URL.'?page=assessment&item='.$item.'&action=true'; ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Success:', data);
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                });
            });
        </script>
    <?php } ?>