<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">
        <?php if ($_SESSION['User_Role'] === "Teacher") {?>
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=students';?>">My Students</a></li>
                      <li class="breadcrumb-item active"><?php echo $data['lastname']?></li>
                    </ol>
                  </nav>
            </div>
        <?php } elseif ($_SESSION['User_Role'] === "Administrator") { ?>
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="text-dark" href="<?php echo BASE_URL .'?page=accounts';?>">Accounts</a></li>
                      <li class="breadcrumb-item active"><?php echo $data['lastname']?></li>
                    </ol>
                  </nav>
            </div>
        <?php }?>

        <div class="row p-4 bg-white rounded-3">
            <h3 class="row">Profile</h3>    
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <img class="w-100 mb-3 rounded-3 border profilePicture" src="<?php echo $data['image']?>" alt="Profile Image">
                </div>
                <div class="col-lg-9">
                    <div class="mb-3">
                        <label for="profileForm1" class="form-label">Full Name</label>
                        <input type="text" value="<?php echo titleCase($data['name'])?>" class="form-control" id="profileForm1" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label for="profileForm2" class="form-label">Email</label>
                        <input type="email" value="<?php echo $data['email']?>" class="form-control" id="profileForm2" readonly disabled>
                    </div>
                    <div class="mb-3">
                        <label for="profileForm3" class="form-label">Role</label>
                        <input type="text" value="<?php echo $data['role']?>" class="form-control" id="profileForm3" readonly disabled>
                    </div>
                </div>
            </div>
            <?php 
                if ($data['role'] === "Student") {
            ?>
                <?php 
                    if ($_SESSION['User_Role'] === "Administrator") {
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
            <?php 
                } else {
                    if (($_SESSION['User_Role'] === "Administrator") && ($_SESSION['User_Id'] !== $data['id'])) {
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