<body class="bg-body-secondary d-flex flex-column justify-content-between h-100">
    <div class="container flex-fill">

        <div class="row px-4 py-3 pb-4 bg-white mb-4 rounded-3">
            <h4 class="mb-4">Accounts Management</h4>
            <div>
                <button id="btn-students" class="btn btn-primary">Students</button>
                <button id="btn-administrators" class="btn btn-secondary">Administrators</button>
            </div>
        </div>

        <div id="StudentsContainer" class="row p-4 bg-white rounded-3 d-flex flex-column">
            <div id="StudentsHeader" class="d-flex flex-row align-items-center">
                <h4 class="text-nowrap">Students List</h4>
                <input id="StudentsSearch" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search">
                <button id="StudentsAddAccountBtn" type="button" data-bs-toggle="modal" data-bs-target="#AddStudent" class="text-nowrap btn btn-primary">Add Student</button>
            </div>

            <div id="Students" class="mt-4 list-group"></div>
        </div>

        <div id="AdministratorsContainer" class="row p-4 bg-white rounded-3 d-none flex-column">
            <div id="StudentsHeader" class="d-flex flex-row align-items-center">
                <h4 class="text-nowrap">Administrators List</h4>
                <input id="AdministratorsSearch" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search">
                <button id="AdministratorsAddAccountBtn" type="button" data-bs-toggle="modal" data-bs-target="#AddAdministrator" class="text-nowrap btn btn-primary">Add Administrator</button>
            </div>

            <div id="Administrators" class="mt-4 list-group"></div>
        </div>

    </div>
    <script>

        let StudentBtn = document.getElementById('btn-students');
        let AdministratorBtn = document.getElementById('btn-administrators');

        StudentBtn.addEventListener('click', (e)=>{
            changePanel(e.target, 'StudentsContainer');
        });

        AdministratorBtn.addEventListener('click', (e)=>{
            changePanel(e.target, 'AdministratorsContainer');
        });

        function changePanel(btn, panelId){
            StudentBtn.classList.remove('btn-primary');
            StudentBtn.classList.add('btn-secondary');
            AdministratorBtn.classList.remove('btn-primary');
            AdministratorBtn.classList.add('btn-secondary');
            btn.classList.remove('btn-secondary');
            btn.classList.add('btn-primary');

            document.getElementById('StudentsContainer').classList.remove('d-flex');
            document.getElementById('AdministratorsContainer').classList.remove('d-flex');
            document.getElementById('StudentsContainer').classList.add('d-none');
            document.getElementById('AdministratorsContainer').classList.add('d-none');
            let element = document.getElementById(panelId);
            element.classList.remove('d-none')
            element.classList.add('d-flex')
        }

        let StudentsArray = JSON.parse(Students);
        let AdministratorsArray = JSON.parse(Administrators);
        let StudentsList = document.getElementById('Students');
        let AdministratorsList = document.getElementById('Administrators');
        let StudentsSearchElement = document.getElementById('StudentsSearch');
        let AdministratorsSearchElement = document.getElementById('AdministratorsSearch');
        let S_Search = "";
        let A_Search = "";
        let counterBgColor = 0;

        StudentsSearchElement.addEventListener('change', (e)=>{
            S_Search = e.target.value;
            RefreshStudentList();
        })


        AdministratorsSearchElement.addEventListener('change', (e)=>{
            A_Search = e.target.value;
            RefreshAdministratorList();
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
                let Name = `${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}`;
                let Email = `${row.account.Email}`;
                if(row.account.Role === "Student"){
                    if (S_Search) {
                        if (Name.toUpperCase().includes(S_Search.toUpperCase()) || Email.toUpperCase().includes(S_Search.toUpperCase())) {
                            let view = "";
                            view += `<a ${row.account.IsApproved === 1 ? 'href="'+BASE_URL+"?page=profile&item="+row.account.Id+'"' : "" } class="list-group-item list-group-item-action d-flex justify-content-between flex-row align-items-start">`;
                            if (row.account.FirstName === null){
                                view += `<h5><img class="mb-3 rounded-3 border iconPicture" src="${row.account.Image}" alt="">${row.account.Email??""}</h5>${row.account.IsApproved === 0 ? '<button class="btn btn-primary approveBtn" data-accountid="'+row.account.Id+'">Approve</button>' : '<p></p>' }`;
                            } else {
                                view += `<h5><img class="mb-3 rounded-3 border iconPicture" src="${row.account.Image}" alt="">${titleCase(row?.account?.LastName??"")}, ${titleCase(row?.account?.FirstName??"")} ${titleCase(row?.account?.MiddleName??"")}</h5>${row.account.IsApproved === 0 ? '<button class="btn btn-primary approveBtn" data-accountid="'+row.account.Id+'">Approve</button>' : '<p></p>' }`;
                            }
                            view += `</a>`;
                            StudentsList.innerHTML += view;
                        } 
                    } else {
                            let view = "";
                            view += `<a ${row.account.IsApproved === 1 ? 'href="'+BASE_URL+"?page=profile&item="+row.account.Id+'"' : "" } class="list-group-item list-group-item-action d-flex justify-content-between flex-row align-items-start">`;
                            if (row.account.FirstName === null){
                                view += `<h5><img class="mb-3 rounded-3 border iconPicture" src="${row.account.Image}" alt="">${row.account.Email??""}</h5>${row.account.IsApproved === 0 ? '<button class="btn btn-primary approveBtn" data-accountid="'+row.account.Id+'">Approve</button>' : '<p></p>' }`;
                            } else {
                                view += `<h5><img class="mb-3 rounded-3 border iconPicture" src="${row.account.Image}" alt="">${titleCase(row?.account?.LastName??"")}, ${titleCase(row?.account?.FirstName??"")} ${titleCase(row?.account?.MiddleName??"")}</h5>${row.account.IsApproved === 0 ? '<button class="btn btn-primary approveBtn" data-accountid="'+row.account.Id+'">Approve</button>' : '<p></p>' }`;
                            }
                            view += `</a>`;
                            StudentsList.innerHTML += view;
                    }
                }

                function sendRequest(data, url) {
                    return new Promise((resolve, reject) => {
                        fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(data),
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('--Server Response Success--', data); // For Logs
                            resolve(data);
                        })
                        .catch(error => {
                            console.log('--Server Response Error--', error); // For Logs
                            reject(error);
                        });
                    });
                }



                let approveBtn = document.querySelectorAll(".approveBtn");
                if(approveBtn) {
                    approveBtn.forEach(element => {
                        element.addEventListener('click', async (e)=>{
                            let data = {
                                'Id': e.target.dataset.accountid,
                                'Type': 'Approval',
                            };
                            element.innerHTML = "Loading...";
                            element.disabled = true;

                            console.log(data);
                            sendRequest(data, BASE_URL + "?page=accounts&action=true")
                                .then(response => {
                                    setTimeout(() => {
                                        alert("Approval Complete!");
                                        window.location.reload();
                                    }, 2000);
                                })
                                .catch(error => {
                                    setTimeout(() => {
                                        alert("Approval Failed, Try again!");
                                        window.location.reload();
                                    }, 2000);
                                })
                        })
                    });
                }

            });
            if (StudentsList.innerHTML === "") {
                StudentsList.innerHTML = "No items to show.";
            }
        }

        function RefreshAdministratorList(){
            AdministratorsList.innerHTML = "";
            AdministratorsArray.forEach(row => {
                let Name = `${row.account.LastName}, ${row.account.FirstName} ${row.account.MiddleName??""}`;
                let Email = `${row.account.Email}`;
                if (A_Search) {
                    if (Name.toUpperCase().includes(A_Search.toUpperCase()) || Email.toUpperCase().includes(A_Search.toUpperCase())) {
                        let view = "";
                        view += `<a href="${BASE_URL}?page=profile&item=${row.account.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                        if (row.account.FirstName === null){
                            view += `<h5><img class="mb-3 rounded-3 border iconPicture" src="${row.account.Image}" alt="">${row.account.Email??""}</h5>`;
                        } else {
                            view += `<h5><img class="mb-3 rounded-3 border iconPicture" src="${row.account.Image}" alt="">${titleCase(row.account.LastName)}, ${titleCase(row.account.FirstName)} ${titleCase(row.account.MiddleName??"")}</h5>`;
                        }
                        view += `</a>`;
                        AdministratorsList.innerHTML += view;
                    } 
                } else {
                    let view = "";
                        view += `<a href="${BASE_URL}?page=profile&item=${row.account.Id}" class="list-group-item list-group-item-action flex-column align-items-start">`;
                        if (row.account.FirstName === null){
                            view += `<h5><img class="mb-3 rounded-3 border iconPicture" src="${row.account.Image}" alt="">${row.account.Email??""}</h5>`;
                        } else {
                            view += `<h5><img class="mb-3 rounded-3 border iconPicture" src="${row.account.Image}" alt="">${titleCase(row.account.LastName)}, ${titleCase(row.account.FirstName)} ${titleCase(row.account.MiddleName??"")}</h5>`;
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
        RefreshAdministratorList();

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

    <div class="modal fade" id="AddStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="StudentsSubmitAddAccountBtn" type="submit" class="btn btn-primary">Register Student</button>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal fade" id="AddAdministrator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" action="#" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Administrator Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p id="administrator-add-success" class="text-success"></p>
                        <p id="administrator-add-failed" class="text-danger"></p>
                    </div>
                    <div class="mb-3">
                        <label for="administrator-email" class="col-form-label"><strong>Administrator Email:</strong></label>
                        <input type="text" name="administrator-email" class="form-control" id="administrator-email" placeholder="####.####@sscr.edu" required>
                        <p id="administrator-email-note" class="text-danger"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="AdministratorsSubmitAddAccountBtn" type="submit" class="btn btn-primary">Register Administrator</button>
                </div>
            </div> 
        </div>
    </div>
