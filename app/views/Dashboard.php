<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    
    <div class="container flex-fill">
        <h3>Hello, <?php echo $data['User_Name']?>! 👋</h3>

        <div class="row my-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">

            <div id="myCarousel" class="carousel slide mt-3 mb-6" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4" class=""></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5" class=""></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img class="bd-placeholder-img" id="home1" width="100%" height="300" src="<?php echo BASE_URL . 'images/home1.jpg' ?>"/>
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>Exciting New Features Unveiled!</h1>
                                <p>Discover the latest enhancements and tools to elevate your learning experience.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img class="bd-placeholder-img" id="home1" width="100%" height="300" src="<?php echo BASE_URL . 'images/home2.jpg' ?>"/>
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1 class="shadow-lg">Success Stories from Skiller Users</h1>
                                <p class="">Explore inspiring stories of learners who achieved success with the Skiller Tutorial System.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="bd-placeholder-img" id="home1" width="100%" height="300" src="<?php echo BASE_URL . 'images/home3.jpg' ?>"/>
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>Upcoming Live Events and Workshops</h1>
                                <p >Join us for live events and workshops covering advanced topics and interactive learning sessions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="bd-placeholder-img" id="home1" width="100%" height="300" src="<?php echo BASE_URL . 'images/home4.jpg' ?>"/>
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>Subject Spotlight: General Mathematics Mastery</h1>
                                <p>Master the fundamentals of General Mathematics with our comprehensive tutorials and practice sessions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="bd-placeholder-img" id="home1" width="100%" height="300" src="<?php echo BASE_URL . 'images/home5.jpg' ?>"/>
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>Monthly Challenge: Test Your Skills!</h1>
                                <p>Participate in our monthly challenge to test your knowledge and win exciting rewards.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="row mt-3 p-3 rounded-3">
                <h3>Skiller: Tutorial System</h3>
                <p>The Skiller Tutorial System caters to senior high school students, specifically focusing on the subject of General Mathematics. Aligned with the K-12 curriculum mandated by the Department of Education in the Philippines, the platform is tailored to meet the academic needs of senior high school learners. By adhering to the curriculum guidelines, Skiller Tutorial System ensures comprehensive coverage of relevant topics, providing a structured and supportive online learning environment for students to excel in their General Mathematics studies.</p>
            </div>

            <?php if ($_SESSION['User_Role'] === "Teacher") { ?>
                   
            <?php } elseif ($_SESSION['User_Role'] === "Administrator"){ ?>
                
            <?php } else { ?>
                <div class="row p-3 rounded-3">
                    <h3>Your Progress: </h3>
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
                        echo '<p class="mb-3 mt-2">Overall progress: <strong>'.((int)$TotalProgressPercentage === 100 ? "Completed": $TotalProgressPercentage."%").'</strong><p>';


                        echo '<div class="row">';
                        foreach ($data['Chapters'] as $chapter) {
                            $ChapterPercentage = number_format(((isset($data['Progress']['ChapterProgress'][$chapter["Id"]]) ? $data['Progress']['ChapterProgress'][$chapter["Id"]] : 0) / max($data['Progress']['ChapterProgressTotal'][$chapter["Id"]], 1)) * 100, 2);
                            echo '<h5><a href="'.BASE_URL.'?page=chapter&item='.$chapter['Id'].'"><span class="badge ' . getNextBgColor() . '">#</span>&nbsp;' . $chapter['Title'] . '</a> - '.((int)$ChapterPercentage === 100 ? "Completed": $ChapterPercentage."%").'</h5>';
                            echo '<div class="row px-5">';
                            echo '<ul class="ml-5 px-5">';
                            foreach ($data['Lessons'] as $lesson) {
                                if ($lesson['ChapterId'] === $chapter['Id']) {
                                    echo '<li><p class="ml-5">' . $lesson['LessonTitle'] . '</p></li>';
                                }
                            }
                            echo '</ul>';
                            echo '</div>';
                        }
                        echo '</div>';
                    ?>
                </div>
            <?php } ?>

        </div>
    </div>