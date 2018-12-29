function validate_user_form(id) {
    var user_name = document.getElementById("user_name"+id).value;
    var email = document.getElementById("user_email"+id).value;
    var pass= document.getElementById("user_pass"+id).value;
    var msg = "";
    if (user_name == "") {
        msg += "please enter user name\n";
    }
    if (pass == "") {
        msg += "please enter user password";
    }
    if(email == "")
    {
        msg+="please enter user mail";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}
function validate_admin_edit_form(id)
{
    var user_name = document.getElementById("admin_name"+id).value;
    var pass= document.getElementById("admin_pass"+id).value;
    var msg = "";
    if (user_name == "") {
        msg += "please enter user name\n";
    }
    if (pass == "") {
        msg += "please enter user password";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}
function validate_add_form()
{
    var user_name = document.getElementById("admin_name").value;
    var pass= document.getElementById("admin_pass").value;
    var msg = "";
    if (user_name == "") {
        msg += "please enter user name\n";
    }
    if (pass == "") {
        msg += "please enter user password";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}