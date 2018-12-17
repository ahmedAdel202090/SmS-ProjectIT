
    <?php
        $con=mysqli_connect("localhost","root","","sms");
        $name=$_POST["fname"]." ".$_POST["lname"];
        $email=$_POST["email"];
        $pass=$_POST["password"];
        $date=$_POST["date"];
        $gender=$_POST["gender"];
        $query="INSERT INTO user(name,email,birth_date,gender,password) VALUES ('$name','$email','$date','$gender','$pass') ";
        if(mysqli_query($con,$query))
        {
            header("location:index.html");
        }
        else
        {   
            session_start();
            $_SESSION["status"]=false;
            print_r($_SESSION);
            header("location:registerform.php");
        }
        

    ?>