<?php
class User
{
    public $user_id,$name,$email,$birth_date,$gender,$password;
    function __construct($name,$email,$birth_date,$gender,$password)
    {
        $this->name=$name;
        $this->email=$email;
        $this->birth_date=$birth_date;
        $this->gender=$gender;
        $this->password=$password;
    }
    function register_user()
    {
        return "INSERT INTO user(name,email,birth_date,gender,password) VALUES ('$this->name','$this->email','$this->birth_date','$this->gender','$this->password') ";
    }
}
class Assigned
{
    function assign_to_task($user_id,$task_id)
    {
        return "INSERT INTO assigned (user_id,task_id) values ($user_id,$task_id)";
    }
}
class OnBoard
{
    function add_user_to_board($user_id,$board_id)
    {
        return "INSERT INTO onboard(board_id,user_id) values($board_id,$user_id)";
    }
}
class Admin
{
    public $user_name,$password,$isAdmin;
    function __construct($user_name,$password,$isAdmin)
    {
        $this->user_name=$user_name;
        $this->password=$password;
        $this->isAdmin=$isAdmin;
    }
    function insert_admin()
    {
        return "INSERT INTO admin(user_name,password,isAdmin) values('$this->user_name','$this->password',false)";
    }
}
class Board
{
    public $board_id,$name,$admin;
    function __construct($name,$admin)
    {
        $this->name=$name;
        $this->admin=$admin;
    }
    function insert_board()
    {
        return "INSERT INTO board(name,admin) values ('$this->name',$this->admin)";
    }
}
class Task
{
    public $id_task,$name,$description,$due_date,$due_time,$list_id;
    function __construct($name,$due_date,$due_time,$list_id)
    {
        $this->name=$name;
        $this->due_date=$due_date;
        $this->due_time=$due_time;
        $this->list_id=$list_id;
    }
    function insert_Task()
    {
        return "INSERT INTO task(name,due_date,due_time,list_id) values ('$this->name','$this->due_date','$this->due_time',$this->list_id)";
    }
}
class BoardList
{
    public $id_list,$name,$board_id;
    function __construct($board_id,$name)
    {
        $this->name=$name;
        $this->board_id=$board_id;
    }
    function insert_List()
    {
        return "INSERT INTO list (name,board_id) values('$this->name',$this->board_id)";
    }
}

?>