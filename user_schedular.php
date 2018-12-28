<!DOCTYPE html>
<html>

<?php
      session_start();
      if(!isset($_SESSION["Email"]) && !isset($_SESSION["Password"]))
      {
        header("location:index.html");
      }
      if(isset($_GET['logOut']))
      {
        session_destroy();
        header("location:index.html");
      }
      if(isset($_POST["board_id"]))
      {
          $_SESSION["board_id"]=$_POST["board_id"];
      }
      if(isset($_SESSION["exist_on_board"]))
      {
        if($_SESSION["exist_on_board"])
        {
          $_SESSION["exist_on_board"]=false;
          echo '<script>alert("this user already existed on board")</script>';
        }
      }
      if(isset($_SESSION["not_exist"]))
      {
          if($_SESSION["not_exist"])
          {
            $_SESSION["not_exist"]=false;
            echo '<script>alert("this user does not exist")</script>';
          }
      }
      $email=$_SESSION["Email"];
      $pass=$_SESSION["Password"];
      $con=mysqli_connect("localhost","root","","sms");
      $query="SELECT * FROM user WHERE email='$email' AND password='$pass'";
      $result=mysqli_query($con,$query);
      $user =mysqli_fetch_assoc($result);
      $user_id=$user["user_id"];
      $board_id=$_SESSION["board_id"];
      //============================================
      $query="SELECT * from board where board_id=$board_id";
      $result=mysqli_query($con,$query);
      $board=mysqli_fetch_assoc($result);
      //======== get list==================
      $query="SELECT * FROM list WHERE board_id=$board_id";
      $lists=mysqli_query($con,$query);
  ?>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php echo '<title>'.$board["name"].'</title>'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/all.min.css" />
    <link rel="stylesheet" href="CSS/user_sch_style.css" />
