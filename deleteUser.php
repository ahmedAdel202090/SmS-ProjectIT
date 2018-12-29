<?php
include "CMS.php";
include "Models.php";
$con=mysqli_connect("localhost","root","","sms");
$user_id=$_POST["user_id"];
$user_control=new UserController($con);
$user_control->delete_user($user_id);
header("location:adminPage.php");
mysqli_close($con);


?>