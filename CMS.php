<?php
include "Models.php";
class AdminController 
{
    private $con;
    function __construct($con)
    {
        $this->con=$con;
    }
    function add_admin($admin)
    {
        $query=$admin->insert_admin();
        try{
            mysqli_query($con,$query);
        }
        catch(exception $e)
        {

        }
    }
    function isMaster($user_name)
    {
        $query="SELECT isAdmin FROM admin WHERE user_name='$user_name'";
        $result=mysqli_query($con,$query);
        $check=mysqli_fetch_assoc($result);
        return $check["isAdmin"];
    }
    function delete_admin($user_name)
    {
        $query="DELETE FROM admin WHERE user_name='$user_name'";
        try{
            mysqli_query($con,$query);
        }
        catch(exception $e)
        {
        }
    }
    function isUnique_user_name($user_name)
    {
        $query="SELECT * FROM admin WHERE user_name='$user_name'";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0)
        {
            return false;
        }
        return true;
    }
    function Update($admin,$user_name)
    {
        $query="UPDATE admin SET user_name='$admin->user_name' , password='$admin->password'";
        try{
            mysqli_query($con,$query);
        }
        catch(exception $e)
        {
        }
    }
}
class UserController
{
    private $con;
    function __construct($con)
    {
        $this->con=$con;
    }
    function delete_user($user_id)
    {
        $query="DELETE FROM user WHERE user_id='$user_id'";
        try{
            mysqli_query($con,$query);
        }
        catch(exception $e)
        {
        }

    }
    function isUnique_email($email)
    {
        $query="SELECT * FROM user WHERE email='$email'";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0)
        {
            return false;
        }
        return true;
    }
    function update_user($user,$user_id)
    {
        $query="UPDATE user SET name='$user->name' , email='$user->email' , password='$user->password' WHERE user_id=$user_id";
        try{
            mysqli_query($con,$query);
        }
        catch(exception $e)
        {
        }
    }
}
class BoardController
{
    private $con;
    function __construct($con)
    {
        $this->con=$con;
    }
    function delete_board($board_id)
    {
        $query="DELETE FROM board WHERE board_id=$board_id";
        try{
            mysqli_query($con,$query);
        }
        catch(exception $e)
        {
        }
    }  
    function get_avg_num_users()
    {
        $query="SELECT COUNT(*) as num_users FROM onboard GROUP BY board_id";
        $result=mysqli_query($con,$query);
        $sum=0;
        $cn=0;
        while($row=mysqli_fetch_assoc($result))
        {
            $sum+=$row["num_users"];
            $cn++;
        }
        if($sum==0)
        {
            return $sum;
        }
        return $sum/$cn;
    }
    function get_sum_users_onboard($board_id)
    {
        $query="SELECT COUNT(*) as num_users FROM onboard WHERE board_id=$board_id";
        $result=mysqli_query($con,$query);
        $cn=mysqli_fetch_assoc($result);
        return $cn["num_users"];
    }
    function num_boards()
    {
        $query="SELECT COUNT(*) as num FROM board";
        $result=mysqli_query($con,$query);
        $cn=mysqli_fetch_assoc($result);
        return $cn["num"];
    }
}






?>