</head>
<body>
    <!--video   *****-->
    <video id="bgVideo" autoplay loop muted>
        <source src="./images/2.mov" type="video/mp4">
    </video>
    <!--nav bar-->
    <div style="position: fixed;width: 100%;z-index:50;">
        <section class="container-fluid" style="background-color: #0067A3;">
            <div class="row">
                <!--Home-->
                <div class="col">
                    <a href="userHome.php" class="btn btn-group-toggle" style="background-color: #3385B5;">
                        <i class="fas fa-home fa-2x" style="color: white"></i>
                    </a>
                </div>
                <!--==================================================-->
                <!--Brand-->
                <div class="col">
                    <div style="width: 50px; margin: auto">
                        <a href="userHome.php" class="navbar-brand" style="font-size: 1.7rem;color: white;font-family:fantasy">
                            <i class="fas fa-table"></i>
                            SmS
                        </a>
                    </div>
                </div>
                <!--==================================================-->
                <!--notification & user-->
                <div class="col" style="margin-right: 130px;">
                    <div class="col-lg-2" style="float: right">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-user-circle fa-2x" style="color: white"></i>
                        </a>
                        <!--user menue-->
                        <div class="dropdown-menu" id="user_menu" aria-labelledby="navbarDropdownMenuLink">
                         <span class="dropdown-item badge badge-light" style="font-size:16px;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-weight: bold;"><?php echo $user["name"] ?></span>
                         <div class="dropdown-item badge badge-light"><p style="word-wrap: break-word;white-space: normal;width:60%"><?php echo $email ?></p></div>
                        <form class="dropdown-item">
                               <input type="hidden"  name="logOut" value="true"/>
                               <input type="submit" class="btn btn-danger" value="Log Out"/>
                        </form>
          </div>

                        <!--==============================================-->
                    </div>
                    <div class="col-lg-2" style="float:right;margin-top:2px ">
                        <a style="background-color: #CF513D;color: white;padding: 5px" class="nav-link dropdown-toggle btn btn-group-toggle" href="#"
                            id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-bell fa-2x"></i>
                            <!--notification numbers-->
                            <span class="badge badge-light" style="background-color: rgb(11, 228, 11);border-radius:100px;color: white ">10</span>
                            <!--notification numbers-->
                        </a>
                        <!--notification menu-->
                        <div class="dropdown-menu" id="notifincation_menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                        <!--=================================================-->
                    </div>
                    <!--================================================-->
                </div>

            </div>
        </section>
        <!--==================================project name=============================-->


        <div style="padding: 8px;background-color: rgba(255, 255, 255, 0.664);">
            <span style="font-size:1.8rem ; font-weight: bold;color: rgba(51, 51, 51, 0.774);margin-left: 50px; margin-right: 100px;">
                <span class="btn btn-outline-dark" id="popup_of_edit_project_name" data-toggle="modal" data-target="#project_modal" style="font-size: 18px;">
                   <i class="far fa-edit"></i>
                </span>
                <span id="project_name"><?php echo $board["name"] ?></span> 
            </span>
            <div class="just_floatl" style="clear: both;margin-right: 250px;margin-top:5px; ">
                <!--the invite dropdown-->
                <div class="dropdown" style="display: inline-block;">
                    <a href="#" class="btn btn-light dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true">share</a>
                    <div class="dropdown-menu" style="width:450px;" aria-labelledby="navbarDropdownMenuLink">
                        <div class="dropdown-item" style="width:auto;">
                            <!--invite form --> 
                            <form name="invite_form" id="invite_user" action="inviteUserToBoard.php" method="POST">
                                <input id="invite_in" type="email" name="email" class="form-control" placeholder="enter the e-mail of the member you want to invite">
                                <br>
                                <button type="submit"  class="btn btn-success" name="invite_button">send</button>
                            </form>
                            <!--===============================================================-->
                        </div>
                    </div>
                </div>

                <div class="dropdown" style="display: inline-block;">
                    <a class="btn btn-dark dropdown-toggle" style="color:rgb(255, 255, 255)" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown"
                        aria-haspopup="true">
                        Project Members</a>
                    <!--user menu-->
                    <div id="show_users" class="dropdown-menu pre-scrollable" style="width:auto;" aria-labelledby="navbarDropdownMenuLink1">
                            <?php
                               
                                 $query="SELECT u.name,u.email,u.user_id,b.admin FROM board b,onboard o,user u WHERE b.board_id=o.board_id and u.user_id=o.user_id and o.board_id=$board_id";
                                 $users_on_board=mysqli_query($con,$query);
                            
                                 while($row=mysqli_fetch_assoc($users_on_board))
                                 {
                
                                     if($user_id!=$row["user_id"])
                                     {
                                         if($row["user_id"]==$row["admin"])
                                         {
                                            echo '<div style="margin: 4px;border: 1.5px solid #0067A3;">
                                            <span class="dropdown-item" style="font-size: 20px;">
                                                <a class="btn btn-dark" style="color: rgb(255, 255, 255)" href="#">'.$row["name"].'</a>
                                                <br>
                                                <span class="badge badge-light" style="font-size:12px; ">'.$row["email"].'</span>
                
                                            </span>
                                        </div>';
                                         }
                                         else
                                         {
                                            $curr_user_id=$row["user_id"];
                                            echo '<div  style="margin: 4px;border: 1.5px solid #0067A3;">
                                            <form method="POST" class="delete_from_board" id="delete_onBoard" action="deleteUserFromBoard.php">
                                            
                                                <input type="hidden" id="user_id" name="user_id" value="'.$curr_user_id.'"/>
                                                <span class="dropdown-item" style="font-size: 20px;">
                                                    <a class="btn btn-dark" id="user_name" style="color: rgb(255, 255, 255)" href="#">'.$row["name"].'</a>
                                                    <div style="float: right;clear: right;">
                                                        <button type="submit" class="btn btn-outline-danger" style="border-radius:50px; " aria-hidden="true">&times;</button>
                                                    </div>
                                                    <br>
                                                    <span class="badge badge-light" id="user_email" style="font-size:12px; ">'.$row["email"].'</span>
                                            </span>
                                            </form>
                                        </div>';
                                         }
                                     }
                                 }
                                 
                            ?>        
                    <!--user block start-->    
                        <!--user block end-->

                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <!--===============================================================-->
