<?php
$con=mysqli_connect("localhost","root","","sms");
session_start();
include "Models.php";
$board_id=$_SESSION["board_id"];
$list_name=$_POST["list_name"];
$list=new BoardList($board_id,$list_name);
$query=$list->insert_List();
//$query="INSERT INTO list (name,board_id) values('$list_name',$board_id)";
try{
    mysqli_query($con,$query);
    header("location:user_schedular.php");
    //header to schedule page 
}
catch(exception $e)
{

}
mysqli_close($con);

?>