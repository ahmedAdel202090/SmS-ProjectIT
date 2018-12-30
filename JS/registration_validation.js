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
    const validate = (email) => {
        const expression = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

        //other regexes that will cause more validation issues

        //const expression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        //const expression = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/
        //const expression = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

        //simplest ever, but with many false positives
        //const expression = /\S+@\S+/;

        return expression.test(String(email).toLowerCase())
    }
   

    if(validate(pass))
    {
        msg+="please enter a valid password characters";
    }
    if(validate(e_mail))
    {
        msg+="please enter valid email characters";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}
