<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    
    <div class="container flex-fill">
        <h3>Hello, <?php echo $data['User_Name']?>! 👋</h3>

        <div class="row my-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">

            <div id="myCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
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
                <p>The Skiller Tutorial System is designed for senior high school students, covering all subjects aligned with the K-12 curriculum mandated by the Department of Education in the Philippines. Our platform offers tailored support across various subjects, ensuring comprehensive coverage and adherence to curriculum guidelines. Whether it's Mathematics, Science, English, or any other subject, Skiller Tutorial System provides a structured and supportive online learning environment for students to excel in their studies.</p>
            </div>

            <hr>

            <?php if ($_SESSION['User_Role'] === "Student") { ?>
            
                <div class="row p-3 rounded-3">
                    <h3>Lets Start Learning</h3>
                    <div id="MyCourses">
                        <?php 
                        if(!empty($data['MyCourses'])){
                            foreach ($data['MyCourses'] as $key => $value) {
                                $TotalProgressPercentage = number_format(((isset($value['Progress']['FullProgress']) ? $value['Progress']['FullProgress'] : 0) / max($value['Progress']['FullProgressTotal'], 1)) * 100, 2);
                                $TotalChaptersCount = sizeof($value['Chapters']);
                                echo '<a class="courses-card d-flex" href="'.BASE_URL.'?page=course&item='.$value['Details']['Id'].'&course='.$value['Details']['Id'].'">';
                                echo '  <img height="150" width="150" src="'. BASE_URL . ($value['Details']['CourseImage'] ? $value['Details']['CourseImage'] : 'images/defaultCourse.jpg') . '" alt="image">';
                                echo '  <div class="w-100 p-3">';
                                echo '      <h5>'.$value['Details']['CourseName'].'</h5>';
                                echo '      <div class="mt-2 mb-2">Your Progress: '.$TotalProgressPercentage.'%</div>';
                                echo '      <div class="progress p-0 w-100">';
                                foreach ($value['Chapters'] as $chapter) {
                                    $ChapterPercentage = number_format(((isset($value['Progress']['ChapterProgress'][$chapter["Id"]]) ? $value['Progress']['ChapterProgress'][$chapter["Id"]] : 0) / max($value['Progress']['ChapterProgressTotal'][$chapter["Id"]], 1)) * 100, 2);
                                    $adjustedWidth = (float)($ChapterPercentage * ((100 / $TotalChaptersCount)/100));
                                    echo '<div class="progress-bar '.getNextBgColor().'" role="progressbar" style="width: '.$adjustedWidth.'%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"><strong>'.$ChapterPercentage.'%</strong></div>';
                                }
                                echo '      </div>';
                                echo '  </div>';
                                echo '</a>';
                            } 
                        } else {
                            echo '<p>You are not enrolled in any course.</p>';

                        }
                        ?>
                    </div>
                </div>

                <hr>

                <div class="row p-3 rounded-3">
                    <div class="w-100 d-flex justify-content-between"><h3>What to learn Next?</h3><input id="FeaturedCoursesSearch" class="" type="text" name="" id="" placeholder="search"></div>
                    <div id="FeaturedCourses" class=""></div>
                </div>

            <?php } else { ?>

                <div class="row p-3 rounded-3">
                    <div class="w-100 d-flex justify-content-between">
                        <h3>What to learn Next?</h3>
                        <input id="FeaturedCoursesSearch" class="h-50 p-2" type="text" name="" id="" placeholder="search">
                    </div>
                    <div id="FeaturedCourses" class=""></div>
                </div>

            <?php } ?>
            
        </div>
    </div>

    <script>
        let FeaturedCoursesContainer = document.getElementById('FeaturedCourses');
        let FeaturedCoursesRaw = null;
        let FeaturedCoursesSearch = "";
        let FeaturedCoursesCounts = 0;
        if (FeaturedCourses){
            FeaturedCoursesRaw = JSON.parse(OtherCourses);
            console.log(FeaturedCoursesRaw);

            function RerenderFeaturedCourses(){
                console.log("ReRender")
                FeaturedCoursesContainer.innerHTML="";
                FeaturedCoursesRaw.forEach(element => {
                    let layout = ``;
                    if(FeaturedCoursesSearch === "") {
                        layout = `
                            <a class="courses-card d-flex" href="${BASE_URL}?page=course&item=${element['Details']['Id']}">
                                <img height="150" width="150" src="${BASE_URL}${element['Details']['CourseImage'] ? element['Details']['CourseImage'] : 'images/defaultCourse.jpg'}" alt="image">
                                <div class="w-100 p-3">
                                    <h5>${element['Details']['CourseName']}</h5>
                                    <div class="mt-2 mb-2">Total Chapters: ${element['Chapters'].length}</div>
                                    <div><i>Click to view this course</i></div>
                                </div>
                            </a>
                        `;
                    } else {
                        if (element.Details.CourseName.toUpperCase().includes(FeaturedCoursesSearch.toUpperCase())){
                            layout = `
                                <a class="courses-card d-flex" href="${BASE_URL}?page=course&item=${element['Details']['Id']}">
                                    <img height="150" width="150" src="${BASE_URL}${element['Details']['CourseImage'] ? element['Details']['CourseImage'] : 'images/defaultCourse.jpg'}" alt="image">
                                    <div class="w-100 p-3">
                                        <h5>${element['Details']['CourseName']}</h5>
                                        <div class="mt-2 mb-2">Total Chapters: ${element['Chapters'].length}</div>
                                        <div><i>Click to view this course</i></div>
                                    </div>
                                </a>
                            `;
                        }
                    }
                    FeaturedCoursesContainer.innerHTML = FeaturedCoursesContainer.innerHTML + layout;
                })
            }

            document.getElementById('FeaturedCoursesSearch').addEventListener('change', (e)=>{
                FeaturedCoursesSearch = e.target.value;
                RerenderFeaturedCourses();
            });

            RerenderFeaturedCourses();

        }
    </script>