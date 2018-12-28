function edit_task(id){
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
function show_the_hidden(id) {
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
}


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
                $("#project_modal").modal('hide');
                $("#project_name").html(new_name);
                
            }
        });
      }
  });
  
//==========================================================




function show_the_hidden(id) {
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
}   
     function load_added_users(id)
  {
    $.ajax({
 
        url:"fetchUsersOnTask.php",
        method:"POST",
        data:"task_id="+id,
        dataType:"json",
        success:function(data)
        {
            $("#T"+id).html(data.users); 
        },
        error:function() {
            alert("faild");
        }
       });
  }
  function delete_user_from_task(task_id,user_id)
  {
        $.ajax({
            url:"deleteUserFromTask.php",
            type:'POST',
            data:{user_id: user_id , task_id: task_id},
            success:function()
            {
                load_added_users(task_id);     
            }
          });
  }
  $(".edit_members").submit(function(event)
  {
      event.preventDefault();
      var task_id = $("input[name='task_id']",this).val();
      var email=$("#add_member"+task_id).val();
      var formData=$(this).serialize();
          $.ajax({
            url:$(this).attr("action"),
            type:'POST',
            dataType:"json",
            data:formData,
            success:function(data)
            {
                if(data.isOnBoard && data.isRegistred)
                    {
                        load_added_users(task_id);
                        show_the_hidden(task_id); 
                    }
                    else if(!data.isRegistred)
                    {
                        alert("this user not registered yet!!");
                    }
                    else
                    {
                        alert("this user not on board");
                    }    
            }
          });
  }
);
    function edit_list(id,name)
    {
        $("#edit_id").val(id);
        $("#edit_list").val(name);
        $('#exampleModal8').modal('show');
    }
    function add_task(list_id)
    {
        $("#list_id").val(list_id);
        $('#exampleModal2').modal('show');
    }
      $("#edit_list_form").submit(function(event)
        {
            var new_name=document.getElementById("edit_list").value;
            var id=document.getElementById("edit_id").value;
            event.preventDefault();
                var formData=$(this).serialize();
                $.ajax({
                url:$(this).attr("action"),
                type:'POST',
                data:formData,
                success:function()
                {
                    $("#list_name"+id).html(new_name);
                    $("#exampleModal8").modal('hide');
                }
      });

  });
      function delete_list(id)
      {
          $.ajax({
            url:"deleteList.php",
            type:'POST',
            data:"list_id="+id,
            success:function()
            {
                $("#list"+id).remove();

            }
          });
      }
      function delete_task(id)
      {
        $.ajax({
            url:"deleteTask.php",
            type:'POST',
            data:"task_id="+id,
            success:function()
            {
                $("#task"+id).remove();

            }
          });
          
      }


      //task
      
function edit_task(id){
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
function edit(task_id)
{
    var title= $("#task_title"+task_id).text();
    $("#edit_task"+task_id).val(title);
    var pargraph=$("#original_paragraph"+task_id).text();
    $("#edit_paragraph"+task_id).val(pargraph);
    var time=$("#time"+task_id).text();
    $("#update_time"+task_id).val(time);
    var date=$("#date"+task_id).text();
    $("#update_date"+task_id).val(date);
    edit_task(task_id);
}
function fetch_task(task_id,list_name)
{
    $.ajax({
        url:"fetchTask.php",
        type:"POST",
        dataType:"json",
        data:{task_id: task_id , list_name: list_name},
        success:function(data){
            $("#task_form"+task_id).html(data.task_data);
            $("#task_name"+task_id).html(data.name);
            var due_date=new Date(data.due_date);
            const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];
            $("#due_date"+task_id).html(monthNames[due_date.getMonth()]+" "+due_date.getDate());
            //$("#date_time"+task_id).html(due_date.getDate()+" "+monthNames[due_date.getMonth()]+" At "+formatAMPM(due_time));
        },
        error:function(){
            alert("faild edit!!");
        }
    });
}
function validate_edit_task_form(task_id) {
    var temp = document.getElementById("edit_task"+task_id).value;
    var temp1 = document.getElementById("update_date"+task_id).value;
    var temp2 = document.getElementById("update_time"+task_id).value;
    var msg = "";
    if (temp == "") {
        msg += "please enter Enter the new task title\n";
    }
    if (temp1 == "") {
        msg += "please enter Enter the new task date\n";
    }

    if (temp2 == "") {
        msg += "please enter Enter the new task time";
    }

    if (msg != "") {
        alert(msg);
        return false;
    }

    return true;
}
$(".edit_task_form").submit(function(event){
    event.preventDefault();
    var task_id = $("input[name='task_id']",this).val();
    var list_name=$("#task_form"+task_id).attr('list-name');
    var formData=$(this).serialize();
    if(validate_edit_task_form(task_id))
    {
    $.ajax({
        url:$(this).attr("action"),
        type:"POST",
        data:formData,
        success:function()
        {
            fetch_task(task_id,list_name);
            show_the_hidden(task_id);
        }
    });
    }
});



