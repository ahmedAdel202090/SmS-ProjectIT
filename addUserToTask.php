<?php
$con=mysqli_connect("localhost","root","","sms");
$email=$_POST["email"];
$task_id=$_POST["task_id"];
$board_id=$_POST["board_id"];
$query_get_user_id="SELECT user_id FROM user WHERE email=$email";
$result=mysqli_query($con,$query_get_user_id);
if(mysqli_num_rows($result)>0)
{
    $user_id=mysqli_fetch_assoc($result);
    $query_check="SELECT * FROM onboard WHERE user_id=$user_id and board_id=$board_id";
    $result_check_exist=mysqli_query($query_check);
    if(mysqli_num_rows($result_check_exist)>0)
    {
        $query="INSERT INTO assigned (user_id,task_id) values ($user_id,$task_id)";
        try
        {
            //sucessed added to task
            mysqli_query($con,$query);
        }
        catch
        {

        }
    }
    else
    {
        //not existed on board
    }
}
else
{
    //not registered on system
}
mysql_close($con);
 

?>