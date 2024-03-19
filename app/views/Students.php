<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row p-4 bg-white rounded-3 d-flex flex-column">


            <div id="StudentsHeader" class="d-flex flex-row align-items-center">
                <h4 class="text-nowrap">Students List</h4>
                <input id="Search" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search">
                <button id="StudentsAddAccountBtn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-nowrap btn btn-primary">Add Student</button>
            </div>

            <div id="Students" class="mt-4 list-group"></div>
        </div>
    </div>

    <script>
        let StudentsArray = JSON.parse(Students);
        let ChaptersArray = JSON.parse(Chapters);
        let counterBgColor = 0;
        let StudentsList = document.getElementById('Students');
        let SearchElement = document.getElementById('Search');
        let Search = "";

        SearchElement.addEventListener('change', (e)=>{
            Search = e.target.value;
            RefreshStudentList();
        })

        function titleCase(str) {
            if (str && str !== "") {
                const words = str.split(" ");
                const final = [];
                for (let i = 0; i < words.length; i++) {
                    const capitalizedWord = words[i].toLowerCase().charAt(0).toUpperCase() + words[i].toLowerCase().slice(1);
                    final.push(capitalizedWord);
                }
                return final.join(" ");
            } else {
                return str;
            }
        }
        
        function RefreshStudentList(){
            StudentsList.innerHTML = "";
            StudentsArray.forEach(row => {
                let Name = `${row.student.LastName}, ${row.student.FirstName} ${row.student.MiddleName??""}`;
                let Email = `${row.student.Email}`;
                if(row.student.Role === "Student"){
                    if (Search) {
                        if (Name.toUpperCase().includes(Search.toUpperCase()) || Email.toUpperCase().includes(Search.toUpperCase())) {
                            let view = "";
                            let TotalProgressPercentage = (((row?.progress?.FullProgress??0) / Math.max(row.progress.FullProgressTotal, 1)) * 100);
                            let TotalChaptersCount = ChaptersArray.length;
                            view += `<a href="${BASE_URL}?page=profile&item=${row.student.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                            if (row.student.FirstName === null){
                                view += `<h5>${row.student.Email??""}</h5>`;
                            } else {
                                view += `<h5>${titleCase(row?.student?.LastName??"")}, ${titleCase(row?.student?.FirstName??"")} ${titleCase(row?.student?.MiddleName??"")}</h5>`;
                            }
                            view += `<p class="m-0 p-0">Overall progress: <strong>${TotalProgressPercentage.toFixed(2)}%</strong><p>`;
                            view += `<div class="progress px-0">`;
                            ChaptersArray.forEach(chapter => {
                                let ChapterPercentage = (((Number(row?.progress?.ChapterProgress[chapter.Id]) ?? 0) / Math.max(Number(row.progress.ChapterProgressTotal[chapter.Id]), 1)) * 100)??0;
                                let adjustedWidth = (ChapterPercentage) * ((100 / (TotalChaptersCount)) / 100)??0;
                                view += `<div class="progress-bar ${getNextBgColor()}" role="progressbar" style="width: ${parseFloat(adjustedWidth)}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><strong>${isNaN(ChapterPercentage) ? 0.00 : ChapterPercentage.toFixed(2)}%</strong></div>`;
                            });
                            view += `</div>`;
                            view += `</a>`;
                            StudentsList.innerHTML += view;
                        } 
                    } else {
                        let view = "";
                            let TotalProgressPercentage = (((row?.progress?.FullProgress??0) / Math.max(row.progress.FullProgressTotal, 1)) * 100);
                            let TotalChaptersCount = ChaptersArray.length;
                            view += `<a href="${BASE_URL}?page=profile&item=${row.student.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                            if (row.student.FirstName === null){
                                view += `<h5>${row.student.Email??""}</h5>`;
                            } else {
                                view += `<h5>${titleCase(row?.student?.LastName??"")}, ${titleCase(row?.student?.FirstName??"")} ${titleCase(row?.student?.MiddleName??"")}</h5>`;
                            }
                            view += `<p class="m-0 p-0">Overall progress: <strong>${TotalProgressPercentage.toFixed(2)}%</strong><p>`;
                            view += `<div class="progress px-0">`;
                            ChaptersArray.forEach(chapter => {
                                let ChapterPercentage = (((Number(row?.progress?.ChapterProgress[chapter.Id]) ?? 0) / Math.max(Number(row.progress.ChapterProgressTotal[chapter.Id]), 1)) * 100)??0;
                                let adjustedWidth = (ChapterPercentage) * ((100 / (TotalChaptersCount)) / 100)??0;
                                view += `<div class="progress-bar ${getNextBgColor()}" role="progressbar" style="width: ${parseFloat(adjustedWidth)}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><strong>${isNaN(ChapterPercentage) ? 0.00 : ChapterPercentage.toFixed(2)}%</strong></div>`;
                            });
                            view += `</div>`;
                            view += `</a>`;
                            StudentsList.innerHTML += view;
                    }
                }
            });
            if (StudentsList.innerHTML === "") {
                StudentsList.innerHTML = "No items to show.";
            }
        }

        RefreshStudentList();

        function getNextBgColor() {
            if (counterBgColor === 6) {
                counterBgColor = 0;
            }
            const options = [
                'bg-primary',
                'bg-success',
                'bg-danger',
                'bg-warning',
                'bg-secondary',
                'bg-info'
            ];
            const text = options[counterBgColor];
            counterBgColor++;
            return text;
        }
    </script>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="student-add-success" class="text-success"></p>
                        <p id="student-add-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="student-email" class="col-form-label"><strong>Student Email:</strong></label>
                        <input type="text" name="student-email" class="form-control" id="student-email" placeholder="s.####.####@sscr.edu" required>
                        <p id="student-email-note" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="student-group" class="col-form-label"><strong>Section  </strong>( You're Section: <?php echo $_SESSION['User_Group']?> ) :</label>
                        <select id="student-group" class="custom-select my-1 mr-sm-2 form-control" name="student-group" id="inlineFormCustomSelectPref" value="<?php echo $_SESSION['User_Group']?>" required>
                            <option value="" selected>Choose...</option>
                            <?php 
                                foreach ($data['groups'] as $value) {
                                    echo '<option value="'.$value['Group'].'">Group '.$value['Group'].'</option>';
                                }
                            ?>
                        </select>
                        <p id="student-group-note" class="text-danger"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="StudentsSubmitAddAccountBtn" type="submit" class="btn btn-primary">Register Student</button>
                </div>
            </div> 
        </div>
    </div>
