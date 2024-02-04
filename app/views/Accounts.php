<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row p-4 bg-white rounded-3 d-flex flex-column">
            <div id="StudentsHeader" class="d-flex flex-row align-items-center">
                <h4 class="text-nowrap">Students List</h4>
                <input id="StudentsSearch" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search">
                <button id="StudentsAddAccountBtn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-nowrap btn btn-primary">Add Student</button>
            </div>

            <div id="Students" class="mt-4 list-group"></div>
        </div>

        <div class="row p-4 bg-white rounded-3 d-flex flex-column">
            <div id="StudentsHeader" class="d-flex flex-row align-items-center">
                <h4 class="text-nowrap">Teachers List</h4>
                <input id="TeachersSearch" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search">
                <button id="StudentsAddAccountBtn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-nowrap btn btn-primary">Add Student</button>
            </div>

            <div id="Teachers" class="mt-4 list-group"></div>
        </div>


        <div class="row p-4 bg-white rounded-3 d-flex flex-column">
            <div id="StudentsHeader" class="d-flex flex-row align-items-center">
                <h4 class="text-nowrap">Administrators List</h4>
                <input id="AdministratorsSearch" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search">
                <button id="StudentsAddAccountBtn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-nowrap btn btn-primary">Add Student</button>
            </div>

            <div id="Administrators" class="mt-4 list-group"></div>
        </div>

    </div>

    <script>
        let StudentsArray = JSON.parse(Students);
        let TeachersArray = JSON.parse(Teachers);
        let AdministratorsArray = JSON.parse(Administrators);
        let StudentsList = document.getElementById('Students');
        let TeachersList = document.getElementById('Teachers');
        let AdministratorsList = document.getElementById('Administrators');
        let StudentsSearchElement = document.getElementById('StudentsSearch');
        let TeachersSearchElement = document.getElementById('TeachersSearch');
        let AdministratorsSearchElement = document.getElementById('AdministratorsSearch');
        let S_Search = "";
        let T_Search = "";
        let A_Search = "";
        let ChaptersArray = JSON.parse(Chapters);
        let counterBgColor = 0;

        StudentsSearchElement.addEventListener('change', (e)=>{
            S_Search = e.target.value;
            RefreshStudentList();
        })

        TeachersSearchElement.addEventListener('change', (e)=>{
            T_Search = e.target.value;
            RefreshTeacherList();
        })

        AdministratorsSearchElement.addEventListener('change', (e)=>{
            A_Search = e.target.value;
            RefreshAdministratorList();
        })
        
        function RefreshStudentList(){
            StudentsList.innerHTML = "";
            StudentsArray.forEach(row => {
                let Name = `${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}`;
                let Email = `${row.account.Email}`;
                if(row.account.Role === "Student"){
                    if (S_Search) {
                        if (Name.toUpperCase().includes(S_Search.toUpperCase()) || Email.toUpperCase().includes(S_Search.toUpperCase())) {
                            let view = "";
                            let TotalProgressPercentage = (((row?.progress?.FullProgress??0) / Math.max(row.progress.FullProgressTotal, 1)) * 100);
                            let TotalChaptersCount = ChaptersArray.length;
                            view += `<a href="${BASE_URL}?page=profile&item=${row.account.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                            if (row.account.FirstName === null){
                                view += `<h5>${row.account.Email??""}</h5>`;
                            } else {
                                view += `<h5>${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}</h5>`;
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
                            view += `<a href="${BASE_URL}?page=profile&item=${row.account.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                            if (row.account.FirstName === null){
                                view += `<h5>${row.account.Email??""}</h5>`;
                            } else {
                                view += `<h5>${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}</h5>`;
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

        function RefreshTeacherList(){
            TeachersList.innerHTML = "";
            TeachersArray.forEach(row => {
                let Name = `${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}`;
                let Email = `${row.account.Email}`;
                if (T_Search) {
                    if (Name.toUpperCase().includes(T_Search.toUpperCase()) || Email.toUpperCase().includes(T_Search.toUpperCase())) {
                        let view = "";
                        view += `<a href="${BASE_URL}?page=profile&item=${row.account.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                        if (row.account.FirstName === null){
                            view += `<h5>${row.account.Email??""}</h5>`;
                        } else {
                            view += `<h5>${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}</h5>`;
                        }
                        view += `</a>`;
                        TeachersList.innerHTML += view;
                    } 
                } else {
                    let view = "";
                        view += `<a href="${BASE_URL}?page=profile&item=${row.account.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                        if (row.account.FirstName === null){
                            view += `<h5>${row.account.Email??""}</h5>`;
                        } else {
                            view += `<h5>${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}</h5>`;
                        }
                        view += `</a>`;
                        TeachersList.innerHTML += view;
                }
            });
            if (TeachersList.innerHTML === "") {
                TeachersList.innerHTML = "No items to show.";
            }
        }

        function RefreshAdministratorList(){
            AdministratorsList.innerHTML = "";
            AdministratorsArray.forEach(row => {
                let Name = `${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}`;
                let Email = `${row.account.Email}`;
                if (T_Search) {
                    if (Name.toUpperCase().includes(T_Search.toUpperCase()) || Email.toUpperCase().includes(T_Search.toUpperCase())) {
                        let view = "";
                        view += `<a href="${BASE_URL}?page=profile&item=${row.account.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                        if (row.account.FirstName === null){
                            view += `<h5>${row.account.Email??""}</h5>`;
                        } else {
                            view += `<h5>${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}</h5>`;
                        }
                        view += `</a>`;
                        AdministratorsList.innerHTML += view;
                    } 
                } else {
                    let view = "";
                        view += `<a href="${BASE_URL}?page=profile&item=${row.account.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                        if (row.account.FirstName === null){
                            view += `<h5>${row.account.Email??""}</h5>`;
                        } else {
                            view += `<h5>${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}</h5>`;
                        }
                        view += `</a>`;
                        AdministratorsList.innerHTML += view;
                }
            });
            if (AdministratorsList.innerHTML === "") {
                AdministratorsList.innerHTML = "No items to show.";
            }
        }

        RefreshStudentList();
        RefreshTeacherList();
        RefreshAdministratorList();

        function getNextBgColor() {
            if (counterBgColor === 5) {
                counterBgColor = 0;
            }
            const options = [
                'bg-primary',
                'bg-success',
                'bg-danger',
                'bg-warning',
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
                        <label for="student-group" class="col-form-label"><strong>Group  </strong>( You're Group: <?php echo $_SESSION['User_Group']?> ) :</label>
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
