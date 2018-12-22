function validate_login_form() {
    var user_name = document.getElementById("user_name").value;
    var pass = document.getElementById("password").value;
    var msg = "";
    if (user_name == "") {
        msg += "please enter your username\n";
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
