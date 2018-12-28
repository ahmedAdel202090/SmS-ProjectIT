<?php
$con=mysqli_connect("localhost","root","","sms");
$task_id=$_POST["task_id"];
$task_name=$_POST["task_name"];
$description=$_POST["edit_paragraph"];
$due_date=$_POST["due_date"];
$due_time=$_POST["due_time"];
$query="UPDATE task SET name='$task_name',description= '$description',due_date='$due_date',due_time='$due_time' WHERE id_task=$task_id";
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