function validate_login_form() {
    var email = document.getElementById("Email").value;
    var pass = document.getElementById("password").value;
    var msg = "";
    if (email == "") {
        msg += "please enter your E-mail\n";
    }
    if (pass == "") {
        msg += "please enter your password";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}
