<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=course';?>">Course</a></li>
                  <li class="breadcrumb-item active"><?php echo $data['ChapterRaw'][0]['Title'];?></li>
                </ol>
              </nav>
        </div>

        <div class="row">
            <h3><?php echo $data['ChapterRaw'][0]['Title'];?></h3>
            <p>Chapter: <?php echo $data['ChapterRaw'][0]['Title'];?></p>
        </div>

        <div class="row">
            <div class="d-flex justify-content-between my-4">
                <h4 class="mr-auto">Lessons:</h4>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddLesson">Add Lesson</button>
            </div>
        </div>

        <div class="accordion " id="accordionPanelsStayOpenExample">

            <?php 
                foreach ($data['Chapter'] as $row) {
                    echo '<div class="accordion-item mb-2">';
                    echo '    <h2 class="accordion-header">';
                    echo '    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a'.$row['LessonId'].'" aria-expanded="false" aria-controls="a'.$row['LessonId'].'">';
                    echo $row['LessonTitle'];
                    echo '    </button>';
                    echo '    <button class="edit-lesson-btn btn btn-secondary" data-lessonid="'.$row['LessonId'].'" type="button" data-bs-toggle="modal" data-bs-target="#EditLesson">';
                    echo '      Edit';
                    echo '    </button>';
                    echo '    </h2>';
                    echo '    <div id="a'.$row['LessonId'].'" class="accordion-collapse collapse">';
                    echo '        <div class="accordion-body">';
                
                    if(!empty($row['LessonDescription']))
                    echo '          <strong class="pb-2">'.$row['LessonTitle'].'</strong>';
                    echo '          </br>';
                    echo            nl2br($row['LessonDescription']);
                    echo '          </br>';
                    echo '          <a class="btn btn-primary class="mt-2" href="'.BASE_URL.'?page=lessons&item='.$row['LessonId'].'">View</a>';
                    echo '          </br></br>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>

    <div class="modal fade" id="EditLesson" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Lesson Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="lesson-edit-success" class="text-success"></p>
                        <p id="lesson-edit-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-edit-title" class="col-form-label"><strong>Lesson Title:</strong></label>
                        <input type="text" name="lesson-edit-title" class="form-control" id="lesson-edit-title" placeholder="Title" required>
                        <p id="lesson-edit-title-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-edit-description" class="col-form-label"><strong>Lesson Description:</strong></label>
                        <textarea type="text" name="lesson-edit-description" class="form-control" id="lesson-edit-description" placeholder="Description" required></textarea>
                        <p id="lesson-edit-description-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-edit-objectives" class="col-form-label"><strong>Lesson Objectives:</strong></label>
                        <textarea type="text" name="lesson-edit-objectives" class="form-control" id="lesson-edit-objectives" placeholder="Objectives" required></textarea>
                        <p id="lesson-edit-objectives-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-edit-video" class="col-form-label"><strong>Lesson Video:</strong></label>
                        <textarea type="text" name="lesson-edit-video" class="form-control" id="lesson-edit-video" placeholder="Video Link (optional)"></textarea>
                        <p id="lesson-edit-video-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-edit-image" class="col-form-label"><strong>Lesson Image:</strong></label>
                        <input type="file" name="lesson-edit-image" class="form-control" id="lesson-edit-image" placeholder="Image (optional)">
                    </div>
                    <div class="mb-3">
                        <label for="lesson-edit-content" class="col-form-label"><strong>Lesson Content:</strong></label>
                        <textarea type="text" name="lesson-edit-content" class="form-control" id="lesson-edit-content" placeholder="Content (optional)"></textarea>
                        <p id="lesson-edit-content-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="lesson-edit-id" class="form-control" id="lesson-edit-id" require hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="LessonDeleteBtnConfirmation" data-bs-toggle="modal" data-bs-target="#modalConfirmation" type="button" class="btn btn-danger">Delete</button>
                    <button id="LessonSubmitEditBtn" type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal fade" id="AddLesson" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Lesson Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="lesson-add-success" class="text-success"></p>
                        <p id="lesson-add-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-title" class="col-form-label"><strong>Title:</strong></label>
                        <input type="text" name="lesson-title" class="form-control" id="lesson-title" placeholder="Title" required>
                        <p id="lesson-title-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-description" class="col-form-label"><strong>Description:</strong></label>
                        <textarea type="text" name="lesson-description" class="form-control" id="lesson-description" placeholder="Description" required></textarea>
                        <p id="lesson-description-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-objectives" class="col-form-label"><strong>Objectives:</strong></label>
                        <textarea type="text" name="lesson-objectives" class="form-control" id="lesson-objectives" placeholder="Objectives" required></textarea>
                        <p id="lesson-objectives-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-video" class="col-form-label"><strong>Video:</strong></label>
                        <textarea type="text" name="lesson-video" class="form-control" id="lesson-video" placeholder="Video Link (optional)"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lesson-image" class="col-form-label"><strong>Image:</strong></label>
                        <input type="file" name="lesson-image" class="form-control" id="lesson-image" placeholder="Image (optional)">
                    </div>
                    <div class="mb-3">
                        <label for="lesson-content" class="col-form-label"><strong>Content:</strong></label>
                        <textarea type="text" name="lesson-content" class="form-control" id="lesson-content" placeholder="Content (optional)"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="lesson-chapterid" class="form-control" id="lesson-chapterid" value="<?php echo $data['ChapterRaw'][0]['Id']?>" require hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="LessonSubmitAddBtn" type="submit" class="btn btn-primary">Add Lesson</button>
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
                    <p id="lesson-delete-confirmation">Are you sure you want to delete this lesson?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="LessonDeleteBtn">Yes</button>
                </div>
            </div> 
        </div>
    </div>