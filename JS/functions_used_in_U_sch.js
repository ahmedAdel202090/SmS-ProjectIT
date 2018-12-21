/*var t=document.getElementById("Edit");
t.onclick(
    function () {
        var fading_time = 300;
        document.getElementById("original_task_title").fadeOut(fading_time);
        document.getElementById("edit_task_title").fadeIn(fading_time);
        document.getElementById("original_paragraph").fadeOut(fading_time);
        document.getElementById("edit_paragraph").fadeIn(fading_time);
        document.getElementById("original_date").fadeOut(fading_time);
        document.getElementById("edit_date").fadeIn(fading_time);
        document.getElementById("Edit").fadeOut(fading_time);
        document.getElementById("S_c").fadeIn(fading_time);
        document.getElementById("mem1").fadeIn(fading_time);
        document.getElementById("mem2").fadeIn(fading_time);
        document.getElementById("mem3").fadeIn(fading_time);
        document.getElementById("add_member").fadeIn(fading_time);

    }
);

var t2= document.getElementById("no_change_applied2");
t2.onclick(show_the_hidden);
var t3= document.getElementById("no_change_applied");
t3.onclick(show_the_hidden);

function show_the_hidden() {
    var fading_time = 300;
    document.getElementById("original_task_title").fadeIn(fading_time);
    document.getElementById("edit_task_title").fadeOut(fading_time);
    document.getElementById("original_paragraph").fadeIn(fading_time);
    document.getElementById("edit_paragraph").fadeOut(fading_time);
    document.getElementById("original_date").fadeIn(fading_time);
    document.getElementById("edit_date").fadeOut(fading_time);
    document.getElementById("Edit").fadeIn(fading_time);
    document.getElementById("S_c").fadeOut(fading_time);
    document.getElementById("mem1").fadeOut(fading_time);
    document.getElementById("mem2").fadeOut(fading_time);
    document.getElementById("mem3").fadeOut(fading_time);
    document.getElementById("add_member").fadeOut(fading_time);
}
*/
function validate_invitation_form() {
    var inv_member = document.getElementById("invite_in").value;
    var msg = "";
    if (inv_member == "") {
        msg += "please enter the E-mail of the membe you want to invite";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}

function validate_edit_list_form() {
    var temp = document.getElementById("edit_list").value;
    var msg = "";
    if (temp == "") {
        msg += "please enter the new name of the list";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}

function validate_list_form() {
    var temp = document.getElementById("org_list").value;
    var msg = "";
    if (temp == "") {
        msg += "please enter Enter the newly created list name";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}

validate_edit_task_form
function validate_task_form() {
    var temp = document.getElementById("org_task").value;
    var temp1 = document.getElementById("org_dat").value;
    var msg = "";
    if (temp == "") {
        msg += "please enter Enter the newly created task name\n";
    }
    if (temp1 == "") {
        msg += "please enter Enter the newly created task date";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}
function validate_edit_task_form() {
    var temp = document.getElementById("edit_task").value;
    var temp1 = document.getElementById("edit_dat").value;

    var msg = "";
    if (temp == "") {
        msg += "please enter Enter the new task title\n";
    }
    if (temp1 == "") {
        msg += "please enter Enter the new task date";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }

    return true;
}
