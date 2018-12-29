<?php
include "CMS.php";
include "Models.php";
$con=mysqli_connect("localhost","root","","sms");
$admin=new Admin($_POST["name"],$_POST["password"],null);
$user_name=$_POST["user_name"];
$admin_control=new AdminController($con);
session_start();
$my_user_name=$_SESSION["user_name"];
if($admin_control->isUnique_user_name($admin->user_name))
{
    $admin_control->Update($admin,$user_name);
}
else
{
    $_SESSION["invaild_mail"]=true;
    header("location:adminPage.php");
}
if($my_user_name==$user_name)
{
    session_destroy();
    header("location:admin_login.php");
}
header("location:adminPage.php");
mysqli_close($con);





?>