<?php
include "CMS.php";
include "Models.php";
$con=mysqli_connect("localhost","root","","sms");
$user_controller=new UserController($con);
$user=new User($_POST["name"],$_POST["email"],null,null,$_POST["password"]);
$user->user_id=$_POST["user_id"];
if($user_controller->isUnique_email($user->email,$user->user_id))
{
    $user_controller->update_user($user,$user->user_id);
    header("location:adminPage.php");
}
else
{
    session_start();
    $_SESSION["invaild_mail"]=true;
    header("location:adminPage.php");
    //email existed before
}



mysqli_close($con);


?>