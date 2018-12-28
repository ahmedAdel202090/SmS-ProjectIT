<?php
$con=mysqli_connect("localhost","root","","sms");
session_start();
$board_id=$_SESSION["board_id"];
$user_id=$_POST["user_id"];
$query="DELETE FROM onboard WHERE user_id=$user_id and board_id=$board_id";
try
{
    mysqli_query($con,$query);
    $query="DELETE FROM assigned WHERE user_id=$user_id";
    mysqli_query($con,$query);
    mysqli_close($con); 
    header("location:user_schedular.php");
}
catch(exception $e)
{
}


?>