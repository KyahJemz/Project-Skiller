<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <form class="container flex-fill" method="post" action="<?php echo '?page=result&item='.$data['Activity'][0]['ActivityId'].'&action=true'; ?>">

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
            <input name="ActivityId" type="text" value="<?php echo $data['Activity'][0]['ActivityId']?>" readonly hidden>
        </div>

        <?php
            if(!empty($data['Questions'])) {
                foreach ($data['Questions'] as $value) {
                    echo '<div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">';
                    echo '    <p>Question: '.$value['Question'].'</p>';
                    if(isset($value['Image']) && !empty($value['Image'])){
                        echo '    <img src="'.$value['Image'].'" alt="">';
                    }
                    echo '<div class="row">';
                    echo '        <div class="col">';
                    echo '            <input class="form-check-input cursor-pointer" value="'.$value['QuestionOptions'][0].'" type="radio" name="'.$value['QuestionId'].'" id="'.$value['QuestionId'].'-1" required>';
                    echo '            <label class="form-check-label cursor-pointer" for="'.$value['QuestionId'].'-1">'.$value['QuestionOptions'][0].'</label>';
                    echo '        </div>';
                    echo '        <div class="col">';
                    echo '            <input class="form-check-input cursor-pointer" value="'.$value['QuestionOptions'][1].'" type="radio" name="'.$value['QuestionId'].'" id="'.$value['QuestionId'].'-2" required>';
                    echo '            <label class="form-check-label cursor-pointer" for="'.$value['QuestionId'].'-2">'.$value['QuestionOptions'][1].'</label>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '    <div class="row mt-3">';
                    echo '        <div class="col">';
                    echo '            <input class="form-check-input cursor-pointer" value="'.$value['QuestionOptions'][2].'" type="radio" name="'.$value['QuestionId'].'" id="'.$value['QuestionId'].'-3" required>';
                    echo '            <label class="form-check-label cursor-pointer" for="'.$value['QuestionId'].'-3">'.$value['QuestionOptions'][2].'</label>';
                    echo '        </div>';
                    echo '        <div class="col">';
                    echo '            <input class="form-check-input cursor-pointer" value="'.$value['QuestionOptions'][3].'" type="radio" name="'.$value['QuestionId'].'" id="'.$value['QuestionId'].'-4" required>';
                    echo '            <label class="form-check-label cursor-pointer" for="'.$value['QuestionId'].'-4">'.$value['QuestionOptions'][3].'</label>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            }
        ?>

        <div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">
            <button class="btn btn-primary w-25" type="submit">Submit Assessment</button>
        </div>

       
    </form>