<div class="page" id="lists" style="position: relative;top: 115px;">
    <?php
        while($row=mysqli_fetch_assoc($lists))
        {
            $list_id=$row["id_list"];
            $name=$row["name"];
            $query="SELECT * FROM task WHERE list_id=$list_id";
            $tasks=mysqli_query($con,$query);
            echo '<div class="outer_div" id="list'.$list_id.'">';
            //list
            echo '<div>
            <h1 id="list_name'.$list_id.'"  class="badge badge-primary" style="font-size:2rem;margin:7px;border-radius: 20px;">
                '.$row["name"].'
            </h1>
            <span class="btn btn-light dropdown-toggle"  style="float: right; clear: right;margin: 7px;border-radius: 20px;" href="#"
                id="delete_menu1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </span>
            <div class="dropdown-menu" id="delete_menu1" aria-labelledby="navbarDropdownMenuLink">
                <a  class="dropdown-item" href="javascript:delete_list('.$list_id.')">Delete List</a>
                <a class="dropdown-item"  href="#exampleModal8" onclick="edit_list(\''.$list_id.'\',\''.$name.'\')" >Edit List name</a>
            </div>
        </div>';
            //list's tasks
            while($rowTask=mysqli_fetch_assoc($tasks))
            {
                $date=date_create($rowTask["due_date"]);
                $task_id=$rowTask["id_task"];
                echo '<div class="inner_div" id="task'.$rowTask["id_task"].'">
                <h5>
                    <span class="btn btn-light" id="task_name'.$task_id.'" style="width:85%;white-space: initial;text-align: initial;border-radius: 20px; font-size:1.2rem; font-weight:bold;"
                        data-toggle="modal" data-target="#task_Modal'.$task_id.'">'.$rowTask["name"].'</span>

                    <span class="btn btn-light dropdown-toggle" style="float: right; clear: right;border-radius: 20px;" href="#" id="delete_menu"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <div class="dropdown-menu" id="delete_menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="javascript:delete_task('.$rowTask["id_task"].')">Delete Task</a>
                    </div>
                </h5>
                <span class="badge badge-light" style="font-size:1.1rem; ">
                    <i class="fas fa-align-left"></i>
                </span>
                <span class="badge badge-danger" style="font-size:1.1rem; ">
                    <i class="far fa-bell"></i>
                </span>
                <span class="badge badge-success" style="font-size:1.1rem; ">
                    <i class="far fa-clock"></i>
                    <span id="due_date'.$task_id.'">'.date_format($date,"F d").'</span>
                </span>

            </div>';
                //Task modal
                echo '
            <div class="modal fade" id="task_Modal'.$task_id.'" tabindex="-1" role="dialog" aria-labelledby="task_title" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 1500px;width:800px; " role="document">
                    <div class="modal-content">
                        <!--==========================original model header======================-->
                        <form name="edit_task_form" id="task_form'.$task_id.'" list-name="'.$name.'" class="edit_task_form" action="editTask.php" onsubmit="return validate_edit_task_form()" method="POST">
                            <input type="hidden" name="task_id" value="'.$task_id.'" />
                            <div class="modal-header">
                                <div class="col" id="original_task_title'.$task_id.'">
                                    <h3 class="modal-title" style="color: rgb(0, 57, 212)" id="task_title'.$task_id.'">'.$rowTask["name"].'</h3>
                                    <span>
                                        <span>in list</span>
                                        <a href="#" id="in_list">'.$row["name"].'</a>
                                    </span>
                                </div>
        
        
                                <!--==========================edit model header======================-->
        
                                <div class="col" style="display: none;" id="edit_task_title'.$task_id.'">
                                    <span style="font-size:25px; ">Task name</span>
                                    <input class="modal-title form-control" id="edit_task'.$task_id.'" type="text" name="task_name" placeholder="Task title">
                                </div>
                                <button id="no_change_applied2" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!--==========================original model body======================-->
                            <div class="modal-body">
                                <h5>Description</h5>
                                <p id="original_paragraph'.$task_id.'" style="color: rgb(65, 61, 61);">'.$rowTask["description"].'</p>
                                <h6 id="original_date'.$task_id.'">Due Date
                                    <span id="date_time'.$task_id.'" class="badge badge-success" >'.date_format($date,"d F").' At '.date('h:i A', strtotime($rowTask["due_time"])).'</span>
                                    <span id="date'.$task_id.'" style="display:none;">'.date_format($date,"Y-m-d").'</span>
                                    <span id="time'.$task_id.'" style="display:none;">'.date('H:i:s', strtotime($rowTask["due_time"])).'</span>
                                </h6>
                                <!--==========================edit model body======================-->
        
                                <textarea class="form-control" id="edit_paragraph'.$task_id.'" rows="10" name="edit_paragraph" style="white-space:nowrap;display: none;">
                                </textarea>
        
                                <span id="edit_date'.$task_id.'" style="display: none; ">Due date
                                    <span class="row">
                                        <input id="update_date'.$task_id.'" class="modal-title form-control" style="width:47%;margin-left: 15px;" type="date" name="due_date">
                                        <input id="update_time'.$task_id.'" class="modal-title form-control" style="width:47%;margin-left: 15px;" type="time" name="due_time">
                                    </span>
                                </span>
                            </div>
                        </form>
                        <!--==========================end model===================-->
                        ';
                        echo'
                    <form class="edit_members" name="edit_members_form'.$task_id.'" id="edit_members_form'.$task_id.'" onsubmit="return validate_add_new_member_form()" action="addUserToTask.php" method="POST">
                        <div style="margin-left:15px;">
                            <h5>Task members:</h5>';
                        echo '<div id="T'.$task_id.'">';
                        $query="SELECT u.user_id,u.name,u.email FROM user u,task t,assigned a WHERE u.user_id=a.user_id and t.id_task=a.task_id and t.id_task=$task_id";
                        $users_assigned=mysqli_query($con,$query);
                        while($rowUser=mysqli_fetch_assoc($users_assigned))
                        {
                            echo '
                            <div style="margin: 4px;border: 1.5px solid #0067A3;display:inline-block;">
                            <span class="dropdown-item" style="font-size: 20px;">
                                <a class="btn btn-success" style="color: rgb(255, 255, 255)" href="#">'.$rowUser["name"].'</a>
                                <div style="float: right;clear: right;">
                                    <span class="btn btn-outline-danger" onclick="delete_user_from_task(\''.$task_id.'\',\''.$rowUser["user_id"].'\')" style="border-radius:50px; " aria-hidden="true">&times;</span>
                                </div>
                                <br>
                                <span class="badge badge-light" style="font-size:12px; ">'.$rowUser["email"].'</span>
                            </span>
                        </div>
                            ';
                        }
                        echo '</div>';
                        echo'
                                <input type="hidden" name="task_id" value="'.$task_id.'"/>
                                <input name="email" id="add_member'.$task_id.'" style="width: 500px; margin: 10px;border: 1.5px solid rgb(53, 147, 201);display: none;"
                                type="email" placeholder="enter the e-mail of the member to be added" class="form-control"/>
                        </div>
                    </form>
                        ';
                    
                            
                    echo'
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="no_change_applied" onclick="show_the_hidden('.$task_id.')" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="Edit'.$task_id.'" onclick="edit('.$task_id.')">Edit all</button>
                            <button type="button" class="btn btn-outline-primary" id="E_M'.$task_id.'" onclick="edit_members('.$task_id.')">Add member</button>
                            <button type="submit" class="btn btn-primary" id="S_c'.$task_id.'"  form="task_form'.$task_id.'" style="display: none;">Save changes</button>
                            <button type="submit" class="btn btn-primary" id="S_M_c'.$task_id.'" form="edit_members_form'.$task_id.'" style="display: none;">Save changes</button>
                        </div>
        
                    </div>
        
                </div>
            </div>
        
                ';

            }
            echo '<div class="inner_div add" id="modal_add" style="text-align: center;"  data-toggle="modal" data-target="#exampleModal2" onclick="add_task('.$list_id.')">
            <h2 class="badge badge-light"  style="font-size: 1.3rem;text-align: center; margin: 0px;padding: 1.3rem;">
                <i class="fas fa-plus"></i>
                Add new task
            </h2>
        </div>';
            echo '</div>';

        }
    ?>
    <!--end tasks-->
    <div class="outer_div">
            <div class="inner_div add" style="text-align: center;" data-toggle="modal" data-target="#exampleModal3">
                <h2 class="badge badge-light" style="font-size: 1.6rem;text-align: center;margin: 0px;padding: 1.3rem;">
                    <i class="fas fa-plus"></i>
                    Add new list
                </h2>
            </div>
    </div>
