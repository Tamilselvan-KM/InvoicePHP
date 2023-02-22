//client clientEditForm validation
var clientEditForm = document.querySelector('#clientEditForm'),
    clientId = document.querySelector('#clientId'),
    firstName = document.querySelector('.firstName'),
    lastName = document.querySelector('.lastName'),
    email = document.querySelector('.email'),
    address = document.querySelector('.address'),
    city = document.querySelector('.city'),
    postalCode = document.querySelector('.postalCode'),
    state = document.querySelector('.state'),
    country = document.querySelector('.country'),
    phone = document.querySelector('.phoneNumber'),
    taxNumber = document.querySelector('.taxNumber');
notes = document.querySelector('.notes');
function clientEdit() {
    clientEditForm.addEventListener('submit', (e) => {
        e.preventDefault();
        editForm();
    });
}
function editForm() {
    let regxEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let regxPhone = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
    let isError = false;
    userFname = firstName.value;
    userLname = lastName.value;
    userMail = email.value;
    userAddress = address.value;
    userCity = city.value;
    userPostal = postalCode.value;
    userState = state.value;
    userCountry = country.value;
    userPhone = phone.value;
    userTaxNumber = taxNumber.value;
    userNotes = notes.value;
    if (firstName.value === '' || email.value === '' || phone.value == '' || taxNumber.value == '') {
        addError('Please Enter All required fields', 'all');
        isError = true;
    } else if (!email.value.match(regxEmail)) {
        addError('Please Enter valid email', 'all');
        isError = true;
    } else if (!phone.value.match(regxPhone)) {
        addError('Please Enter valid phone number', 'all');
        isError = true;
    }
    if (!isError) {
        // console.log('ok')
        let xhttp = new XMLHttpRequest();
        let data = {
            firstName: userFname,
            lastName: userLname,
            email: userMail,
            address: userAddress,
            city: userCity,
            postalCode: userPostal,
            state: userState,
            country: userCountry,
            phone: userPhone,
            taxNumber: userTaxNumber,
            notes: userNotes,
            clientId: clientId.value
        }
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                if (this.responseText == 1) {
                    alert('Update Successful');
                    location.href = 'viewClients.php';
                }
                else {
                    alert('some error occured please try again later');
                }
            }
        };
        xhttp.open('POST', 'includes/clientUpdate.php', false);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.send(JSON.stringify(data));
    } else {
        firstName.value = '';
        lastName.value = '';
        email.value = '';
        address.value = '';
        city.value = '';
        postalCode.value = '';
        phone.value = '';
        state.value = '';
        taxNumber.value = '';
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
window.onload = clientEdit();