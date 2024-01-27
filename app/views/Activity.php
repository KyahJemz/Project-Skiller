<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=course';?>">Home</a></li>
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=chapter&item='.$data['Activity'][0]['ChapterId'];?>"><?php echo $data['Activity'][0]['ChapterTitle'];?></a></li>
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=lessons&item='.$data['Activity'][0]['LessonId'];?>"><?php echo $data['Activity'][0]['LessonTitle'];?></a></li>
                  <li class="breadcrumb-item active"><?php echo $data['Activity'][0]['ActivityTitle'];?></li>
                </ol>
              </nav>
        </div>
        <div class="row p-4 bg-white rounded-3 d-flex flex-column">

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

            <!-- HasRecentProgress -->
            <?php 
                if(empty($data['Progress'])) {
                    echo '<a class="btn btn-primary" href="">Take Assessment</a>';
                } else {
                    echo '<a class="btn btn-primary" href="">Continue Last Attempt - '.$data['Progress'][0]['ActivityLastAttempt'].'</a>';
                }
            ?>

        </div>
    </div>