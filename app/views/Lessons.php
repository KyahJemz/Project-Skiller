<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=course&item='.$data['Course'].'&course='.$data['Course'];?>"><?php echo $data['CourseDetails']['CourseName']?></a></li>
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=chapter&item='.$data['Lessons'][0]['ChapterId'].'&course='.$data['Course'];?>"><?php echo $data['Lessons'][0]['ChapterTitle'];?></a></li>
                  <li class="breadcrumb-item active"><?php echo $data['Lessons'][0]['LessonTitle'];?></li>
                </ol>
              </nav>
        </div>
        <div class="row p-4 bg-white rounded-3 d-flex flex-column">

            <h3><?php echo $data['Lessons'][0]['LessonTitle'];?></h3>
            <p>Chapter <?php echo $data['Lessons'][0]['ChapterId'];?>: <?php echo $data['Lessons'][0]['ChapterTitle'];?></p>
            <?php if ($_SESSION['User_Role'] === "Student") { 
                $Progress = number_format(((isset($data['Progress']['LessonProgress'][$data['Lessons'][0]['LessonId']]) ? $data['Progress']['LessonProgress'][$data['Lessons'][0]['LessonId']] : 0) / max($data['Progress']['LessonProgressTotal'][$data['Lessons'][0]['LessonId']], 1)) * 100, 2)?>
                <p>Lesson Overall Progress: <?php echo ((int)$Progress === 100 ? "<b>Complete</b>" : $Progress."%") ?></p>
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
                            echo '<li class="list-group-item py-3"><a href="'.BASE_URL.'?page=activity&item='.$row['ActivityId'].'&course='.$data['Course'].'">'.$row['ActivityTitle']. '</a></li>';
                        }
                        echo '</ul>';
                    }
                } elseif ($_SESSION['User_Role'] === "Administrator") {
                    echo '<div class="d-flex justify-content-between mt-4 mb-3">';
                    echo '    <h5 class="mr-auto">Activities</h5>';
                    echo '    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#AddActivity">Add Activity</button>';
                    echo '</div>';
                    if(!empty($data['Activities'][0])) {
                        echo '<ul class="list-group">';
                        foreach ($data['Activities'] as $row){
                            echo '<li class="list-group-item py-3"><a href="'.BASE_URL.'?page=assessment&item='.$row['ActivityId'].'&course='.$data['Course'].'">'.$row['ActivityTitle']. '</a><button class="edit-activity-btn btn btn-secondary" data-activityid="'.$row['ActivityId'].'" type="button" data-bs-toggle="modal" data-bs-target="#EditActivity">';
                            echo '      Edit';
                            echo '    </button></li>';
                        }
                        echo '</ul>';
                    }
                } else {
                    if(!empty($data['Activities'][0])) {
                        echo '<h5 class="mt-4">Activities</h5>';
                        echo '<ul class="list-group">';
                        foreach ($data['Activities'] as $row){
                            echo '<li class="list-group-item py-3"><a href="'.BASE_URL.'?page=assessment&item='.$row['ActivityId'].'&course='.$data['Course'].'">'.$row['ActivityTitle']. '</a></li>';
                        }
                        echo '</ul>';
                    }
                }
            ?>

        </div>
    </div>

    <div class="modal fade" id="EditActivity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Activity Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="activity-edit-success" class="text-success"></p>
                        <p id="activity-edit-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="activity-edit-title" class="col-form-label"><strong>Title:</strong></label>
                        <input type="text" name="activity-edit-title" class="form-control" id="activity-edit-title" placeholder="Title" required>
                        <p id="activity-edit-title-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="activity-edit-description" class="col-form-label"><strong>Description:</strong></label>
                        <textarea type="text" name="activity-edit-description" class="form-control" id="activity-edit-description" placeholder="Description" required></textarea>
                        <p id="activity-edit-description-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="activity-edit-notes" class="col-form-label"><strong>Notes:</strong></label>
                        <textarea type="text" name="activity-edit-notes" class="form-control" id="activity-edit-notes" placeholder="Notes (optional)" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="activity-edit-canviewsummary" class="col-form-label"><strong>Can View Summary:</strong></label>
                        <div class="form-check">
                            <input type="checkbox" name="activity-edit-canviewsummary" class="form-check-input" id="activity-edit-canviewsummary">
                            <label class="form-check-label" for="activity-edit-canviewsummary">Optional</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="activity-edit-id" class="form-control" id="activity-edit-id" require hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="ActivityDeleteBtnConfirmation" data-bs-toggle="modal" data-bs-target="#modalConfirmation" type="button" class="btn btn-danger">Delete</button>
                    <button id="ActivitySubmitEditBtn" type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal fade" id="AddActivity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Lesson Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="activity-add-success" class="text-success"></p>
                        <p id="activity-add-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="activity-title" class="col-form-label"><strong>Title:</strong></label>
                        <input type="text" name="activity-title" class="form-control" id="activity-title" placeholder="Title" required>
                        <p id="activity-title-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="activity-description" class="col-form-label"><strong>Description:</strong></label>
                        <textarea type="text" name="activity-description" class="form-control" id="activity-description" placeholder="Description" required></textarea>
                        <p id="activity-description-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="activity-notes" class="col-form-label"><strong>Notes:</strong></label>
                        <textarea type="text" name="activity-notes" class="form-control" id="activity-notes" placeholder="Notes (optional)" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="activity-canviewsummary" class="col-form-label"><strong>Can View Summary:</strong></label>
                        <div class="form-check">
                            <input type="checkbox" name="activity-canviewsummary" class="form-check-input" id="activity-canviewsummary">
                            <label class="form-check-label" for="activity-canviewsummary">Optional</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="activity-lessonid" class="form-control" id="activity-lessonid" value="<?php echo $data['Lessons'][0]['LessonId']?>" require hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="ActivitySubmitAddBtn" type="submit" class="btn btn-primary">Add Activity</button>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal fade" id="modalConfirmation" tabindex="-1" aria-labelledby="modalConfirmationLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmationLabel">Action Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="activity-delete-confirmation">Are you sure you want to delete this activity?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="ActivityDeleteBtn">Yes</button>
                </div>
            </div> 
        </div>
    </div>