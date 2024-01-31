<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">
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
                        <label for="profileForm4" class="form-label">Group</label>
                        <input type="text" value="<?php echo $data['group']?>" class="form-control" id="profileForm4" readonly disabled>
                    </div>
                </div>
            </div>
            <?php 
                if ($data['role'] === "Student") {
            ?>
                    <h4 class="row mt-5">Student Progress</h4>
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
                                echo '<h6><span class="badge ' . getNextBgColor() . '">#</span>' . $chapter['Title'] . '</h6>';
                            }
                            echo '</div>';
                        ?>
                    </div>
            <?php 
                }
            ?>
        </div>
    </div>