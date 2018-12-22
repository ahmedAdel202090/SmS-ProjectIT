<?php
session_start();
$con=mysqli_connect("localhost","root","","sms");
$email=$_POST["email"];
$board_id=$_SESSION["board_id"];
$query="SELECT * FROM user WHERE email='$email'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
    $id=intval($row["user_id"]);
    $query_check_exist="SELECT * FROM onboard  WHERE  user_id=$id and board_id=$board_id";
    $result=mysqli_query($con,$query_check_exist);
    if(mysqli_num_rows($result)>0)
    {
        session_start();
        $_SESSION["exist_on_board"]=true;
        header("location:user_schedular.php");
    }
    else
    {
        $invite_query="INSERT INTO onboard(board_id,user_id) values($board_id,$id)";
        try
        {
            mysqli_query($con,$invite_query);
            header("location:user_schedular.php");
        }
        catch(exception $e)
        {
        
        }
    }
}
else
{
    //user does not exist
    session_start();
    $_SESSION["not_exist"]=true;
    header("location:user_schedular.php");
} 



?>