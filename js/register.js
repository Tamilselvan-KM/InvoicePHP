//register validation
var registerForm = document.querySelector('#registerForm'),
    firstName = document.querySelector('.firstName'),
    lastName = document.querySelector('.lastName'),
    email = document.querySelector('.email'),
    pass = document.querySelector('.password'),
    confirmPass = document.querySelector('.confirmPassword'),
    address = document.querySelector('.address'),
    city = document.querySelector('.city'),
    postalCode = document.querySelector('.postalCode'),
    state = document.querySelector('.state'),
    country = document.querySelector('.country');
function register() {
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        validateRegister();
    });
}
function validateRegister() {
    let regEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let isError = false;
    userFname = firstName.value;
    userLname = lastName.value;
    userMail = email.value;
    userpass = pass.value;
    userConfirmPass = confirmPass.value;
    userAddress = address.value;
    userCity = city.value;
    userPostal = postalCode.value;
    userState = state.value;
    userCountry = country.value;
    if (firstName.value === '' || email.value === '' || pass.value === '' || confirmPass.value === '' ||
        address.value === '' || city.value === '' || postalCode.value === '') {
        addError('Please Enter All required fields', 'all');
        isError = true;
    } else if (!email.value.match(regEmail)) {
        addError('Please Enter valid email', 'all');
        isError = true;
    } else if (!(pass.value === confirmPass.value)) {
        addError('Password and Confirm Password Should Match', 'all');
        isError = true;
    }
    if (!isError) {
        // console.log('ok')
        let xhttp = new XMLHttpRequest();
        let data = {
            firstName: userFname,
            lastName: userLname,
            email: userMail,
            password: userpass,
            confirmPassword: userConfirmPass,
            address: userAddress,
            city: userCity,
            postalCode: userPostal,
            state: userState,
            country: userCountry
        }
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                if (this.responseText == 1) {
                    registerForm.reset();
                    alert('register successfull..!');
                    location.href = "./login.php";
                } else if (this.responseText == "firstName") {
                    registerForm.reset();
                    alert('Already an existing user ..!');
                    location.href = "./login.php";
                }
                else {
                    alert('some error occured please try again later');
                }
            }
        };
        xhttp.open('POST', 'data.php', false);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.send(JSON.stringify(data));
    } else {
        firstName.value = '';
        lastName.value = '';
        email.value = '';
        pass.value = '';
        confirmPass.value = '';
        address.value = '';
        city.value = '';
        postalCode.value = '';
        state.value = 'tn';
        country.value = 'india';
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

firstName.addEventListener('change', () => {
    clearError('all');
});
window.onload = register();