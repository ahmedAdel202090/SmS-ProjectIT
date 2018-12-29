<?php
$con=mysqli_connect("localhost","root","","sms");
$board_id=$_POST["board_id"];
if(isset($_POST["master"]))
{
    echo $board_id;
    $query_del_board="DELETE FROM board WHERE board_id=$board_id";
    mysqli_query($con,$query_del_board);
    header("location:adminPage.php");
    exit();
}
$user_id=$_POST["user_id"];
$query_check_admin="SELECT * FROM board WHERE board_id=$board_id and admin=$user_id";
$result=mysqli_query($con,$query_check_admin);
if(mysqli_num_rows($result)>0)
{
    $query_del_board="DELETE FROM board WHERE board_id=$board_id";
    mysqli_query($con,$query_del_board);
}
else
{
    $query_del_onBoard="DELETE FROM onboard WHERE board_id=$board_id and user_id=$user_id";
    mysqli_query($con,$query_del_onBoard);
}
header("location:userHome.php");
mysqli_close($con);

?>
