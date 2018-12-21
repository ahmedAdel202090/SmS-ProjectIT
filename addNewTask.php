<?php
$con=mysqli_connect("localhost","root","","sms");
$task_name=$_POST["task_name"];
$due_date=$_POST["due_date"];
$list_id=$_POST["list_id"];
$query="INSERT INTO task(name,due_date,list_id) values ('$task_name',$due_date,$list_id)";
try{
    mysqli_query($con,$query);
    //header to schedule page 
}
catch
{
    
}
mysql_close($con);


?>