<?php
$con=mysqli_connect("localhost","root","","sms");
session_start();
include "Models.php";
$email=$_POST["email"];
$task_id=$_POST["task_id"];
$board_id=$_SESSION["board_id"];
$assign=new assigned();
$query_get_user_id="SELECT user_id FROM user WHERE email='$email'";
$result=mysqli_query($con,$query_get_user_id);
$isOnBoard=true;
$isRegistred=true;
if(mysqli_num_rows($result)>0)
{
    $user_id=mysqli_fetch_assoc($result);
    $id=$user_id["user_id"];
    $query_check="SELECT * FROM onboard WHERE user_id=$id and board_id=$board_id";
    $result_check_exist=mysqli_query($con,$query_check);
    if(mysqli_num_rows($result_check_exist)>0)
    {
        $query=$assign->assign_to_task($id,$task_id);
        //$query="INSERT INTO assigned (user_id,task_id) values ($id,$task_id)";
        try
        {
            //sucessed added to task
            mysqli_query($con,$query);
            //header("location:user_schedular.php");
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
        $isOnBoard=false;
        //header("location:user_schedular.php");
    }
}
else
{
    $isRegistred=false;
    header("location:user_schedular.php");
    //$_SESSION["not_exist"]=true;
    //header("location:user_schedular.php");
    //not registered on system
}
$result=array('isOnBoard'=>$isOnBoard , 'isRegistred'=>$isRegistred);
echo json_encode($result);
 

?>