</div>
    <!--task pop up-->
        <!--====================add new task pop up===========================================-->
    <!--====================end of editing=====================================================-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px;width:600px;height: 500px;margin-top:35% " role="document">
            <div class="modal-content">
                <form name="task_form" action="addNewTask.php" onsubmit="return validate_task_form()" method="POST">
                    <div class="modal-header" style="display: block;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div style="margin: 7px;">
                            <span>Task name</span>
                            <input class="form-control" type="text" name="task_name" id="org_task" placeholder="enter the task name">
                            <?php echo '<input type="hidden" id="list_id" name="list_id" value="" />' ?>
                        </div>
                        <div style="margin: 7px;">
                            <span>Due date</span>
                            <span class="row">
                                <input class="form-control" style="width: 47%;margin-left: 15px;" type="date" name="due_date" id="org_dat">
                                <input class="form-control" style="width: 47%;margin-left: 5px;" type="time" name="due_time" id="org_time">
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--====================add new list pop up===========================================-->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px;width:600px;height: 500px;margin-left:35% " role="document">
            <div class="modal-content">
                <form name="list_form" action="addNewList.php" onsubmit="return validate_list_form()" method="POST">
                    <div class="modal-header">
                        <!--the name of the newly created list-->
                        <div class="col">
                            <span>List Title</span>
                            <input class="modal-title form-control" type="text" name="list_name" id="org_list" placeholder="Enter newly created list name">
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--================edit list name pop up=====================-->

    <div class="modal fade"  id="exampleModal8">
        <div class="modal-dialog" style="max-width: 800px;width:600px;height: 500px;margin-left:35% " role="document">
            <div class="modal-content">
                <form id="edit_list_form" name="edit_list_form" action="editList.php"  method="POST">
                    <div class="modal-header">
                        <!--the edited name-->
                        <div class="col">
                            <?php echo '<input type="hidden" id="edit_id" name="list_id" value="" />' ?>
                            <input class="form-control" type="text" id="edit_list" name="list_name" placeholder="Edit list name">
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="project_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px;width:600px;height: 500px;margin-left:35% " role="document">
            <div class="modal-content">
                <!-- edit project name form -->
                <form name="edit_project_form" id="edit_schedule"  action="editScheduleName.php"  method="POST">
                    <div class="modal-header">
                        <!--the edited name-->
                        <div class="col">
                            <?php
                                echo '<input class="form-control" type="text" id="edit_project" name="name" value="'.$board["name"].'" placeholder="Edit project name">';
                            ?>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="JS/all.min.js"></script>
    <script src="JS/functions_used_in_U_sch.js"></script>
    <script src="JS/jquery-3.3.1.min.js"></script>
    <script src="JS/bootstrap.bundle.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/user_schedulerScript.js"></script>
    <script>
        function load_all_lists(){
    $.ajax({
        url:"fetchAllTasks.php",
        type:"POST",
        dataType:"json",
        success:function(data){
            $("#lists").html(data.lists);
        },
        error:function(){
            alert("faild");
        }
    });
}
$(".delete_from_board").submit(function(event)
{
          
          event.preventDefault();
          var formData=$(this).serialize();
          $.ajax({
              url:$(this).attr("action"),
              type:'POST',
              data:formData,
              success:function()
              {
                  fetch_users_onBoard();
                  load_all_lists();
              }
    });

});

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
function fetch_users_onBoard()
{
    var user_id= "<?php echo $user_id; ?>";
    $.ajax({
        url:"fetchInvitedUser.php",
        type:"POST",
        data:{user_id:user_id},
        dataType:"json",
        success:function(data)
        {
            $("#show_users").html(data.users);
        },
        error:function()
        {
            alert("faild!!!!");
        }
    });
}
  $("#invite_user").submit(function(event)
  {
        event.preventDefault();
        //var formData=$("#invite_user").serialize();
        var email=$("#invite_in").val();
        if(validate_invitation_form())
        {
            $.ajax({
                url:"inviteUserToBoard.php",
                type:"POST",
                data:{email:email},
                dataType:"json",
                success:function(data)
                {
                    if(!data.isOnBoard && data.isRegistred)
                    {
                        fetch_users_onBoard();
                        alert("successfully invited");
                    }
                    else if(!data.isRegistred)
                    {
                        alert("this user not registered yet!!");
                    }
                    else
                    {
                        alert("this user already on board");
                    }
                },
                error:function()
                {
                    alert("faild");
                }
      });
        }
  });
    </script>
</body>

</html>