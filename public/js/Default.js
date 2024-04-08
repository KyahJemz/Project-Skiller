import AjaxRequest from './ajax.js';

window.handleCredentialResponse = (response) => {
    window.location.href = `${BASE_URL}index.php?page=login&action=process&token=${response.credential}`;
}


// SIGN UP BTN  ADD
let SignUpBtn = document.getElementById('SignUpBtn');
if(SignUpBtn) {
    SignUpBtn.addEventListener('click', async ()=>{
        SignUpBtn.disabled = true;
        let Email = document.getElementById('signup-email').value;
        let FirstName = document.getElementById('signup-firstname').value;
        let LastName = document.getElementById('signup-lastname').value;
    
        if (!Email) {
            alert("Email Required");
            SignUpBtn.disabled = false;
            return
        }

        if (!FirstName) {
            alert("FirstName Required");
            SignUpBtn.disabled = false;
            return
        }

        if (!LastName) {
            alert("LastName Required");
            SignUpBtn.disabled = false;
            return
        }
    
        let data = {
            'Email': Email,
            'FirstName': FirstName,
            'LastName': LastName,
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=accounts&action=true")
            .then(response => {
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                alert("Sign Up Failed, Try Again!")
            })
            .finally(() => {
                SignUpBtn.disabled = false;
            });
    })
}

// STUDENTS  ADD
let StudentsSubmitAddAccountBtn = document.getElementById('StudentsSubmitAddAccountBtn');
if(StudentsSubmitAddAccountBtn) {
    StudentsSubmitAddAccountBtn.addEventListener('click', async ()=>{
        StudentsSubmitAddAccountBtn.disabled = true;
        let Email = document.getElementById('student-email').value;
        
        document.getElementById('student-add-success').innerHTML = "";
        document.getElementById('student-add-failed').innerHTML = ""
    
        if (!Email) {
            document.getElementById('student-email-note').innerHTML = "Email Required!";
            StudentsSubmitAddAccountBtn.disabled = false;
            return
        }
        document.getElementById('student-email-note').innerHTML = "";
    
        let data = {
            'Email': Email,
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=students&action=true")
            .then(response => {
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
            'Id': Id,
            'Type': 'updateCanViewResultState'
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

// COURSE =============

// COURSE ADD
let CourseSubmitAddBtn = document.getElementById('CourseSubmitAddBtn');
if(CourseSubmitAddBtn) {
    CourseSubmitAddBtn.addEventListener('click', async ()=>{
        CourseSubmitAddBtn.disabled = true;
        CourseSubmitAddBtn.innerHTML = "...";
        let Title = document.getElementById('course-title').value;
        let Description = document.getElementById('course-description').value;
        let Image = document.getElementById('course-image').files[0] ?? null;
        
        document.getElementById('course-add-success').innerHTML = "";
        document.getElementById('course-add-failed').innerHTML = "";
    
        if (!Title) {
            document.getElementById('course-title-note').innerHTML = "Title Required!";
            CourseSubmitAddBtn.disabled = false;
            CourseSubmitAddBtn.innerHTML = "Save Changes";
            return
        }
        document.getElementById('course-title-note').innerHTML = "";
    
        const formData = new FormData();
        formData.append("Title", Title);
        formData.append("Description", Description);
        formData.append("Type", 'AddCourse');
        if(Image) {
            formData.append("Image", Image);
        }

        AjaxRequest.sendFormRequest(formData, BASE_URL + "?page=course&action=true")
            .then(response => {
                document.getElementById('course-title').value = "";
                document.getElementById('course-description').value = "";
                document.getElementById('course-add-success').innerHTML = "Success!";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                document.getElementById('course-add-failed').innerHTML = "Failed, Try Again!";
            })
            .finally(() => {
                CourseSubmitAddBtn.disabled = false;
                CourseSubmitAddBtn.innerHTML = "Save Changes";
            });
    })
}

// COURSE DELETE PREPARATION
let CourseDeleteBtnConfirmation = document.getElementById('CourseDeleteBtnConfirmation');
if(CourseDeleteBtnConfirmation) {
    CourseDeleteBtnConfirmation.addEventListener('click', async ()=>{
        let Title = document.getElementById('course-edit-title').value;
        document.getElementById('course-delete-confirmation').innerHTML = `Are you sure you want to delete this course [ ${Title} ], and its chapters, lessons and activities?`;
    })
}

// COURSE DELETE
let CourseDeleteBtn = document.getElementById('CourseDeleteBtn');
if(CourseDeleteBtn) {
    CourseDeleteBtn.addEventListener('click', async ()=>{
        CourseDeleteBtn.disabled = true;
        CourseDeleteBtn.innerHTML = "...";
        let Id = document.getElementById('course-edit-id').value;

        let data = {
            'Id': Id,
            'Type': 'DeleteCourse',
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=course&action=true")
            .then(response => {
                CourseDeleteBtn.innerHTML = "Success";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                CourseDeleteBtn.innerHTML = "Failed";
            })
            .finally(() => {
                setTimeout(() => {
                    CourseDeleteBtn.disabled = false;
                    CourseDeleteBtn.innerHTML = "Yes";
                }, 1000);
            });
    })
}

// COURSE EDIT PREPARATION
let EditCourseBtns = document.querySelectorAll(".edit-course-btn");
if(EditCourseBtns) {
    EditCourseBtns.forEach(element => {
        element.addEventListener('click', async (e)=>{
            let data = {
                'Id': e.target.dataset.courseid,
                'Type': 'ReadCourse',
            };

            let xTitle = document.getElementById('course-edit-title');
            let xDescription = document.getElementById('course-edit-description');
            let xId = document.getElementById('course-edit-id');

            AjaxRequest.sendRequest(data, BASE_URL + "?page=course&action=true")
                .then(response => {
                    xTitle.value = response?.Parameters[0].CourseName??"test";
                    xDescription.value = response?.Parameters[0].CourseDescription??"test";
                    xId.value = response?.Parameters[0].Id??"";
                })
                .catch(error => {
                    xTitle.value = "Error, Try Again";
                    xDescription.value = "Error, Try Again";
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                })
        })
    });
}

// COURSE EDIT
let CourseSubmitEditBtn = document.getElementById('CourseSubmitEditBtn');
if(CourseSubmitEditBtn) {
    CourseSubmitEditBtn.addEventListener('click', async ()=>{
        CourseSubmitEditBtn.disabled = true;
        CourseSubmitEditBtn.innerHTML = "...";
        let xTitle = document.getElementById('course-edit-title');
        let xDescription = document.getElementById('course-edit-description');
        let xImage = document.getElementById('course-edit-image');
        let xId = document.getElementById('course-edit-id');

        const formData = new FormData();
        formData.append("Title", xTitle.value);
        formData.append("Description", xDescription.value);
        formData.append("Type", 'EditCourse');
        formData.append("Id", xId.value);
        if(xImage) {
            formData.append("Image", xImage.files[0]??null);
        }
    
        AjaxRequest.sendFormRequest(formData, BASE_URL + "?page=course&action=true")
            .then(response => {
                CourseSubmitEditBtn.innerHTML = "Success";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                CourseSubmitEditBtn.innerHTML = "Failed";
            })
            .finally(() => {
                setTimeout(() => {
                    CourseSubmitEditBtn.disabled = false;
                    CourseSubmitEditBtn.innerHTML = "Yes";
                }, 1000);
            });
    })
}


// CHAPTER =============

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
            'CourseId': CourseId,
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
                ChapterSubmitAddBtn.disabled = false;
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

// LESSON =============

// LESSON ADD
let LessonSubmitAddBtn = document.getElementById('LessonSubmitAddBtn');
if(LessonSubmitAddBtn) {
    LessonSubmitAddBtn.addEventListener('click', async ()=>{
        LessonSubmitAddBtn.disabled = true;
        LessonSubmitAddBtn.innerHTML = "...";

        let Title = document.getElementById('lesson-title').value;
        let Objectives = document.getElementById('lesson-objectives').value;
        let Description = document.getElementById('lesson-description').value;
        let Image = document.getElementById('lesson-image').files[0]??null;
        let Video = document.getElementById('lesson-video').value;
        let Content = document.getElementById('lesson-content').value;
        let ChapterId = document.getElementById('lesson-chapterid').value;
        
        document.getElementById('lesson-add-success').innerHTML = "";
        document.getElementById('lesson-add-failed').innerHTML = "";
    
        if (!Title) {
            document.getElementById('lesson-title-note').innerHTML = "Title Required!";
            LessonSubmitAddBtn.disabled = false;
            LessonSubmitAddBtn.innerHTML = "Save Changes";
            return
        }
        document.getElementById('lesson-title-note').innerHTML = "";
        if (!Description) {
            document.getElementById('lesson-descriptions-note').innerHTML = "Description Required!";
            LessonSubmitAddBtn.disabled = false;
            LessonSubmitAddBtn.innerHTML = "Save Changes";
            return
        }
        document.getElementById('lesson-description-note').innerHTML = "";
        if (!Objectives) {
            document.getElementById('lesson-objectives-note').innerHTML = "Objectives Required!";
            LessonSubmitAddBtn.disabled = false;
            LessonSubmitAddBtn.innerHTML = "Save Changes";
            return
        }
        document.getElementById('lesson-objectives-note').innerHTML = "";
        
        const formData = new FormData();
        formData.append("Title", Title);
        formData.append("Objective", Objectives);
        formData.append("Description", Description);
        if(Image) {
            formData.append("Image", Image);
        } else {
            formData.append("Image", "");
        }
        formData.append("Video", Video);
        formData.append("Content", Content);
        formData.append("ChapterId", ChapterId);
        formData.append("Type", "Add");
    
        AjaxRequest.sendFormRequest(formData, BASE_URL + "?page=lessons&action=true")
            .then(response => {
                document.getElementById('lesson-add-success').innerHTML = "Success!";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                document.getElementById('lesson-add-failed').innerHTML = "Failed, Try Again!";
            })
            .finally(() => {
                LessonSubmitAddBtn.disabled = false;
                LessonSubmitAddBtn.innerHTML = "Save Changes";
            });
    })
}

// LESSON DELETE PREPARATION
let LessonDeleteBtnConfirmation = document.getElementById('LessonDeleteBtnConfirmation');
if(LessonDeleteBtnConfirmation) {
    LessonDeleteBtnConfirmation.addEventListener('click', async ()=>{
        let Title = document.getElementById('lesson-edit-title').value;
        document.getElementById('lesson-delete-confirmation').innerHTML = `Are you sure you want to delete this lesson [ ${Title} ], and its activities?`;
    })
}

// LESSON DELETE
let LessonDeleteBtn = document.getElementById('LessonDeleteBtn');
if(LessonDeleteBtn) {
    LessonDeleteBtn.addEventListener('click', async ()=>{
        LessonDeleteBtn.disabled = true;
        LessonDeleteBtn.innerHTML = "...";
        let Id = document.getElementById('lesson-edit-id').value;

        let data = {
            'Id': Id,
            'Type': 'Delete',
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=lessons&action=true")
            .then(response => {
                LessonDeleteBtn.innerHTML = "Success";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                LessonDeleteBtn.innerHTML = "Failed";
            })
            .finally(() => {
                setTimeout(() => {
                    LessonDeleteBtn.disabled = false;
                    LessonDeleteBtn.innerHTML = "Yes";
                }, 1000);
            });
    })
}

// LESSON EDIT PREPARATION
let EditLessonBtns = document.querySelectorAll(".edit-lesson-btn");
if(EditLessonBtns) {
    EditLessonBtns.forEach(element => {
        element.addEventListener('click', async (e)=>{
            let data = {
                'Id': e.target.dataset.lessonid,
                'Type': 'Read',
            };

            let xTitle = document.getElementById('lesson-edit-title');
            let xObjectives = document.getElementById('lesson-edit-objectives');
            let xDescription = document.getElementById('lesson-edit-description');
            let xVideo = document.getElementById('lesson-edit-video');
            let xContent = document.getElementById('lesson-edit-content');
            let xId = document.getElementById('lesson-edit-id');

            AjaxRequest.sendRequest(data, BASE_URL + "?page=lessons&action=true")
                .then(response => {
                    xTitle.value = response?.Parameters[0].Title??"";
                    xObjectives.value = response?.Parameters[0].Objective??"";
                    xDescription.value = response?.Parameters[0].Description??"";
                    xVideo.value = response?.Parameters[0].Video??"";
                    xContent.value = response?.Parameters[0].Content??"";
                    xId.value = response?.Parameters[0].Id??"";
                })
                .catch(error => {
                    xTitle.value = "Error, Try Again";
                    xObjectives.value = "Error, Try Again";
                    xDescription.value = "Error, Try Again";
                    xVideo.value = "Error, Try Again";
                    xContent.value = "Error, Try Again";
                    xCodes.value = "Error, Try Again";
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                })
        })
    });
}

// LESSON EDIT
let LessonSubmitEditBtn = document.getElementById('LessonSubmitEditBtn');
if(LessonSubmitEditBtn) {
    LessonSubmitEditBtn.addEventListener('click', async ()=>{
        LessonSubmitEditBtn.disabled = true;
        LessonSubmitEditBtn.innerHTML = "...";

        let xTitle = document.getElementById('lesson-edit-title').value;
        let xObjectives = document.getElementById('lesson-edit-objectives').value;
        let xDescription = document.getElementById('lesson-edit-description').value;
        let xVideo = document.getElementById('lesson-edit-video').value;
        let xImage = document.getElementById('lesson-edit-image').files[0]??null;
        let xContent = document.getElementById('lesson-edit-content').value;
        let xId = document.getElementById('lesson-edit-id').value;

        const formData = new FormData();
        formData.append("Title", xTitle);
        formData.append("Objective", xObjectives);
        formData.append("Description", xDescription);
        if(xImage) {
            formData.append("Image", xImage);
        } else {
            formData.append("Image", "");
        }
        formData.append("Video", xVideo);
        formData.append("Content", xContent);
        formData.append("Id", xId);
        formData.append("Type", "Edit");
    
        AjaxRequest.sendFormRequest(formData, BASE_URL + "?page=lessons&action=true")
            .then(response => {
                LessonSubmitEditBtn.innerHTML = "Success";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                LessonSubmitEditBtn.innerHTML = "Failed";
            })
            .finally(() => {
                setTimeout(() => {
                    LessonSubmitEditBtn.disabled = false;
                    LessonSubmitEditBtn.innerHTML = "Yes";
                }, 1000);
            });
    })
}

// ACTIVITY =============

// ACTIVITY ADD
let ActivitySubmitAddBtn = document.getElementById('ActivitySubmitAddBtn');
if(ActivitySubmitAddBtn) {
    ActivitySubmitAddBtn.addEventListener('click', async ()=>{
        ActivitySubmitAddBtn.disabled = true;
        ActivitySubmitAddBtn.innerHTML = "...";

        let Title = document.getElementById('activity-title').value;
        let Description = document.getElementById('activity-description').value;
        let Notes = document.getElementById('activity-notes').value;
        let CanViewSummary = document.getElementById('activity-canviewsummary').checked;
        let LessonId = document.getElementById('activity-lessonid').value;
        
        document.getElementById('activity-add-success').innerHTML = "";
        document.getElementById('activity-add-failed').innerHTML = "";
    
        if (!Title) {
            document.getElementById('activity-title-note').innerHTML = "Title Required!";
            ActivitySubmitAddBtn.disabled = false;
            ActivitySubmitAddBtn.innerHTML = "Save Changes";
            return
        }
        document.getElementById('activity-title-note').innerHTML = "";
        if (!Description) {
            document.getElementById('activity-descriptions-note').innerHTML = "Description Required!";
            ActivitySubmitAddBtn.disabled = false;
            ActivitySubmitAddBtn.innerHTML = "Save Changes";
            return
        }
        document.getElementById('activity-description-note').innerHTML = "";
        
        const formData = new FormData();
        formData.append("Title", Title);
        formData.append("Notes", Notes);
        formData.append("Description", Description);
        formData.append("CanViewSummary", CanViewSummary);
        formData.append("LessonId", LessonId);
        formData.append("Type", "Add");
    
        AjaxRequest.sendFormRequest(formData, BASE_URL + "?page=activity&action=true")
            .then(response => {
                document.getElementById('activity-add-success').innerHTML = "Success!";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                document.getElementById('activity-add-failed').innerHTML = "Failed, Try Again!";
            })
            .finally(() => {
                ActivitySubmitAddBtn.disabled = false;
                ActivitySubmitAddBtn.innerHTML = "Save Changes";
            });
    })
}

// ACTIVITY DELETE PREPARATION
let ActivityDeleteBtnConfirmation = document.getElementById('ActivityDeleteBtnConfirmation');
if(ActivityDeleteBtnConfirmation) {
    ActivityDeleteBtnConfirmation.addEventListener('click', async ()=>{
        let Title = document.getElementById('activity-edit-title').value;
        document.getElementById('activity-delete-confirmation').innerHTML = `Are you sure you want to delete this lesson [ ${Title} ], and its contents?`;
    })
}

// ACTIVITY DELETE
let ActivityDeleteBtn = document.getElementById('ActivityDeleteBtn');
if(ActivityDeleteBtn) {
    ActivityDeleteBtn.addEventListener('click', async ()=>{
        ActivityDeleteBtn.disabled = true;
        ActivityDeleteBtn.innerHTML = "...";
        let Id = document.getElementById('activity-edit-id').value;

        let data = {
            'Id': Id,
            'Type': 'Delete',
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=activity&action=true")
            .then(response => {
                ActivityDeleteBtn.innerHTML = "Success";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                ActivityDeleteBtn.innerHTML = "Failed";
            })
            .finally(() => {
                setTimeout(() => {
                    ActivityDeleteBtn.disabled = false;
                    ActivityDeleteBtn.innerHTML = "Yes";
                }, 1000);
            });
    })
}

// ACTIVITY EDIT PREPARATION
let EditActivityBtns = document.querySelectorAll(".edit-activity-btn");
if(EditActivityBtns) {
    EditActivityBtns.forEach(element => {
        element.addEventListener('click', async (e)=>{
            let data = {
                'Id': e.target.dataset.activityid,
                'Type': 'Read',
            };

            let xTitle = document.getElementById('activity-edit-title');
            let xNotes = document.getElementById('activity-edit-notes');
            let xDescription = document.getElementById('activity-edit-description');
            let xCanViewSummary = document.getElementById('activity-edit-canviewsummary');
            let xId = document.getElementById('activity-edit-id');

            AjaxRequest.sendRequest(data, BASE_URL + "?page=activity&action=true")
                .then(response => {
                    xTitle.value = response?.Parameters[0].Title??"";
                    xNotes.value = response?.Parameters[0].Notes??"";
                    xDescription.value = response?.Parameters[0].Description??"";
                    xCanViewSummary.checked = response?.Parameters[0].IsViewSummary && response?.Parameters[0].IsViewSummary === 1 ? true : false;
                    xId.value = response?.Parameters[0].Id??"";
                })
                .catch(error => {
                    xTitle.value = "Error, Try Again";
                    xNotes.value = "Error, Try Again";
                    xDescription.value = "Error, Try Again";
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                })
        })
    });
}

// ACTIVITY EDIT
let ActivitySubmitEditBtn = document.getElementById('ActivitySubmitEditBtn');
if(ActivitySubmitEditBtn) {
    ActivitySubmitEditBtn.addEventListener('click', async ()=>{
        ActivitySubmitEditBtn.disabled = true;
        ActivitySubmitEditBtn.innerHTML = "...";

        let xTitle = document.getElementById('activity-edit-title').value;
        let xNotes = document.getElementById('activity-edit-notes').value;
        let xDescription = document.getElementById('activity-edit-description').value;
        let xCanViewSummary = document.getElementById('activity-edit-canviewsummary').checked;
        let xId = document.getElementById('activity-edit-id').value;

        const formData = new FormData();
        formData.append("Title", xTitle);
        formData.append("Notes", xNotes);
        formData.append("Description", xDescription);
        formData.append("IsViewSummary", xCanViewSummary);
        formData.append("Id", xId);
        formData.append("Type", "Edit");
    
        AjaxRequest.sendFormRequest(formData, BASE_URL + "?page=activity&action=true")
            .then(response => {
                ActivitySubmitEditBtn.innerHTML = "Success";
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
            .catch(error => {
                ActivitySubmitEditBtn.innerHTML = "Failed";
            })
            .finally(() => {
                setTimeout(() => {
                    ActivitySubmitEditBtn.disabled = false;
                    ActivitySubmitEditBtn.innerHTML = "Yes";
                }, 1000);
            });
    })
}



let QuestionsContainer = document.getElementById('QuestionsContainer');
let QuestionsRaw = null;
let QuestionCounts = 0;
const Questions = [];
if (QuestionsContainer){
    console.log(QuestionsList);
    QuestionsRaw = JSON.parse(QuestionsList);
    console.log(QuestionsRaw);
    QuestionsRaw.forEach((element) => {
        QuestionCounts++;
        Questions.push({ ...element, TempId: QuestionCounts });
    });

    function ReRenderQuestions() {

        QuestionsContainer.innerHTML = "";
        Questions.forEach(question => {
            QuestionsContainer.innerHTML += `
                <div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">
                    <p class="w-100 d-flex flex-row justify-content-between" style="gap: 10px">Question: <input class="QuestionInput w-100" type="text" data-tempid="${question['TempId']}" value="${question['Question']}" placeholder="???" required><button class="btn btn-danger QuestionDelete" data-tempid="${question['TempId']}" type="button">Remove</button></p>
                    <p class="text-warning">Points: <input class="PointsInput" type="number" data-tempid="${question['TempId']}" Value="${question['QuestionPoints']}" placeholder="?"></p>
                 
                    <div class="row">
                        <div class="col">
                            <input class="form-check-input cursor-pointer QuestionAnswer" data-tempid="${question['TempId']}"  value="${question['QuestionOptions'][0]}" type="radio" name="${question['QuestionId']}" id="${question['QuestionId']}-1" required ${question['QuestionOptions'][0] === question['QuestionAnswer'] ? 'checked' : ''}>
                            <label class="form-check-label cursor-pointer" for="${question['QuestionId']}-1"><input data-tempid="${question['TempId']}" class="QuestionOption" data-loc="0" type="text" value="${question['QuestionOptions'][0]}" placeholder="Option 1"></label>
                        </div>
                        <div class="col">
                            <input class="form-check-input cursor-pointer QuestionAnswer" data-tempid="${question['TempId']}" value="${question['QuestionOptions'][1]}" type="radio" name="${question['QuestionId']}" id="${question['QuestionId']}-2" required ${question['QuestionOptions'][1] === question['QuestionAnswer'] ? 'checked' : ''}>
                            <label class="form-check-label cursor-pointer" for="${question['QuestionId']}-2"><input class="QuestionOption" data-tempid="${question['TempId']}" data-loc="1" type="text" value="${question['QuestionOptions'][1]}" placeholder="Option 2"></label>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <input class="form-check-input cursor-pointer QuestionAnswer" data-tempid="${question['TempId']}" value="${question['QuestionOptions'][2]}" type="radio" name="${question['QuestionId']}" id="${question['QuestionId']}-3" required ${question['QuestionOptions'][2] === question['QuestionAnswer'] ? 'checked' : ''}>
                            <label class="form-check-label cursor-pointer" for="${question['QuestionId']}-3"><input class="QuestionOption" data-tempid="${question['TempId']}" data-loc="2" type="text" value="${question['QuestionOptions'][2]}" placeholder="Option 3"></label>
                        </div>
                        <div class="col">
                            <input class="form-check-input cursor-pointer QuestionAnswer" data-tempid="${question['TempId']}" value="${question['QuestionOptions'][3]}" type="radio" name="${question['QuestionId']}" id="${question['QuestionId']}-4" required ${question['QuestionOptions'][3] === question['QuestionAnswer'] ? 'checked' : ''}>
                            <label class="form-check-label cursor-pointer" for="${question['QuestionId']}-4"><input class="QuestionOption" data-tempid="${question['TempId']}" data-loc="3" type="text" value="${question['QuestionOptions'][3]}" placeholder="Option 4"></label>
                        </div>
                    </div>
                </div>
            `;
        });
    
        QuestionsContainer.innerHTML += `
            <div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">
                <button type="button" class="btn btn-primary w-25 addQuestionForm" >Add Question Form</button>
            </div>
        `;

        QuestionsContainer.innerHTML += `
            <div class="row mb-4 p-4 bg-white rounded-3 d-flex flex-column align-items-center">
                <button type="button" class="btn btn-success w-25 questionsSaveChanges" data-activityid="${Activity_Id}">Save Changes</button>
            </div>
        `;

        document.querySelectorAll('.addQuestionForm')?.forEach(element => {
            element.addEventListener('click', (e) => {
                QuestionCounts++;
                Questions.push({
                    "QuestionId": "x-"+Date.now (),
                    "Question": "",
                    "QuestionOptions": [
                        "",
                        "",
                        "",
                        ""
                    ],
                    "QuestionPoints": "0",
                    "QuestionImage": null,
                    "QuestionAnswer": "",
                    "TempId": QuestionCounts
                });
                ReRenderQuestions();
            });
        });

        document.querySelectorAll('.QuestionInput')?.forEach(element => {
            element.addEventListener('blur', (e) => {
                const input = e.currentTarget;
                Questions.forEach((row, index) => { 
                    if (row.TempId === parseInt(input.dataset.tempid)) {
                        Questions[index].Question = input.value;
                    }
                });
                ReRenderQuestions();
            });
        });
        
        document.querySelectorAll('.PointsInput')?.forEach(element => {
            element.addEventListener('blur', (e) => {
                const input = e.currentTarget;
                Questions.forEach((row, index) => { 
                    if (row.TempId === parseInt(input.dataset.tempid)) {
                        Questions[index].QuestionPoints = input.value;
                    }
                });
                ReRenderQuestions();
            });
        });

        document.querySelectorAll('.QuestionAnswer')?.forEach(element => {
            element.addEventListener('change', (e) => {
                const input = e.currentTarget;
                Questions.forEach((row, index) => { 
                    if (row.TempId === parseInt(input.dataset.tempid)) {
                        Questions[index].QuestionAnswer = input.value;
                    }

                });
                ReRenderQuestions();
            });
        });

        document.querySelectorAll('.QuestionOption')?.forEach(element => {
            element.addEventListener('blur', (e) => {
                const input = e.currentTarget;
                Questions.forEach((row, index) => { 
                    if (row.TempId === parseInt(input.dataset.tempid)) {
                        Questions[index].QuestionOptions[parseInt(input.dataset.loc)] = input.value;
                    }
                });
                ReRenderQuestions();
            });
        });

        document.querySelectorAll('.QuestionDelete')?.forEach(element => {
            element.addEventListener('click', (e) => {
                const button = e.currentTarget;
                const tempId = parseInt(button.dataset.tempid);
                const index = Questions.findIndex(row => row.TempId === tempId);
                if (index !== -1) {
                    Questions.splice(index, 1);
                }
                ReRenderQuestions();
            });
        });

        document.querySelectorAll('.questionsSaveChanges')?.forEach(element => {
            element.addEventListener('click', (e) => {
                const button = e.currentTarget;
                button.disabled = true;
                button.innerHTML = 'Saving changes...';

                let data = {
                    'Activity_Id': Activity_Id,
                    'Questions': JSON.stringify(Questions),
                };
        
                AjaxRequest.sendRequest(data, BASE_URL + "?page=assessment&item="+Activity_Id+"&action=true")
                    .then(response => {
                        console.log(response);
                        button.innerHTML = 'Success';
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    })
                    .catch(error => {
                        console.log(error);
                        button.innerHTML = 'Failed';
                        setTimeout(() => {
                            button.innerHTML = 'Save Changes';
                            button.disabled = false;
                        }, 500);
                    })
                ReRenderQuestions();
            });
        });
    };

    ReRenderQuestions();
};






// QUESTIONS ADD