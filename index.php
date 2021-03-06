<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>sMs</title>
    <link rel="stylesheet" href="CSS/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/all.css" />
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel='stylesheet' href="CSS/index_styling.css">
    <!-- enter your extention css file here-->
</head>
<?php
session_start();
if(isset($_SESSION["Email"]) && isset($_SESSION["Password"]))
{
  header("location:userHome.php");
}
else
{
    session_destroy();
}
?>
<body>
    <div class="total_back">
        <div class="nav_bar_top" id="nav_bar_top1">
            <div class="container_me">
                <a class="btn btn-outline-dark" id="sms" href="#" style="display: inline-block;font-size: 1.8rem; padding: 0px 10px;border: 0;color: whitesmoke;">
                    <i class="fas fa-home"></i> sMs
                </a>
                <div class="floating_buttons">
                    <a class="btn btn-success" id="signup" href="registerform.php" style="color: white;">Sign Up</a>
                    <a class="btn btn-outline-primary" id="login" href="login_form.php" style="color: white;border-color: #fff;">Log In</a>
                </div>
            </div>
        </div>

        <div class="body_content">
            <div class="container_me">
                <div class="row">
                    <div class="col-6" style="width: 35%;font-size: 1.5rem;color: white;">
                        <h1 style="margin:50px 0 50px 0;font-size: 3rem;">sMs organizes your time.</h1>
                        <span>
                            It makes you hard tasks easier to achieve and it's also helps you with large 
                            projcts in the unversity if you were a student
                            and company if you were an employee
                        </span>
                        <br>
                        <a class="btn btn btn-success" href="registerform.php" style="margin-top: 50px;font-size: 2rem;">Start Now For FREE</a>
                    </div>
                    <div class="col-6" style="width: 49%;">
                        <img src="images/10.png" style="width: 100%;height: 100%;">
                    </div>
                </div>
                <div style="background-color:#ffffff;width: auto;height:250px;margin-bottom:20px ; padding: 20px;border-radius: 40px;" class="row">
                    <div style="float: left; width: 33%;">
                        <i class="fab fa-creative-commons-nc font_graps"></i>
                        <div class="small_div" style="color:#0071ce;">
                            <h3>Our service is FREE</h3>
                            <p>
                             sms organizes your time and manages your time in the most effecient for no money so you can get your tasks done within no time and with no money.
                            </p>
                        </div>
                    </div>
                    <div style="float: left; width: 33%;">

                        <div class="vl"></div>
                        <i class="fas fa-stopwatch font_graps"></i>
                        <div class="small_div" style="color:#0071ce;">
                            <h3>All what we care about is your time</h3>
                            <p>
                                    sms organizes your time and manages your time in the most effecient way so you can achieve big hard tasks in an ordered way.</p>
                        </div>

                    </div>

                    <div style="float: left; width: 33%;">

                        <div class="vl"></div>
                        <i class="fas fa-user-tie font_graps"></i>
                        <div class="small_div" style="color:#0071ce;">
                            <h3>we are glad to help any kind of formal persons</h3>
                            <p> 
                                sms is a great tool that every one working on a large projects can get benefit of so what are you waiting for come on sign up.</p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>



    <script src="JS/jquery-3.3.1.min.js"></script>
    <script src="JS/bootstrap.bundle.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $(window).scroll(function () { // check if scroll event happened
                if ($(document).scrollTop() > 50) { // check if user scrolled more than 50 from top of the browser window
                    $("#nav_bar_top1").css({ "background-color": " #ffffff" });// if yes, then change the color of class "navbar-fixed-top" to white (#f8f8f8)
                    $("#nav_bar_top1").css({ "transition": "500ms ease" });
                    $("#sms").css({ "transition": "500ms ease" });
                    $("#sms").css({ "color": "rgb(46,57,191)" });
                    $("#login").css({ "transition": "500ms ease" });
                    $("#login").css({ "color": "#000" });
                    $("#login").css({ "border-color": "#000" });

                } else {
                    $("#nav_bar_top1").css({ "background-color": "transparent" }); // if not, change it back to transparent
                    $("#sms").css({ "transition": "500ms ease" });
                    $("#sms").css({ "color": "#fff" });
                    $("#login").css({ "transition": "500ms ease" });
                    $("#login").css({ "color": "#fff" });
                    $("#login").css({ "border-color": "#fff" });
                }
            });
        });
    </script>

    <!-- enter your extention js file here-->
</body>

</html>