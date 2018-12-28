<?php
$con=mysqli_connect("localhost","root","","sms");
$task_id=$_POST["task_id"];
$query="SELECT u.user_id,u.name,u.email FROM user u,task t,assigned a WHERE u.user_id=a.user_id and t.id_task=a.task_id and t.id_task=$task_id";
$result=mysqli_query($con,$query);
$output='';
while($row=mysqli_fetch_assoc($result))
{
    $output.='
    <div style="margin: 4px;border: 1.5px solid #0067A3;display:inline-block;">
    <span class="dropdown-item" style="font-size: 20px;">
        <a class="btn btn-success" style="color: rgb(255, 255, 255)" href="#">'.$row["name"].'</a>
        <div style="float: right;clear: right;">
            <span class="btn btn-outline-danger" style="border-radius:50px; " onclick="delete_user_from_task(\''.$task_id.'\',\''.$row["user_id"].'\')" aria-hidden="true">&times;</span>
        </div>
        <br>
        <span class="badge badge-light" style="font-size:12px; ">'.$row["email"].'</span>
    </span>
</div>
    ';
}
$data=array(
    'users'=>$output
);
echo json_encode($data);
mysqli_close($con);

?>