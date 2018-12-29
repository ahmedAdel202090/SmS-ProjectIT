<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Log in page</title>

	<link rel="stylesheet" href="CSS/bootstrap-grid.min.css" />
	<link rel="stylesheet" href="CSS/bootstrap-reboot.min.css" />
	<link rel="stylesheet" href="CSS/bootstrap.min.css" />
	<link rel="stylesheet" href="CSS/all.min.css" />
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" href="css/login_style.css">


</head>
<?php
session_start();
if(isset($_SESSION["Email"]) && isset($_SESSION["Password"]))
{
  header("location:userHome.php");
}
if(!empty($_SESSION))
    {
        if($_SESSION["faild"])
        {
            echo "<script>
            alert('log in is faild this email or password not correct');
            </script>";
            session_destroy();
        }
    }
?>
<body>

	<div class="login-wrap" style="margin-top:105px; ">
		<div class="login-html">
			<h2 style="margin-left:100px;font-size: 50px;color:#fff;"  class="tab">Sign In</h2>
			<div class="login-form">
				<div class="sign-in-html">
					<form onsubmit="return validate_login_form()" method="POST" action="userLogin.php">
						<div class="group">
							<label for="user" class="label">E_mail</label>
							<input id="Email" name="email" type="email" class="input" placeholder="Enter your E-mail">
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

<script src="JS/login_form_validation.js"></script>

</body>

</html>