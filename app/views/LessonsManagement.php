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
                    echo '    <button class="edit-chapter-btn btn btn-secondary" data-lessonid="'.$row['LessonId'].'" type="button" data-bs-toggle="modal" data-bs-target="#EditLesson">';
                    echo '      Edit';
                    echo '    </button>';
                    echo '    </h2>';
                    echo '    <div id="a'.$row['LessonId'].'" class="accordion-collapse collapse">';
                    echo '        <div class="accordion-body">';
                
                    if(!empty($row['LessonDescription']))
                    echo '          <strong class="pb-2">'.$row['LessonTitle'].'</strong>';
                    echo '          </br>';
                    echo            $row['LessonDescription'];
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Chapter Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="chapter-edit-success" class="text-success"></p>
                        <p id="student-edit-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="chapter-edit-title" class="col-form-label"><strong>Chapter Title:</strong></label>
                        <input type="text" name="chapter-edit-title" class="form-control" id="chapter-edit-title" placeholder="Title" required>
                        <p id="chapter-edit-title-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="chapter-edit-codes" class="col-form-label"><strong>Chapter Codes:</strong></label>
                        <input type="text" name="chapter-edit-codes" class="form-control" id="chapter-edit-codes" placeholder="Optional">
                        <p id="chapter-edit-codes-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="chapter-edit-id" class="form-control" id="chapter-edit-id" require hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="ChapterDeleteBtnConfirmation" data-bs-toggle="modal" data-bs-target="#modalConfirmation" type="button" class="btn btn-danger">Delete</button>
                    <button id="ChapterSubmitEditBtn" type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal fade" id="AddLesson" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Chapter Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="chapter-add-success" class="text-success"></p>
                        <p id="chapter-add-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="chapter-title" class="col-form-label"><strong>Chapter Title:</strong></label>
                        <input type="text" name="chapter-title" class="form-control" id="chapter-title" placeholder="Title" required>
                        <p id="chapter-title-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="chapter-codes" class="col-form-label"><strong>Chapter Codes:</strong></label>
                        <input type="text" name="chapter-codes" class="form-control" id="chapter-codes" placeholder="Optional">
                        <p id="chapter-codes-note" class="text-danger"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="ChapterSubmitAddBtn" type="submit" class="btn btn-primary">Add Chapter</button>
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
                    <p id="chapter-delete-confirmation">Are you sure you want to delete this chapter?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="ChapterDeleteBtn">Yes</button>
                </div>
            </div> 
        </div>
    </div>