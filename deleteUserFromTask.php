<?php
$con=mysqli_connect("localhost","root","","sms");
$user_id=$_POST["user_id"];
$task_id=$_POST["task_id"];
$query="DELETE FROM assigned WHERE user_id=$user_id and task_id=$task_id";
try{
    mysqli_query($con,$query);
    header("location:user_schedular.php");
}
catch(exception $e)
{

}




mysqli_close($con);

?>