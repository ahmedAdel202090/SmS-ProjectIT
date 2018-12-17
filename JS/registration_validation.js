function validate_form() {
    var fn = document.getElementById("fname").value;
    var ln = document.getElementById("lname").value;
    var e_mail = document.getElementById("email").value;
    var pass = document.getElementById("password").value;
    var con_pass = document.getElementById("con_password").value;
    var B_date = document.getElementById("date").value;
    var msg = "";
    if (fn == "") {
        msg += "please enter your first name\n";
    }
    if (ln == "") {
        msg += "please enter your last name\n";
    }
    if (e_mail == "") {
        msg += "please enter your e-mail\n";
    }

    if (pass == "") {
        msg += "please enter a password\n";
    }
    if (con_pass == "") {
        msg += "please confirm the password\n";
    }
    if (pass != con_pass) {
        msg += "please confirm the same password correctly\n";
    }
    if (B_date == "") {
        msg += "please enter your birthdate\n";
    }
    if (document.getElementById("male").checked != true && document.getElementById("female").checked != true) {
        msg += "please select a gender\n";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}
