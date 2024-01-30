<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row p-4 bg-white rounded-3 d-flex flex-column">

            <h3>Scores</h3>
           

            <!-- ACTIVITIES -->
            <?php 
                if(!empty($data['Activities'][0])) {
                    echo '<h5 class="mt-4">Activities</h5>';
                    echo '<ul class="list-group">';
                    foreach ($data['Activities'] as $row){
                        echo '<li class="list-group-item py-3"><a href="'.BASE_URL.'?page=activity&item='.$row['ActivityId'].'">'.$row['ActivityTitle']. '</a></li>';
                    }
                    echo '</ul>';
                }
            ?>

        </div>
    </div>