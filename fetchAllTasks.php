<?php
session_start();
$con=mysqli_connect("localhost","root","","sms");
$board_id=$_SESSION["board_id"];
$query="SELECT * FROM list WHERE board_id=$board_id";
$lists=mysqli_query($con,$query);
$output='';
while($row=mysqli_fetch_assoc($lists))
        {
            $list_id=$row["id_list"];
            $name=$row["name"];
            $query="SELECT * FROM task WHERE list_id=$list_id";
            $tasks=mysqli_query($con,$query);
            $output.= '<div class="outer_div" id="list'.$list_id.'">';
            //list
            $output.= '<div>
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
                $output.='<div class="inner_div" id="task'.$rowTask["id_task"].'">
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
                $output.='
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
                        $output.='
                    <form class="edit_members" name="edit_members_form'.$task_id.'" id="edit_members_form'.$task_id.'" onsubmit="return validate_add_new_member_form()" action="addUserToTask.php" method="POST">
                        <div style="margin-left:15px;">
                            <h5>Task members:</h5>';
                        $output.= '<div id="T'.$task_id.'">';
                        $query="SELECT u.user_id,u.name,u.email FROM user u,task t,assigned a WHERE u.user_id=a.user_id and t.id_task=a.task_id and t.id_task=$task_id";
                        $users_assigned=mysqli_query($con,$query);
                        while($rowUser=mysqli_fetch_assoc($users_assigned))
                        {
                            $output.= '
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
                        $output.='</div>';
                        $output.='
                                <input type="hidden" name="task_id" value="'.$task_id.'"/>
                                <input name="email" id="add_member'.$task_id.'" style="width: 500px; margin: 10px;border: 1.5px solid rgb(53, 147, 201);display: none;"
                                type="email" placeholder="enter the e-mail of the member to be added" class="form-control"/>
                        </div>
                    </form>
                        ';
                    
                            
                    $output.='
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
            $output.='<div class="inner_div add" id="modal_add" style="text-align: center;"  data-toggle="modal" data-target="#exampleModal2" onclick="add_task('.$list_id.')">
            <h2 class="badge badge-light"  style="font-size: 1.3rem;text-align: center; margin: 0px;padding: 1.3rem;">
                <i class="fas fa-plus"></i>
                Add new task
            </h2>
        </div>';
        $output.='</div>';

        }
        $output.='<div class="outer_div">
        <div class="inner_div add" style="text-align: center;" data-toggle="modal" data-target="#exampleModal3">
            <h2 class="badge badge-light" style="font-size: 1.6rem;text-align: center;margin: 0px;padding: 1.3rem;">
                <i class="fas fa-plus"></i>
                Add new list
            </h2>
        </div>
</div>';
mysqli_close($con);
$data=array('lists'=>$output);
echo json_encode($data);




?>