
    <?php
        $con=mysqli_connect("localhost","root","","sms");
        $name=$_POST["fname"]." ".$_POST["lname"];
        $email=$_POST["email"];
        $pass=$_POST["password"];
        $date=$_POST["date"];
        $gender=$_POST["gender"];
        include "Models.php";
        $query_check="SELECT * FROM user WHERE email='$email'";
        $result=mysqli_query($con,$query_check);
        if(mysqli_num_rows($result)>0)
        {
            session_start();
            $_SESSION["faild"]=true;
            print_r($_SESSION);
            header("location:registerform.php");   
        }
        else
        {
            $user=new User($name,$email,$date,$gender,$pass);
            $query=$user->register_user();
            if(mysqli_query($con,$query))
            {
                header("location:index.php");
            }
            else
            {   
                session_start();
                $_SESSION["faild"]=true;
                header("location:registerform.php");
            }
        }
        mysql_close($con); 
        

    ?>