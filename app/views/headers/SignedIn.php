    <header class="p-3 border-bottom fixed-top bg-body">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="<?php echo BASE_URL ?>" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="150" height="32" role="img" aria-label="Bootstrap"><image href="<?php echo BASE_URL . 'images/logo-full-black.png'; ?>" width="150" height="32"/></svg>
                </a>
                <?php if ($_SESSION['User_Role'] === "Teacher") { ?>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="<?php echo BASE_URL . '?page=dashboard'; ?>" class="nav-link px-2 link-body-emphasis">Dashboard</a></li>
                        <li><a href="<?php echo BASE_URL . '?page=students'; ?>" class="nav-link px-2 link-body-emphasis">My Students</a></li>
                        <li><a href="<?php echo BASE_URL . '?page=course'; ?>" class="nav-link px-2 link-body-emphasis">Course</a></li>
                    </ul>
                <?php } elseif ($_SESSION['User_Role'] === "Administrator"){ ?>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="<?php echo BASE_URL . '?page=dashboard'; ?>" class="nav-link px-2 link-body-emphasis">Dashboard</a></li>
                        <li><a href="<?php echo BASE_URL . '?page=accounts'; ?>" class="nav-link px-2 link-body-emphasis">Accounts</a></li>
                        <li><a href="<?php echo BASE_URL . '?page=course'; ?>" class="nav-link px-2 link-body-emphasis">Course</a></li>
                    </ul>
                <?php } else { ?>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="<?php echo BASE_URL . '?page=dashboard'; ?>" class="nav-link px-2 link-body-emphasis">Dashboard</a></li>
                        <li><a href="<?php echo BASE_URL . '?page=course'; ?>" class="nav-link px-2 link-body-emphasis">Course</a></li>
                        <li><a href="<?php echo BASE_URL . '?page=scores'; ?>" class="nav-link px-2 link-body-emphasis">Scores</a></li>
                    </ul>
                <?php } ?>

                <?php if ($_SESSION['User_Role'] === "Teacher") { ?>
                   
                <?php } elseif ($_SESSION['User_Role'] === "Administrator"){ ?>
                    
                <?php } else { ?>
                    
                <?php } ?>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $_SESSION['User_Image']; ?>" alt="x" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" style="">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL.'?page=profile&item='.$_SESSION['User_Id'] ?>">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL.'?page=logout' ?>">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <header class="p-5"></header>