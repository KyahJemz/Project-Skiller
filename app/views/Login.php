<body class="d-flex flex-column">
    <div id="g_id_onload"
        data-client_id="106693984653-dc8s4o77v1du13jm1oilb652bk1o20jv.apps.googleusercontent.com"
        data-context="signin"
        data-ux_mode="popup"
        data-callback="handleCredentialResponse"
        data-nonce=""
        data-auto_prompt="false">
    </div>

    <section class="h-100 ">
        <div class="px-4 py-5 px-md-5 text-center d-flex justify-content-center align-items-center text-lg-start h-100" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-7 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight text-primary">Skiller Tutorial System</h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                        The Skiller Tutorial System is designed for senior high school students, covering all subjects aligned with the K-12 curriculum mandated by the Department of Education in the Philippines. Our platform offers tailored support across various subjects, ensuring comprehensive coverage and adherence to curriculum guidelines. Whether it's Mathematics, Science, English, or any other subject, Skiller Tutorial System provides a structured and supportive online learning environment for students to excel in their studies.
                        </p>
                    </div>

                    <div class="col-lg-5 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <div>
                                    <div class="row py-2">
                                        <a href="<?php echo BASE_URL ?>" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                                            <svg class="bi me-2" width="300" height="100" role="img" aria-label="Bootstrap"><image href="<?php echo BASE_URL . 'images/logo-full-black.png'; ?>" width="300" height="100"/></svg>
                                        </a>
                                    </div>

                                    <div class="form-outline mb-0">
                                        <p>Sign in with your registered Email</p>
                                    </div>

                                    <?php 
                                        if (isset($data['error'])){
                                            echo '<div class="form-outline mb-2 text-danger">';
                                            echo '<p>'.$data['error'].'</p>';
                                            echo '</div>';
                                        }
                                    ?>

                                    <div class="form-outline d-flex justify-content-center mb-4">
                                        <div class="g_id_signin"
                                            data-type="standard"
                                            data-shape="rectangular"
                                            data-theme="filled_blue"
                                            data-text="continue_with"
                                            data-size="large"
                                            data-logo_alignment="left"
                                            >
                                        </div>
                                    </div>

                                    <div class="form-outline d-flex justify-content-center mb-1 login-or">
                                        <div class="text">or</div>
                                        <div class="line"></div>
                                    </div>

                                    <p class="text-center">Registration</p>

                                    <div class="form-outline d-flex flex-column mb-4">
                                        <div class=" w-100 d-flex justify-content-between mb-2 gap-2">
                                            <input id="signup-firstname" class="w-100" type="text" placeholder="FirstName" required>
                                            <input id="signup-lastname" class="w-100" type="text" placeholder="LastName" required>
                                        </div>
                                        <div class=" d-flex mb-2 w-100"><input id="signup-email" class="flex w-100" type="email" placeholder="Email" required></div>
                                        <div class=" d-flex w-100"> <input id="SignUpBtn" class="w-100 btn btn-primary" type="submit" value="Sign-Up"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    
    <script src="https://accounts.google.com/gsi/client" async></script>
    <script type="module" src="<?php echo BASE_URL . 'js/Default.js' ?>"></script>
