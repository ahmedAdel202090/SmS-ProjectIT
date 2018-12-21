<?php
$con=mysqli_connect("localhost","root","","sms");
$board_id=$_POST["board_id"];
$list_name=$_POST["list_name"];
$query="INSERT INTO list (name,board_id) values('$list_name',$board_id)";
try{
    mysqli_query($con,$query);
    //header to schedule page 
}
catch
{

}
mysql_close($con);

?>