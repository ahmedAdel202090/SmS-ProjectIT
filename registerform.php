<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/rig_style_override.css" />
</head>
<?php
    session_start();
    if(!empty($_SESSION))
    {
        if($_SESSION["status"])
        {
            echo "<script>
            alert('faild register');
            </script>";
        }
    }
?>
<body>
    <script src="JS/registration_validation.js"></script>

    <div class="container">
        <div class="row" style="margin-top:30px">
            <div class="col-6">
                <h1 class="sign_up">
                    Sign up
                </h1>
                <div class="mybox container-modified">

                    <form name="r_form" id="r_form" onsubmit="return validate_form()" method="post" action="registerAddUser.php">
                        <div class="container my_width ">
                            <br>
                            <div class="row">
                                <div class="col">

                                    <input id="fname" name="fname" type="text" class="form-control" id="exampleInputPassword1" placeholder="FIRST NAME">
                                </div>
                                <div class="col">

                                    <input id="lname" name="lname" type="text" class="form-control" id="exampleInputPassword1" placeholder="LAST NAME">
                                </div>
                            </div>

                            <br>

                            <input id="email" name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="E-MAIL ADDRESS">
                            <br>

                            <input type="password" id="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="PASSWORD">
                            <br>

                            <input type="password" id="con_password" name="con_password" class="form-control" id="exampleInputPassword1" placeholder="CONFIRM PASSWORD">

                            <br>
                            <input type="date" id="date" name="date" class="form-control">
                            <br>

                            <input type="radio" id="male" name="gender" value="Male">
                            <span class="gender_type">Male</span>
                            <br>
                            <input type="radio" id="female" name="gender" value="Female">
                            <span class="gender_type">Female</span>
    
                            <input type="submit" value="Next" class="btn btn-primary buttonsubmit" id="exampleInputPassword1">
                            <br>
                            <br>
                        </div>
                    </form>
                </div>
            </div>

            <div class="vl col-1"></div>
            <div class="col-5">                
                <h2 style="margin-top: 150px;color:rgba(216, 216, 216, 0.897)"><span class="sms_word"> SMS</span><br> organize you time Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</h2>
            </div>
        </div>
    </div>
</body>

</html>