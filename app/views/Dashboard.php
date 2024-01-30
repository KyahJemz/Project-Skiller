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

            <div class="row p-3 rounded-3">
                <h3>Your Progress: </h3>
                <?php 
                    $TotalProgressPercentage = number_format(((isset($data['Progress']['FullProgress']) ? $data['Progress']['FullProgress'] : 0) / max($data['Progress']['FullProgressTotal'], 1)) * 100, 2);
                    echo '<div class="progress">';
                    echo '    <div class="progress-bar bg-primary" role="progressbar" style="width: '.number_format(((isset($data['Progress']['ChapterProgress'][1]) ? $data['Progress']['ChapterProgress'][1] : 0) / max($data['Progress']['ChapterProgressTotal'][1], 1)) * 100, 2).'%" aria-valuenow="'.(isset($data['Progress']['ChapterProgress'][1]) ? $data['Progress']['ChapterProgress'][1] : 0).'" aria-valuemin="0" aria-valuemax="'.$data['Progress']['ChapterProgressTotal'][1].'"></div>';
                    echo '    <div class="progress-bar bg-success" role="progressbar" style="width: '.number_format(((isset($data['Progress']['ChapterProgress'][2]) ? $data['Progress']['ChapterProgress'][2] : 0) / max($data['Progress']['ChapterProgressTotal'][2], 1)) * 100, 2).'%" aria-valuenow="'.(isset($data['Progress']['ChapterProgress'][2]) ? $data['Progress']['ChapterProgress'][2] : 0).'" aria-valuemin="0" aria-valuemax="'.$data['Progress']['ChapterProgressTotal'][2].'"></div>';
                    echo '    <div class="progress-bar bg-danger" role="progressbar" style="width: '.number_format(((isset($data['Progress']['ChapterProgress'][3]) ? $data['Progress']['ChapterProgress'][3] : 0) / max($data['Progress']['ChapterProgressTotal'][3], 1)) * 100, 2).'%" aria-valuenow="'.(isset($data['Progress']['ChapterProgress'][3]) ? $data['Progress']['ChapterProgress'][3] : 0).'" aria-valuemin="0" aria-valuemax="'.$data['Progress']['ChapterProgressTotal'][3].'"></div>';
                    echo '    <div class="progress-bar bg-warning" role="progressbar" style="width: '.number_format(((isset($data['Progress']['ChapterProgress'][4]) ? $data['Progress']['ChapterProgress'][4] : 0) / max($data['Progress']['ChapterProgressTotal'][4], 1)) * 100, 2).'%" aria-valuenow="'.(isset($data['Progress']['ChapterProgress'][4]) ? $data['Progress']['ChapterProgress'][4] : 0).'" aria-valuemin="0" aria-valuemax="'.$data['Progress']['ChapterProgressTotal'][4].'"></div>';
                    echo '    <div class="progress-bar bg-info" role="progressbar" style="width: '.number_format(((isset($data['Progress']['ChapterProgress'][5]) ? $data['Progress']['ChapterProgress'][5] : 0) / max($data['Progress']['ChapterProgressTotal'][5], 1)) * 100, 2).'%" aria-valuenow="'.(isset($data['Progress']['ChapterProgress'][5]) ? $data['Progress']['ChapterProgress'][5] : 0).'" aria-valuemin="0" aria-valuemax="'.$data['Progress']['ChapterProgressTotal'][5].'"></div>';

                    // echo '    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="'.(isset($data['Progress']['FullProgress']) ? $data['Progress']['FullProgress'] : 0).'" aria-valuemin="0" aria-valuemax="'.$data['Progress']['FullProgressTotal'].'" style="width: '.$TotalProgressPercentage.'%"></div>';
                    echo '</div>';
                ?>

                <?php 
                    foreach ($data['Chapters'] as $row) {
                        $ChapterProgress = number_format(((isset($data['Progress']['ChapterProgress'][$row["Id"]]) ? $data['Progress']['ChapterProgress'][$row["Id"]] : 0) / max($data['Progress']['ChapterProgressTotal'][$row["Id"]], 1)) * 100, 2);
                        echo '<div class="accordion-item mb-2">';
                        echo '    <h2 class="accordion-header">';
                        echo '    <button class="accordion-button '.((int)$ChapterProgress === 100 ? "collapsed" : "").'" type="button" data-bs-toggle="collapse" data-bs-target="#a'.$row['Id'].'" aria-expanded="'.((int)$ChapterProgress === 100 ? "true" : "false").'" aria-controls="a'.$row['Id'].'">';
                        echo $row['Title'] . ' - Progress: ' . $ChapterProgress . '%';
                        echo '    </button>';
                        echo '    </h2>';
                        echo '    <div id="a'.$row['Id'].'" class="accordion-collapse collapse '.((int)$ChapterProgress === 100 ? "" : "show").'">';
                        echo '        <div class="accordion-body">';
                        foreach ($data['Lessons'] as $row2){
                            if ($row2['ChapterId'] === $row['Id']){
                                $LessonProgress = number_format(((isset($data['Progress']['LessonProgress'][$row2["LessonId"]]) ? $data['Progress']['LessonProgress'][$row2["LessonId"]] : 0) / max($data['Progress']['LessonProgressTotal'][$row2["LessonId"]], 1)) * 100, 2);
                                echo '<strong class="pb-2">'.$row2['LessonTitle'].'</strong>' . ' - Progress: ' . $LessonProgress . '%';
                                echo '</br>';
                                echo $row2['LessonDescription'];
                                echo '</br>';
                                echo '<a class="btn btn-primary class="mt-2" href="'.BASE_URL.'?page=lessons&item='.$row2['LessonId'].'">View</a>';
                                echo '</br></br>';
                            }
                        }
                        echo '              Scope: '.$row['Codes'];
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>