<?php
session_start();
$con=mysqli_connect("localhost","root","","sms");
$board_id=$_SESSION["board_id"];;
$new_name=$_POST["name"];
$query="UPDATE board SET name='$new_name' WHERE board_id=$board_id";
try
{
    mysqli_query($con,$query);
    header("location:user_schedular.php");
}
catch(exception $e)
{

}


?>