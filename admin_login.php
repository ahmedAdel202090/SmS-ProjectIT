<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CMS Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/bootstrap-grid.min.css" />
	<link rel="stylesheet" href="CSS/bootstrap-reboot.min.css" />
	<link rel="stylesheet" href="CSS/bootstrap.min.css" />
	<link rel="stylesheet" href="CSS/all.min.css" />
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" type="text/css" media="screen" href="./CSS/admin_styling.css" />
</head>
<?php
session_start();
if(isset($_SESSION["user_name"]) && isset($_SESSION["password"]))
{
  header("location:adminPage.php");
}
if(!empty($_SESSION))
    {
        if($_SESSION["faild"])
        {
            echo "<script>
            alert('log in is faild this user name or password not correct');
            </script>";
            session_destroy();
        }
    }
?>
<body>
    <div class="login-wrap" style="margin-top:105px; ">
        <div class="login-html">
            <h2 style="margin-left:100px;font-size: 50px;color:#fff;" class="tab">Sign In</h2>
            <div class="login-form">
                <div class="sign-in-html">
                    <form onsubmit="return validate_admin_form()" method="POST" action="adminLogin.php">
                        <div class="group">
                            <label for="user" class="label">Username</label>
                            <input id="user_name" name="user_name" type="text" class="input" placeholder="Enter your username">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="password" type="password" name="pass" class="input" data-type="password" placeholder="Enter your password">
                        </div>
                        <div class="group">
                            <button type="submit" class="btn button" name="submit">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/admin_validation.js"></script>
</body>

</html>