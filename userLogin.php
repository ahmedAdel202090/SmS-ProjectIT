<?php
$con=mysqli_connect("localhost","root","","sms");
$email=$_POST["email"];
$pass=$_POST["pass"];
$query="SELECT * FROM user WHERE email='$email' AND password='$pass'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
    session_start();
    $_SESSION["Email"]=$email;
    $_SESSION["Password"]=$pass;
    header("location:userHome.php");
}
else{
    session_start();
    $_SESSION["faild"]=true;
    header("location:login_form.php");
}
mysql_close($con); 






?>
