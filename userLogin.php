<?php
$con=mysqli_connect("localhost","root","","sms");
$email=$_POST["email"];
$pass=$_POST["pass"];
$query="SELECT * FROM user WHERE email='$email' AND password='$pass'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
    setcookie("Email",$email, time() + 86400, "/");
    setcookie("Password",$pass, time() + 86400, "/");
    header("location:userHome.php");
}
mysqli_close($con); 






?>
