function validate_admin_form() {
    var user_name = document.getElementById("user_name").value;
    var pass = document.getElementById("password").value;
    var msg = "";
    if (user_name == "") {
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
