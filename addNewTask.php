<?php
$con=mysqli_connect("localhost","root","","sms");
$task_name=$_POST["task_name"];
$due_date=$_POST["due_date"];
$list_id=$_POST["list_id"];
$due_time=$_POST["due_time"];
include "Models.php";
$task=new Task($task_name,$due_date,$due_time,$list_id);
$query=$task->insert_Task();
try{
    mysqli_query($con,$query);
    header("location:user_schedular.php");
    //header to schedule page 
}
catch(exception $e)
{
    echo'faild add!!';   
}
mysqli_close($con);


?>