import AjaxRequest from './ajax.js';

window.handleCredentialResponse = (response) => {
    window.location.href = `${BASE_URL}index.php?page=login&action=process&token=${response.credential}`;
}



// STUDENTS 
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
            'Group': Group
        };
    
        AjaxRequest.sendRequest(data, BASE_URL + "?page=students&action=true")
            .then(response => {
                document.getElementById('student-email').value = "";
                document.getElementById('student-group').value = "";
                document.getElementById('student-add-success').innerHTML = "Success!";
            })
            .catch(error => {
                document.getElementById('student-add-failed').innerHTML = "Failed, Try Again!"
            })
            .finally(() => {
                StudentsSubmitAddAccountBtn.disabled = false;
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
