
window.handleCredentialResponse = (response) => {
    window.location.href = `${BASE_URL}index.php?page=login&action=process&token=${response.credential}`;
}



