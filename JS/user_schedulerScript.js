function edit(id){
    var fading_time = 300;
    $("#original_task_title"+id).fadeOut(fading_time);
    $("#edit_task_title"+id).fadeIn(fading_time);
    $("#original_paragraph"+id).fadeOut(fading_time);
    $("#edit_paragraph"+id).fadeIn(fading_time);
    $("#original_date"+id).fadeOut(fading_time);
    $("#edit_date"+id).fadeIn(fading_time);
    $("#Edit"+id).fadeOut(fading_time);
    $("#S_c"+id).fadeIn(fading_time);
    $("#E_M"+id).fadeOut(fading_time);
}
function edit_members(id) {
    var fading_time = 300;
    $("#S_M_c"+id).fadeIn(fading_time);
    $("#add_member"+id).fadeIn(fading_time);
    $("#E_M"+id).fadeOut(fading_time);
    $("#Edit"+id).fadeOut(fading_time);
}
//$("#no_change_applied2").click(show_the_hidden());
//$("#no_change_applied").click(show_the_hidden);
/*function show_the_hidden(id) {
    var fading_time = 300;
    $("#original_task_title"+id).fadeIn(fading_time);
    $("#edit_task_title"+id).fadeOut(fading_time);
    $("#original_paragraph"+id).fadeIn(fading_time);
    $("#edit_paragraph"+id).fadeOut(fading_time);
    $("#original_date"+id).fadeIn(fading_time);
    $("#edit_date"+id).fadeOut(fading_time);
    $("#Edit"+id).fadeIn(fading_time);
    $("#S_c"+id).fadeOut(fading_time);
    $("#add_member"+id).fadeOut(fading_time);
    $("#E_M"+id).fadeIn(fading_time);
    $("#S_M_c"+id).fadeOut(fading_time);
}*/
$("#edit_schedule").submit(function(event)
  {
        event.preventDefault();
        var formData=$("#edit_schedule").serialize();
        $.ajax({
          url:$("#edit_schedule").attr("action"),
          type:'POST',
          data:formData,
          success:function()
          {
          }
      });
  }
);
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
  $("#invite_user").submit(function(event)
  {
        if(validate_invitation_form())
        {
            var user_id=document.getElementById("user_id").value;
            var user_name=document.getElementById("user_name").value;
            var user_email=document.getElementById("user_email").value;
            event.preventDefault();
            var formData=$("#invite_user").serialize();
            $.ajax({
                url:$("#invite_user").attr("action"),
                type:'POST',
                data:formData,
                success:function()
                {
                    var new_member='<div style="margin: 4px;border: 1.5px solid #0067A3;"><form method="POST" id="delete_onBoard" action="deleteUserFromBoard.php"><input type="hidden" id="user_id" name="user_id" value="'+user_id +'<span class="dropdown-item" style="font-size: 20px;"><a class="btn btn-dark" id="user_name" style="color: rgb(255, 255, 255)" href="#">'+user_name+'</a><div style="float: right;clear: right;"><button type="submit" class="btn btn-outline-danger" style="border-radius:50px; " aria-hidden="true">&times;</button></div><br><span class="badge badge-light" id="user_email" style="font-size:12px; ">'+user_email+'</span></span></form></div>';
                    $("#show_users").append(new_member);
                }
      });
        }
  });
  $("#delete_onBoard").submit(function(event)
  {
            
            event.preventDefault();
            var formData=$(this).serialize();
            $.ajax({
                url:$(this).attr("action"),
                type:'POST',
                data:formData,
                success:function()
                {
                    $("#delete_onBoard").parent().remove();
                }
      });

  });
  function validate_edit_project_form() {
    var temp = document.getElementById("edit_project").value;
    var msg = "";
    if (temp == "") {
        msg += "please enter the new name of the project";
    }
    if (msg != "") {
        alert(msg);
        return false;
    }
    return true;
}
$("#edit_schedule").submit(function(event)
  {
      if(validate_edit_project_form())
      {
        var new_name=document.getElementById("edit_project").value;
        event.preventDefault();
        var formData=$("#edit_schedule").serialize();
        $.ajax({
            url:$("#edit_schedule").attr("action"),
            type:'POST',
            data:formData,
            success:function()
            {
                document.title=new_name;
                $("#exampleModal9").modal('hide');
                $("#project_name").html(new_name);
                
            }
        });
      }
  });
  
