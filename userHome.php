<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Boards | SmS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="CSS/bootstrap-grid.min.css" />
  <link rel="stylesheet" href="CSS/bootstrap-reboot.min.css" />
  <link rel="stylesheet" href="CSS/bootstrap.min.css" />
  <link rel="stylesheet" href="CSS/all.min.css" />
  <link rel="stylesheet" href="CSS/userHome_style.css" />
</head>
<script src="JS/userScript.js"></script>
<body>
  <?php
      if(!isset($_COOKIE["Email"]) && !isset($_COOKIE["Password"]))
      {
        header("location:index.html");
      }
      if(isset($_GET['logOut']))
      {
        setcookie("Email", "", time()-86400, "/");
        setcookie("Password", "", time()-86400, "/");
        header("location:index.html");
      }
      $email=$_COOKIE["Email"];
      $pass=$_COOKIE["Password"];
      $con=mysqli_connect("localhost","root","","sms");
      $query="SELECT * FROM user WHERE email='$email' AND password='$pass'";
      $result=mysqli_query($con,$query);
      $user =mysqli_fetch_assoc($result);
      $user_id=$user["user_id"];
      //============================================
      $query="SELECT b.name,b.board_id from user u,board b,onBoard o where u.user_id=o.user_id and b.board_id=o.board_id";
      $boards=mysqli_query($con,$query);
  ?>
  <!--nav bar-->
  <section class="container-fluid" style="background-color: #0067A3">
    <div class="row">
      <!--Home-->
      <div class="col">
        <a href="#" class="btn btn-group-toggle" style="background-color: #3385B5;">
          <i class="fas fa-home fa-2x" style="color: white"></i>
        </a>
      </div>
      <!--==================================================-->
      <!--Brand-->
      <div class="col">
        <div style="width: 50px; margin: auto">
          <a href="#" class="navbar-brand" style="font-size: 1.7rem;color: white;font-family:fantasy">
            <i class="fas fa-table"></i>
            SmS
          </a>
        </div>
      </div>
      <!--==================================================-->
      <!--notification & user-->
      <div class="col">
        <div class="col-lg-2" style="float: right">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-user-circle fa-2x" style="color: white"></i>
          </a>
          <!--user menue-->
          <div class="dropdown-menu" id="user_menu" aria-labelledby="navbarDropdownMenuLink">
            <span class="dropdown-item" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-weight: bold;"><?php echo $user["name"] ?></span>
            <div class="dropdown-item"><p style="word-wrap: break-word;white-space: normal;width:60%"><?php echo $email ?></p></div>
            <form class="dropdown-item">
              <input type="hidden"  name="logOut" value="true"/>
              <input type="submit" class="btn btn-danger" value="Log Out"/>
            </form>
          </div>
          <!--==============================================-->
        </div>
        <div class="col-lg-2" style="float:right;margin-top:2px ">
          <a style="background-color: #CF513D;color: white;padding: 5px" class="nav-link dropdown-toggle btn btn-group-toggle" href="#"
            id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-bell fa-2x"></i>
            <!--notification numbers-->
            <span class="badge badge-light" style="background-color: rgb(11, 228, 11);border-radius:100px;color: white ">10</span>
            <!--notification numbers-->
          </a>
          <!--notification menu-->
          <div class="dropdown-menu" id="notifincation_menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Action</a>
          </div>
          <!--=================================================-->
        </div>
        <!--================================================-->
      </div>

    </div>
  </section>
  <!--===============================================================-->



  <!-- page content-->

  <div class="row" id="user_board" style="height: 100%;">
    <div class="col-3">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"
          aria-selected="true">
          <i class="fas fa-table"></i> Boards</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
          aria-selected="false">
          <i class="fas fa-bolt"></i> Home</a>
      </div>
    </div>
    <div class="col-9">
      <div class="tab-content" id="v-pills-tabContent">
        <!--Boards-->
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <!--Boards-->
          <!--Board-->
          <?php
              while($row=mysqli_fetch_assoc($boards))
              {
                $boardID=$row["board_id"];
                $board_name=$row["name"];
                echo '<div class="card" style="width: 18rem;display:inline-block;margin-left:5px;">
                <div class="card-body">
                  <form method="POST" action="deleteBoard.php"> 
                      <input type="hidden" name="board_id" value="'.$boardID.'" />
                      <input type="hidden" name="user_id" value="'.$user_id.'" />
                      <button type="submit" class="close" id="delete_board" style="position: relative;bottom:40px;right:-30px;color: white">
                            <span aria-hidden="true">&times;</span>
                      </button>
                  </form>
                  <form method="POST">
                     <h5 class="card-title"><a href="javascript:submitForm('.$boardID.')">'.$board_name.'</a></h5>
                  </form>
                </div>
              </div>';
              }
          ?>
          <!---->
          <!--add Board-->
          <a href="#" style="color: white" data-toggle="modal" data-target="#exampleModalCenter">
              <div class="card" id="add" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">create new Board...</h5>
                </div>
              </div>
          </a>
          <!--==========================-->
          <!-- Modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!--create new board-->
                <form method="POST" action="InsertBoard.php" class="form-group" id="form_add">
                  <div class="modal-body">
                    <input type="text" name="boardName" class="form-control" placeholder="Enter Board Name" />
                    <?php
                       echo '<input type="hidden" name="user_id" value="'.$user_id.'" />';
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Board</button>
                  </div>
                </form>
                <!--=========================================================-->
              </div>
            </div>
          </div>
          <!--==========================-->
        </div>
        <!--========================-->
        <!--Home-->
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          <div class="container">
            <!--POST-->
            <div class="row" style="margin-top: 5px;width: 50%; background-color: coral;border-radius:15px;color: white ">
                <div class="col-3" style="background-color: chartreuse;padding:20px;">
                    <i class="fas fa-clock fa-2x"></i>
                    <p>Time</p>
                </div>
                <div class="col-9" style="position: relative;top: 20px;">
                  <p style="font-weight: bold">Name</p>
                  <p >Action</p>
                </div>
            </div>
            <!--===================================-->
            
            
          </div>
        </div>
      </div>
        <!--========================-->
      </div>
    </div>
  </div>








  <script src="JS/jquery-3.3.1.min.js"></script>
  <script src="JS/bootstrap.bundle.min.js"></script>
  <script src="JS/bootstrap.min.js"></script>
  <script src="JS/all.min.js"></script>
</body>

</html>