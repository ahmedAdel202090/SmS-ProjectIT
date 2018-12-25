<?php
$list_id=$_POST["list_id"];
$con=mysqli_connect("localhost","root","","sms");
$query="DELETE FROM list WHERE id_list=$list_id";
try
{
    mysqli_query($con,$query);
    header("location:user_schedular.php");
}
catch(exception $e)
{

}
mysqli_close($con);
?>