<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row p-4 bg-white rounded-3 d-flex flex-column">

            <h3 class="mb-4">Assessment Scores</h3>

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
                        echo '<p>You scored <strong>'.$TotalScore.'</strong> out of <strong>'.$TotalItems.'</strong> total items in <strong>'.$TotalActivities.'</strong> assessments, with an total average of <strong>'.$ScoreAverage.'%</strong></p>';
                    } else {
                        echo '<p>All of your finished assessments can be viewed here. Don\'t see anything? Then start taking assessments.</p>';
                    }
                    
                ?>
            </div>

            <!-- ACTIVITIES -->
            <?php 
                if(!empty($data['Activities'][0])) {
                    echo '<ul class="list-group">';
                    foreach ($data['Activities'] as $row){
                        echo '<li class="list-group-item py-3">';
                        echo '      <div class="row">';
                        echo '              <div class="col"><strong><a href="'.BASE_URL.'?page=activity&item='.$row['ActivityId'].'">'.$row['ActivityTitle']. '</a></strong></div>';
                        echo '              <div class="col">Score: <strong>'.$row['Score'].'/'.$row['Total'].'</strong></div>';
                        echo '      </div>';
                        echo '      <div class="row">';
                        echo '              <div>'.$row['LessonTitle'].'</p>';
                        echo '      </div>';
                        echo '</li>';
                    }
                    echo '</ul>';
                }
            ?>
        </div>
    </div>