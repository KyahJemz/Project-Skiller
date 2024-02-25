<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">
        <?php if ($_SESSION['User_Role'] === "Teacher") {?>
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=students';?>">My Students</a></li>
                      <li class="breadcrumb-item active">Profile</li>
                    </ol>
                  </nav>
            </div>
        <?php } elseif ($_SESSION['User_Role'] === "Administrator") { ?>
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=accounts';?>">Accounts</a></li>
                      <li class="breadcrumb-item active">Profile</li>
                    </ol>
                  </nav>
            </div>
        <?php }?>

        <div class="row p-4 bg-white rounded-3">
            <h3 class="row">Profile</h3>
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <img class="w-100 mb-3 rounded-3 border" src="<?php echo $data['image']?>" alt="Profile Image">
                </div>
                <div class="col-lg-9">
                    <div class="mb-3">
                        <label for="profileForm1" class="form-label">Full Name</label>
                        <input type="text" value="<?php echo $data['name']?>" class="form-control" id="profileForm1" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label for="profileForm2" class="form-label">Email</label>
                        <input type="email" value="<?php echo $data['email']?>" class="form-control" id="profileForm2" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label for="profileForm3" class="form-label">Role</label>
                        <input type="text" value="<?php echo $data['role']?>" class="form-control" id="profileForm3" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label for="profileForm4" class="form-label">Section</label>
                        <input type="text" value="<?php echo $data['group']?>" class="form-control" id="profileForm4" readonly disabled>
                    </div>
                </div>
            </div>
            <?php 
                if ($data['role'] === "Student") {
            ?>
                <?php 
                    if ($_SESSION['User_Role'] === "Teacher" || $_SESSION['User_Role'] === "Administrator") {
                ?>
                    <h4 class="row mt-5 border-top pt-3">Actions</h4>
                    <div class="d-flex justify-content-between">
                        <div class="mr-auto">
                            <a class="btn btn-primary px-3" href="<?php echo BASE_URL.'?page=scores&item='.$data['id'] ?>">View Assessments</a>
                        </div>
                        <div class="">
                            <button data-bs-toggle="modal" data-bs-target="#modalConfirmation" class="btn btn-danger px-3">Reset Account Progress</button>
                            <button id="ProfileDisableAccountButton" class="btn btn-danger px-3" data-account="<?php echo $data['id']?>" data-currentstate="<?php echo $data['disabled'] ?>"><?php echo $data['disabled']===0?'Disable':'Enable' ?> Account</button>
                        </div>
                    </div>
                <?php 
                    }
                ?>

                    <h4 class="row mt-5 border-top pt-3">Student Progress</h4>
                    <div class="row">
                        <?php 
                            $TotalProgressPercentage = number_format(((isset($data['Progress']['FullProgress']) ? $data['Progress']['FullProgress'] : 0) / max($data['Progress']['FullProgressTotal'], 1)) * 100, 2);
                            echo '<div class="progress p-0">';
                            $TotalChaptersCount = sizeof($data['Chapters']);
                            foreach ($data['Chapters'] as $chapter) {
                                $ChapterPercentage = number_format(((isset($data['Progress']['ChapterProgress'][$chapter["Id"]]) ? $data['Progress']['ChapterProgress'][$chapter["Id"]] : 0) / max($data['Progress']['ChapterProgressTotal'][$chapter["Id"]], 1)) * 100, 2);
                                $adjustedWidth = (int)($ChapterPercentage * ((100 / $TotalChaptersCount)/100));
                                echo '<div class="progress-bar '.getNextBgColor().'" role="progressbar" style="width: '.$adjustedWidth.'%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><strong>'.$ChapterPercentage.'%</strong></div>';
                            }
                            echo '</div>';
                            echo '<p class="mb-3 mt-2">Overall progress: <strong>'.$TotalProgressPercentage.'%</strong><p>';
        
        
                            echo '<div class="row">';
                            foreach ($data['Chapters'] as $chapter) {
                                $ChapterPercentage = number_format(((isset($data['Progress']['ChapterProgress'][$chapter["Id"]]) ? $data['Progress']['ChapterProgress'][$chapter["Id"]] : 0) / max($data['Progress']['ChapterProgressTotal'][$chapter["Id"]], 1)) * 100, 2);
                                echo '<h6><span class="badge ' . getNextBgColor() . '">#</span>' . $chapter['Title'] . ' - '.$ChapterPercentage.'%</h6>';
                            }
                            echo '</div>';
                        ?>
                    </div>
            <?php 
                } else {
                    if (($_SESSION['User_Role'] === "Teacher" || $_SESSION['User_Role'] === "Administrator") && ($_SESSION['User_Id'] !== $data['id'])) {
            ?>
                        <h4 class="row mt-5 border-top pt-3">Actions</h4>
                        <div class="d-flex justify-content-between">
                            <div class="mr-auto">

                            </div>
                            <div class="">
                                <button id="ProfileDisableAccountButton" class="btn btn-danger px-3" data-account="<?php echo $data['id']?>" data-currentstate="<?php echo $data['disabled'] ?>"><?php echo $data['disabled']===0?'Disable':'Enable' ?> Account</button>
                            </div>
                        </div>
            <?php 
                    }
                }
            ?>
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
                    <p>Are you sure you want to clear the students progress?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="ProfileResetAccountButton" data-account="<?php echo $data['id']?>">Yes</button>
                </div>
            </div> 
        </div>
    </div>