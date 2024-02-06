import AjaxRequest from './ajax.js';

window.handleCredentialResponse = (response) => {
    window.location.href = `${BASE_URL}index.php?page=login&action=process&token=${response.credential}`;
}



// STUDENTS  ADD
let StudentsSubmitAddAccountBtn = document.getElementById('StudentsSubmitAddAccountBtn');
if(StudentsSubmitAddAccountBtn) {
    StudentsSubmitAddAccountBtn.addEventListener('click', async ()=>{
        StudentsSubmitAddAccountBtn.disabled = true;
        let Email = document.getElementById('student-email').value;
        let Group = document.getElementById('student-group').value;
        
        document.getElementById('student-add-success').innerHTML = "";
        document.getElementById('student-add-failed').innerHTML = ""
    
        if (!Email) {
            document.getElementById('student-email-note').innerHTML = "Email Required!";
            StudentsSubmitAddAccountBtn.disabled = false;
            return
        }
        document.getElementById('student-email-note').innerHTML = "";
        if (!Group){
            document.getElementById('student-group-note').innerHTML = "Group Required!";
            StudentsSubmitAddAccountBtn.disabled = false;
            return
        }
        document.getElementById('student-group-note').innerHTML = "";
    
        let data = {
            'Email': Email,
            'Group': Group,
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=students&action=true")
            .then(response => {
                document.getElementById('student-email').value = "";
                document.getElementById('student-group').value = "";
                document.getElementById('student-add-success').innerHTML = "Success!";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                document.getElementById('student-add-failed').innerHTML = "Failed, Try Again!";
            })
            .finally(() => {
                StudentsSubmitAddAccountBtn.disabled = false;
            });
    })
}

// TEACHERS ADD 
let TeachersSubmitAddAccountBtn = document.getElementById('TeachersSubmitAddAccountBtn');
if(TeachersSubmitAddAccountBtn) {
    TeachersSubmitAddAccountBtn.addEventListener('click', async ()=>{
        TeachersSubmitAddAccountBtn.disabled = true;
        let Email = document.getElementById('teacher-email').value;
        let Group = document.getElementById('teacher-group').value;
        
        document.getElementById('teacher-add-success').innerHTML = "";
        document.getElementById('teacher-add-failed').innerHTML = ""
    
        if (!Email) {
            document.getElementById('teacher-email-note').innerHTML = "Email Required!";
            TeachersSubmitAddAccountBtn.disabled = false;
            return
        }
        document.getElementById('teacher-email-note').innerHTML = "";
        if (!Group){
            document.getElementById('teacher-group-note').innerHTML = "Group Required!";
            TeachersSubmitAddAccountBtn.disabled = false;
            return
        }
        document.getElementById('teacher-group-note').innerHTML = "";
    
        let data = {
            'Email': Email,
            'Group': Group,
            'Type': 'Teacher'
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=accounts&action=true")
            .then(response => {
                document.getElementById('teacher-email').value = "";
                document.getElementById('teacher-group').value = "";
                document.getElementById('teacher-add-success').innerHTML = "Success!";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                document.getElementById('student-add-failed').innerHTML = "Failed, Try Again!"
            })
            .finally(() => {
                TeachersSubmitAddAccountBtn.disabled = false;
            });
    })
}

// ADMINISTRATORS ADD
let AdministratorsSubmitAddAccountBtn = document.getElementById('AdministratorsSubmitAddAccountBtn');
if(AdministratorsSubmitAddAccountBtn) {
    AdministratorsSubmitAddAccountBtn.addEventListener('click', async ()=>{
        AdministratorsSubmitAddAccountBtn.disabled = true;
        let Email = document.getElementById('administrator-email').value;
        
        document.getElementById('administrator-add-success').innerHTML = "";
        document.getElementById('administrator-add-failed').innerHTML = ""
    
        if (!Email) {
            document.getElementById('administrator-email-note').innerHTML = "Email Required!";
            AdministratorsSubmitAddAccountBtn.disabled = false;
            return
        }
        document.getElementById('administrator-email-note').innerHTML = "";
    
        let data = {
            'Email': Email,
            'Group': '',
            'Type': 'Administrator'
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=accounts&action=true")
            .then(response => {
                document.getElementById('administrator-email').value = "";
                document.getElementById('administrator-add-success').innerHTML = "Success!";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                document.getElementById('administrator-add-failed').innerHTML = "Failed, Try Again!"
            })
            .finally(() => {
                AdministratorsSubmitAddAccountBtn.disabled = false;
            });
    })
}

// RESULTS RETAKE
let ResultRetakeBtn = document.getElementById('ResultRetakeBtn');
if(ResultRetakeBtn) {
    ResultRetakeBtn.addEventListener('click', async ()=>{
        console.log("Clicked");
        ResultRetakeBtn.disabled = true;
        ResultRetakeBtn.innerHTML = "...";
        let tostate = ResultRetakeBtn.dataset.tostate;
        let Id = ResultRetakeBtn.dataset.result;
    
        let data = {
            'ToState': tostate,
            'Id': Id
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=result&action=true")
            .then(response => {
                if (tostate === "Enable"){
                    ResultRetakeBtn.innerHTML = "Disable Retake";
                    ResultRetakeBtn.dataset.tostate = "Disable";
                } else {
                    ResultRetakeBtn.innerHTML = "Enable Retake";
                    ResultRetakeBtn.dataset.tostate = "Enable";
                }
            })
            .catch(error => {
                if (tostate === "Enable"){
                    ResultRetakeBtn.innerHTML = "Enable Retake";
                    ResultRetakeBtn.dataset.tostate = "Enable";
                } else {
                    ResultRetakeBtn.innerHTML = "Disable Retake";
                    ResultRetakeBtn.dataset.tostate = "Disable";
                }
            })
            .finally(() => {
                ResultRetakeBtn.disabled = false;
            });
    })
}

// PROFILE RESET PROGRESS
let ProfileResetAccountButton = document.getElementById('ProfileResetAccountButton');
if(ProfileResetAccountButton) {
    ProfileResetAccountButton.addEventListener('click', async ()=>{
        console.log("Clicked");
        ProfileResetAccountButton.disabled = true;
        ProfileResetAccountButton.innerHTML = "...";
        let Id = ProfileResetAccountButton.dataset.account;
    
        let data = {
            'Action': 'Reset',
            'Id': Id
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=profile&action=true")
            .then(response => {
                ProfileResetAccountButton.innerHTML = "Reset Complete";
                window.location.reload();
            })
            .catch(error => {
                ProfileResetAccountButton.innerHTML = "Reset Failed, Try again!";
            })
            .finally(() => {
                setTimeout(function() {
                    ProfileResetAccountButton.innerHTML = "Reset Account Progress";
                    ProfileResetAccountButton.disabled = false;
                }, 1000);
            });
    })
}

// PROFILE DISABLE ACCOUNT
let ProfileDisableAccountButton = document.getElementById('ProfileDisableAccountButton');
if(ProfileDisableAccountButton) {
    ProfileDisableAccountButton.addEventListener('click', async ()=>{
        console.log("Clicked");
        ProfileDisableAccountButton.disabled = true;
        ProfileDisableAccountButton.innerHTML = "...";
        let Id = ProfileDisableAccountButton.dataset.account;
        let CurrentState = ProfileDisableAccountButton.dataset.currentstate;
        console.log(CurrentState)
        let data = {
            'Action': 'Disabled',
            'CurrentState': CurrentState,
            'Id': Id
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=profile&action=true")
            .then(response => {
                window.location.reload();
            })
            .catch(error => {
                if(CurrentState === 1) {
                    ProfileDisableAccountButton.innerHTML = "Enable Account";
                } else {
                    ProfileDisableAccountButton.innerHTML = "Disable Account";
                }
            })
            .finally(() => {
                ProfileDisableAccountButton.disabled = false;
            });
    })
}

// ASSESSMENT VIEW RESULT 
let AssessmentViewSummaryBtn = document.getElementById('AssessmentViewSummaryBtn');
if(AssessmentViewSummaryBtn) {
    AssessmentViewSummaryBtn.addEventListener('click', async ()=>{
        console.log("Clicked");
        AssessmentViewSummaryBtn.disabled = true;
        AssessmentViewSummaryBtn.innerHTML = "...";
        let Id = AssessmentViewSummaryBtn.dataset.activity;
        let ToState = AssessmentViewSummaryBtn.dataset.tostate;
        let data = {
            'ToState': ToState,
            'Id': Id
        };

        AjaxRequest.sendRequest(data, BASE_URL + "?page=activity&action=true")
            .then(response => {
               window.location.reload();
            })
            .catch(error => {
                if(ToState === 1) {
                    AssessmentViewSummaryBtn.innerHTML = "Enable View Result";
                } else {
                    AssessmentViewSummaryBtn.innerHTML = "Disable View Result";
                }
            })
            .finally(() => {
                AssessmentViewSummaryBtn.disabled = false;
            });
    })
}



// CHAPTER ADD
let ChapterSubmitAddBtn = document.getElementById('ChapterSubmitAddBtn');
if(ChapterSubmitAddBtn) {
    ChapterSubmitAddBtn.addEventListener('click', async ()=>{
        ChapterSubmitAddBtn.disabled = true;
        ChapterSubmitAddBtn.innerHTML = "...";
        let Title = document.getElementById('chapter-title').value;
        let Codes = document.getElementById('chapter-codes').value;
        
        document.getElementById('chapter-add-success').innerHTML = "";
        document.getElementById('chapter-add-failed').innerHTML = "";
    
        if (!Title) {
            document.getElementById('chapter-title-note').innerHTML = "Title Required!";
            ChapterSubmitAddBtn.disabled = false;
            ChapterSubmitAddBtn.innerHTML = "Save Changes";
            return
        }
        document.getElementById('chapter-title-note').innerHTML = "";
    
        let data = {
            'Title': Title,
            'Codes': Codes,
            'Type': 'Add',
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=course&action=true")
            .then(response => {
                document.getElementById('chapter-title').value = "";
                document.getElementById('chapter-codes').value = "";
                document.getElementById('chapter-add-success').innerHTML = "Success!";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                document.getElementById('chapter-add-failed').innerHTML = "Failed, Try Again!";
            })
            .finally(() => {
                StudentsSubmitAddAccountBtn.disabled = false;
                ChapterSubmitAddBtn.innerHTML = "Save Changes";
            });
    })
}

// CHAPTER DELETE PREPARATION
let ChapterDeleteBtnConfirmation = document.getElementById('ChapterDeleteBtnConfirmation');
if(ChapterDeleteBtnConfirmation) {
    ChapterDeleteBtnConfirmation.addEventListener('click', async ()=>{
        let Title = document.getElementById('chapter-edit-title').value;
        document.getElementById('chapter-delete-confirmation').innerHTML = `Are you sure you want to delete this chapter [ ${Title} ], and its lessons and activities?`;
    })
}

// CHAPTER DELETE
let ChapterDeleteBtn = document.getElementById('ChapterDeleteBtn');
if(ChapterDeleteBtn) {
    ChapterDeleteBtn.addEventListener('click', async ()=>{
        ChapterDeleteBtn.disabled = true;
        ChapterDeleteBtn.innerHTML = "...";
        let Id = document.getElementById('chapter-edit-id').value;

        let data = {
            'Id': Id,
            'Type': 'Delete',
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=course&action=true")
            .then(response => {
                ChapterDeleteBtn.innerHTML = "Success";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                ChapterDeleteBtn.innerHTML = "Failed";
            })
            .finally(() => {
                setTimeout(() => {
                    ChapterDeleteBtn.disabled = false;
                    ChapterDeleteBtn.innerHTML = "Yes";
                }, 1000);
            });
    })
}

// CHAPTER EDIT PREPARATION
let EditChapterBtns = document.querySelectorAll(".edit-chapter-btn");
if(EditChapterBtns) {
    EditChapterBtns.forEach(element => {
        element.addEventListener('click', async (e)=>{
            let data = {
                'Id': e.target.dataset.chapterid,
                'Type': 'Read',
            };

            let xTitle = document.getElementById('chapter-edit-title');
            let xCodes = document.getElementById('chapter-edit-codes');
            let xId = document.getElementById('chapter-edit-id');

            AjaxRequest.sendRequest(data, BASE_URL + "?page=course&action=true")
                .then(response => {
                    xTitle.value = response?.Parameters[0].Title??"test";
                    xCodes.value = response?.Parameters[0].Codes??"test";
                    xId.value = response?.Parameters[0].Id??"";
                })
                .catch(error => {
                    xTitle.value = "Error, Try Again";
                    xCodes.value = "Error, Try Again";
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                })
        })
    });
}


// CHAPTER EDIT
let ChapterSubmitEditBtn = document.getElementById('ChapterSubmitEditBtn');
if(ChapterSubmitEditBtn) {
    ChapterSubmitEditBtn.addEventListener('click', async ()=>{
        ChapterSubmitEditBtn.disabled = true;
        ChapterSubmitEditBtn.innerHTML = "...";
        let xTitle = document.getElementById('chapter-edit-title');
        let xCodes = document.getElementById('chapter-edit-codes');
        let xId = document.getElementById('chapter-edit-id');

        let data = {
            'Title': xTitle.value,
            'Codes': xCodes.value,
            'Id': xId.value,
            'Type': 'Edit',
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=course&action=true")
            .then(response => {
                ChapterSubmitEditBtn.innerHTML = "Success";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                ChapterSubmitEditBtn.innerHTML = "Failed";
            })
            .finally(() => {
                setTimeout(() => {
                    ChapterSubmitEditBtn.disabled = false;
                    ChapterSubmitEditBtn.innerHTML = "Yes";
                }, 1000);
            });
    })
}


// LESSON ADD


// ACTIVITY ADD


// QUESTIONS ADD