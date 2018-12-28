<?php
$con=mysqli_connect("localhost","root","","sms");
$task_id=$_POST["task_id"];
$list_name=$_POST["list_name"];
$query="SELECT * FROM task WHERE id_task=$task_id";
$result=mysqli_query($con,$query);
$rowTask=mysqli_fetch_assoc($result);
$date=date_create($rowTask["due_date"]);
$output='
<input type="hidden" name="task_id" value="'.$task_id.'" />
<div class="modal-header">
    <div class="col" id="original_task_title'.$task_id.'">
        <h3 class="modal-title" style="color: rgb(0, 57, 212)" id="task_title'.$task_id.'">'.$rowTask["name"].'</h3>
        <span>
            <span>in list</span>
            <a href="#" id="in_list">'.$list_name.'</a>
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
        <span id="date_time'.$task_id.'" class="badge badge-success">'.date_format($date,"d F").' At '.date('h:i A', strtotime($rowTask["due_time"])).'</span>
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

$data=array('task_data'=>$output, 'name'=>$rowTask["name"] , 'due_date'=>$rowTask["due_date"]);
echo json_encode($data);

?>