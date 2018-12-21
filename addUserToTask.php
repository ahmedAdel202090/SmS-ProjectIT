<?php
$con=mysqli_connect("localhost","root","","sms");
$user_id=$_POST["user_id"];
$task_id=$_POST["task_id"];
$query="INSERT INTO assigned (user_id,task_id) values ($user_id,$task_id)";
try
{
    mysqli_query($con,$invite_query);
    //header() return the page you are need;
}
catch
{
        
}

mysql_close($con); 
?>