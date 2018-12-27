<?php
$name=$_POST["boardName"];
$user_id=$_POST["user_id"];
include "Models.php";
$con=mysqli_connect("localhost","root","","sms");
$board=new Board($name,$user_id);
$query_insert=$board->insert_board();
//$query_insert="INSERT INTO board(name,admin) values ('$name',$user_id)";
if(mysqli_query($con,$query_insert))
{
    $query_select="SELECT LAST_INSERT_ID() as board_id FROM board";
    $select_result=mysqli_query($con,$query_select);
    $fecth_select=mysqli_fetch_assoc($select_result);
    $board_id=intval($fecth_select["board_id"]);
    $query_add="INSERT INTO onboard(board_id,user_id) values($board_id,$user_id)";
    if(mysqli_query($con,$query_add))
    {
        header("location:userHome.php");
        mysqli_close($con);
    }
}



?>