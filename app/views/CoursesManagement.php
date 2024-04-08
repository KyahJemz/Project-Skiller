<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">
        <h2 class="mb-3">Skiller: Tutorial System - Courses Offered</h2>
        <div class="row">
            <div class="d-flex justify-content-between my-4">
                <h3 class="mr-auto"></h3>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddCourse">Add Course</button>
            </div>
        </div>
        <div id="MyCourses">
                <?php foreach ($data['OtherCourses'] as $key => $value) {
                    echo '<div class="courses-card d-flex" href="'.BASE_URL.'?page=course&item='.$value['Id'].'&course='.$value['Id'].'">';
                    echo '  <img height="150" width="150" src="'. BASE_URL . ($value['CourseImage'] ? $value['CourseImage'] : 'images/defaultCourse.jpg') . '" alt="image">';
                    echo '  <div class="w-100 p-3">';
                    echo '      <h5>'.$value['CourseName'].'</h5>';
                    echo '      <button class="edit-course-btn btn btn-secondary" data-courseid="'.$value['Id'].'" type="button" data-bs-toggle="modal" data-bs-target="#EditCourse">';
                    echo '          Edit';
                    echo '      </button>';
                    echo '      <a class=" btn btn-primary" href="'.BASE_URL.'?page=course&item='.$value['Id'].'&course='.$value['Id'].'">';
                    echo '          View';
                    echo '      </a>';
                    echo '      <p class="mt-2 mb-2 course-description">'.$value['CourseDescription'].'</p>';
                    echo '  </div>';
                    echo '</div>';
                } ?>
        </div>
    </div>

    <div class="modal fade" id="EditCourse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Course Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="course-edit-success" class="text-success"></p>
                        <p id="course-edit-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="course-edit-title" class="col-form-label"><strong>Course Title:</strong></label>
                        <input type="text" name="course-edit-title" class="form-control" id="course-edit-title" placeholder="Title" required>
                        <p id="course-edit-title-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="course-edit-description" class="col-form-label"><strong>Course Description:</strong></label>
                        <input type="text" name="course-edit-description" class="form-control" id="course-edit-description" placeholder="Optional">
                        <p id="course-edit-description-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="course-edit-image" class="col-form-label"><strong>Course Image:</strong></label>
                        <input type="file" name="course-edit-image" class="form-control" id="course-edit-image" placeholder="Optional">
                        <p id="course-edit-image-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="course-edit-id" class="form-control" id="course-edit-id" require hidden>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="CourseDeleteBtnConfirmation" data-bs-toggle="modal" data-bs-target="#modalConfirmation" type="button" class="btn btn-danger">Delete</button>
                    <button id="CourseSubmitEditBtn" type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal fade" id="AddCourse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="course-add-success" class="text-success"></p>
                        <p id="course-add-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="course-title" class="col-form-label"><strong>Course Title:</strong></label>
                        <input type="text" name="course-title" class="form-control" id="course-title" placeholder="Title" required>
                        <p id="course-title-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3"> 
                        <label for="course-description" class="col-form-label"><strong>Course Description:</strong></label>
                        <input type="text" name="course-description" class="form-control" id="course-description" placeholder="Optional">
                        <p id="course-description-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="course-image" class="col-form-label"><strong>Course Image:</strong></label>
                        <input type="file" name="course-image" class="form-control" id="course-image">
                        <p id="course-image-note" class="text-danger"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="CourseSubmitAddBtn" type="submit" class="btn btn-primary">Add Course</button>
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
                    <p id="course-delete-confirmation">Are you sure you want to delete this course?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="CourseDeleteBtn">Yes</button>
                </div>
            </div> 
        </div>
    </div>