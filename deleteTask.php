<?php
$task_id=$_POST["task_id"];
$con=mysqli_connect("localhost","root","","sms");
$query="DELETE FROM task WHERE id_task=$task_id";
try
{
    mysqli_query($con,$query);
    header("location:user_schedular.php");
}
catch(exception $e)
{

}
mysqli_close($con);
?>