//login validation
var loginForm = document.querySelector('#loginForm'),
    emailInput = document.querySelector('.email'),
    passInput = document.querySelector('.password');
function login() {
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        validateLogin();
    });
}
function validateLogin() {
    let a = emailInput.value;
    let b = passInput.value;
    let regEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let isError = false;
    if (a === '' || b === '') {
        addError('please enter email or password', 'all');
        isError = true;
    } else if (!a.match(regEmail)) {
        addError('please enter valid email', 'email');
        isError = true;
    } else if (b.length > 12 || b.length < 6) {
        addError('Password should contains 6-12 characters', 'pass');
        isError = true;
    }
    if (!isError) {
        // console.log('ok')
        let xhttp = new XMLHttpRequest();
        let data = {
            email: a,
            password: b
        }
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
                if (JSON.parse(this.responseText) == 1) {
                    alert('login Successful');
                    location.href = './main.php';
                }
                else {
                    alert('Invalid username or password');
                    location.href = './login.php';
                }
            }
        };
        xhttp.open('POST', 'log.php', false);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.send(JSON.stringify(data));
    } else {
        emailInput.value = '';
        passInput.value = '';
    }
}
function addError(message, id) {
    let errid = id + 'Error';
    let span = document.querySelector('.' + errid);
    return span.innerText = message;
}
function clearError(id) {
    let errid = id + 'Error';
    let span = document.querySelector('.' + errid);
    return span.innerText = "";
}

emailInput.addEventListener('change', () => {
    clearError('all');
    clearError('email');
    clearError('pass');
});
window.onload = login();