<?php
include "CMS.php";
include "Models.php";
session_start();
$con=mysqli_connect("localhost","root","","sms");
$user_name=$_POST["user_name"];
$admin_controll=new AdminController($con);
$admin_controll->delete_admin($user_name);
header("location:adminPage.php");
mysqli_close($con);


?>