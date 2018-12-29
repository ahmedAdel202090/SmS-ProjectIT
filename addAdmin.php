<?php
include "CMS.php";
include "Models.php";
$con=mysqli_connect("localhost","root","","sms");
$admin=new Admin($_POST["name"],$_POST["password"],false);
$admin_control=new AdminController($con);
if($admin_control->isUnique_user_name_insert($admin->user_name))
{
    $admin_control->add_admin($admin);
}
else
{
    session_start();
    $_SESSION["invaild_mail"]=true;
}
header("location:adminPage.php");
mysqli_close($con);



?>