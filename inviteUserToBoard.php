<?php
$con=mysqli_connect("localhost","root","","sms");
$email=$_POST["email"];
$board_id=$_POST["board_id"];
$query="SELECT * FROM user WHERE email=$email";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);
if(mysqli_num_rows($result)>0)
{
    $id=$row["user_id"];
    $invite_query="INSERT INTO onboard (board_id,user_id) values ($board_id,$id)";
    try
    {
        mysqli_query($con,$invite_query);
        //header() return the page you are need;
    }
    catch
    {
        
    }
}
else
{
    //user does not exist
}
mysql_close($con); 



?>