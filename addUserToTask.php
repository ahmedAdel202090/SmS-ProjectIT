<?php
$con=mysqli_connect("localhost","root","","sms");
session_start();
$email=$_POST["email"];
$task_id=$_POST["task_id"];
$board_id=$_SESSION["board_id"];
$query_get_user_id="SELECT user_id FROM user WHERE email='$email'";
$result=mysqli_query($con,$query_get_user_id);
if(mysqli_num_rows($result)>0)
{
    $user_id=mysqli_fetch_assoc($result);
    $id=$user_id["user_id"];
    echo $id;
    $query_check="SELECT * FROM onboard WHERE user_id=$id and board_id=$board_id";
    $result_check_exist=mysqli_query($con,$query_check);
    if(mysqli_num_rows($result_check_exist)>0)
    {
        $query="INSERT INTO assigned (user_id,task_id) values ($id,$task_id)";
        try
        {
            //sucessed added to task
            mysqli_query($con,$query);
            header("location:user_schedular.php");
        }
        catch(exception $e)
        {

        }
    }
    else
    {
        /*$_SESSION["not_exist"]=true;
        header("location:user_schedular.php");*/
        //not existed on board
    }
}
else
{
    echo "not existed";
    //$_SESSION["not_exist"]=true;
    //header("location:user_schedular.php");
    //not registered on system
}
mysqli_close($con);
 

?>