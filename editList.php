<?php
$con=mysqli_connect("localhost","root","","sms");
$list_id=$_POST["list_id"];
$list_name=$_POST["list_name"];
$query="UPDATE list SET name='$list_name' WHERE id_list=$list_id";
try
{
    mysqli_query($con,$query);
    header("location:user_schedular.php");
}
catch(exception $e)
{

}

?>