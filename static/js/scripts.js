// Validate Sign Up Form
function validateSignUpForm() {
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (username === '' || email === '' || password === '') {
        alert('All fields are required');
        return false;
    }
    return true;
}

// Validate Sign In Form
function validateSignInForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (email === '' || password === '') {
        alert('Email and password are required');
        return false;
    }
    return true;
}
