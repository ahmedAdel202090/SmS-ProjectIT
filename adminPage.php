<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Content Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/all.min.css" />
    <link rel="stylesheet" href="CSS/admin_pageStyle.css" />
</head>
<?php
session_start();
if(!isset($_SESSION["user_name"]) && !isset($_SESSION["password"]))
{
  header("location:admin_login.php");
}
if(isset($_SESSION["invaild_mail"]))
{
  if($_SESSION["invaild_mail"])
  {
    $_SESSION["invaild_mail"]=false;
    echo "<script>
            alert('edit faild this email is registered before');
            </script>";
  }
}
if(isset($_GET['logOut'])){
  session_destroy();
  header("loaction:admin_login.php");
}
include "Models.php";
include "CMS.php";
$con=mysqli_connect("localhost","root","","sms");
$admin_control=new AdminController($con);
$board_control=new BoardController($con);
$user_name=$_SESSION["user_name"];
$isAdmin=$admin_control->isMaster($user_name);
//============users=======
$query="SELECT * FROM user";
$users=mysqli_query($con,$query);
//==========admins=======
$query="SELECT * FROM admin";
$admins=mysqli_query($con,$query);
//==========boards=======
$query="SELECT b.board_id,b.name,u.email,COUNT(u.user_id) as num FROM board b,user u WHERE u.user_id=b.admin GROUP BY b.board_id ";
$boards=mysqli_query($con,$query);
?>
<body>
    <div class="row">
        <div class="col-3 list-menue">
          <div class="flex-column title">SMS<br/>Management System</div>  
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Users</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Boards</a>
            <?php
              if($isAdmin)
              {
                echo '<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Admins</a>';
              }
            ?>
          </div>
          <form>
              <input type="hidden"  name="logOut" value="true"/>
              <button type="submit" class="btn btn-secondary btn-lg btn-danger" style="margin-left: 10px;margin-top: 10px;">logout</button>
          </form>
        </div>
        <div class="col-9">
          <div class="tab-content" id="v-pills-tabContent">
              <!--user section-->
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Birth Date</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                              </tr>
                            </thead>
                            <!--user table-->
                            <tbody>
                              <?php
                                $cn=1;
                                while($row=mysqli_fetch_assoc($users))
                                {
                                  $user_id=$row["user_id"];
                                  echo'
                                  <tr>
                                  <th scope="row">'.$cn.'</th>
                                  <td>'.$row["name"].'</td>
                                  <td>'.$row["email"].'</td>
                                  <td>'.$row["password"].'</td>
                                  <td>'.$row["birth_date"].'</td>
                                  <td>'.$row["gender"].'</td>
                                  <td style="color: green"><i data-toggle="modal" data-target="#edit-user'.$user_id.'" class="fas fa-user-edit fa-2x" style="cursor: pointer;"></i></td>
                                  <td>
                                    <form method="POST" action="deleteUser.php">
                                      <input type="hidden" name="user_id" value="'.$user_id.'" />
                                      <button type="submit"  style="color: crimson;" class="btn btn-group btn-light"><i class="fas fa-trash-alt fa-2x"></i></button>
                                    </form>
                                  </td>
                                </tr>
                                  <!--update Modal-->
                              <div class="modal fade" id="edit-user'.$user_id.'" tabindex="-1" role="dialog" aria-labelledby="edit-formTitle" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="edit-formTitle">Edit User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <!--edit form-->
                                          <form id="edit_user'.$user_id.'" onsubmit="return validate_user_form('.$user_id.')"  method="POST" action="editUser.php">
                                              <div class="modal-body">
                                                      <div class="form-group">
                                                              <input type="hidden" name="user_id" value="'.$user_id.'" />
                                                              <label for="user_name">Name</label>
                                                              <input type="text" class="form-control" id="user_name'.$user_id.'" name="name" value="'.$row["name"].'" placeholder="Enter Name">
                                                      </div>
                                                      <div class="form-group">
                                                              <label for="user_email">Email address</label>
                                                              <input type="email" class="form-control" id="user_email'.$user_id.'" name="email" value="'.$row["email"].'" aria-describedby="emailHelp" placeholder="Enter email">
                                                      </div>
                                                      <div class="form-group">
                                                              <label for="user_pass">Password</label>
                                                              <input type="password" class="form-control" id="user_pass'.$user_id.'" name="password" value="'.$row["password"].'"  placeholder="Enter password">
                                                      </div>
                                              </div>
                                          </form>
                                          <!--==============================-->
  
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button form="edit_user'.$user_id.'" type="submit" class="btn btn-primary">Save changes</button>
                                          </div>
                                        </div>
                                      </div>
                              </div>
                              <!--=========================-->
   
                                  ';
                                  $cn++;
                                }
                              ?>
                            </tbody>
                    </table>
            </div>


            <!--boards section-->
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <!--statistics-->
                <div class="container">
                    <div class="row col-7" style="margin:auto; margin-top: 10px;">
                        <div class="col num-boards">
                            Board Numbers
                            <p class="num"><?php echo $board_control->num_boards(); ?></p>
                        </div>
                        <div class="col avg-users">
                            average users in each board
                            <p class="num"><?php echo $board_control->get_avg_num_users(); ?></p>
                        </div>
                    </div>
                </div>

                <!--boards-->
                <table class="table" style="margin-top:20px; ">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Admin Email</th>
                            <th scope="col"># of users</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <!--board table-->
                        <tbody>
                          <?php
                              $cn=1;
                              while($row=mysqli_fetch_assoc($boards))
                              {
                                echo '
                                <tr>
                                  <th scope="row">'.$cn.'</th>
                                <td>'.$row["name"].'</td>
                                <td>'.$row["email"].'</td>
                                <td>'.$row["num"].'</td>
                                <td>
                                  <form method="POST" action="deleteBoard.php">
                                    <input type="hidden" name="master" value="true" />
                                    <input type="hidden" name="board_id" value="'.$row["board_id"].'" />
                                    <button type="submit"  style="color: crimson;" class="btn btn-group btn-light"><i class="fas fa-trash-alt fa-2x"></i></button>
                                  </form>
                                </td>
                              </tr>        
                                ';
                                $cn++;
                              }
                          ?>
                        </tbody>
                        <!--=========================-->
                </table>
                <!--===================================-->
            </div>


            <!--admins-->
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <!--admins section-->    
                <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Password</th>
                                <th scope="col">Is Master</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                              </tr>
                            </thead>
                            <!--admin table-->
                            <tbody>
                              <?php
                              $cn=1;
                                while($row=mysqli_fetch_assoc($admins))
                                {
                                  echo '
                                  <tr>
                                  <th scope="row">'.$cn.'</th>
                                  <td>'.$row["user_name"].'</td>
                                  <td>'.$row["password"].'</td>';
                                  if($row["isAdmin"])
                                  {
                                    echo '<td style="color: rgb(125, 209, 0)"><i class="fas fa-check-circle fa-2x"></i></td>
                                    <td style="color: green;cursor: pointer;"><i class="fas fa-user-edit fa-2x" data-toggle="modal" data-target="#edit-admin'.$cn.'" ></i></td>
                                    <td>-</td>';
                                  }
                                  else
                                  {
                                    echo'<td>-</td>
                                    <td style="color: green;cursor: pointer;"><i class="fas fa-user-edit fa-2x" data-toggle="modal" data-target="#edit-admin'.$cn.'" ></i></td>
                                    <td>
                                    <form method="POST" action="deleteAdmin.php">
                                    <input type="hidden" name="user_name" value="'.$row["user_name"].'" />
                                    <button type="submit"  style="color: crimson;" class="btn btn-group btn-light"><i class="fas fa-trash-alt fa-2x"></i></button>
                                </form>
                                      </td>';  
                                  }
                                  echo '
                                </tr>
                                <!--update Modal-->
                              <div class="modal fade" id="edit-admin'.$cn.'" tabindex="-1" role="dialog" aria-labelledby="edit-formTitle" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="edit-formTitle">Edit Admin</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <!--edit form-->
                                          <form id="edit_admin'.$cn.'" onsubmit="return validate_admin_edit_form('.$cn.')" method="POST" action="editAdmin.php">
                                              <div class="modal-body">
                                                      <div class="form-group">
                                                              <input type="hidden" name="user_name" value="'.$row["user_name"].'" />
                                                              <label for="admin_name">User Name</label>
                                                              <input type="text" class="form-control" id="admin_name'.$cn.'" name="name" value="'.$row["user_name"].'" placeholder="Enter User Name">
                                                      </div>
                                                      <div class="form-group">
                                                              <label for="admin_pass">Password</label>
                                                              <input type="password" class="form-control" id="admin_pass'.$cn.'" name="password" value="'.$row["password"].'"  placeholder="Enter password">
                                                      </div>
                                              </div>
                                          </form>
                                          <!--==============================-->
  
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button form="edit_admin'.$cn.'" type="submit" class="btn btn-primary">Save changes</button>
                                          </div>
                                        </div>
                                      </div>
                              </div>
                              <!--=========================-->
                                  ';
                                  $cn++;
                                }
                              ?>
                            </tbody>
                            <!--=========================-->
                    </table>
                    <!--add admin button-->
                    <button data-toggle="modal" data-target="#add-admin" style="margin: 60px;margin-left: 110px; background-color:rgb(190, 14, 14) " type="button" class="btn btn-secondary btn-lg">Add Admin</button>
                    <!--add admin modal-->
                    <div class="modal fade" id="add-admin" tabindex="-1" role="dialog" aria-labelledby="edit-formTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="edit-formTitle">Add Admin</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <!--add form-->
                                <form id="add_admin" method="POST" onsubmit="return validate_add_form()" action="addAdmin.php">
                                    <div class="modal-body">
                                            <div class="form-group">
                                                    <label for="admin_name">User Name</label>
                                                    <input type="text" class="form-control" id="admin_name" name="name" placeholder="Enter User Name">
                                            </div>
                                            <div class="form-group">
                                                    <label for="admin_pass">Password</label>
                                                    <input type="password" class="form-control" id="admin_pass" name="password"  placeholder="Enter password">
                                            </div>
                                    </div>
                                </form>
                                <!--==============================-->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button form="add_admin" type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                            </div>
                    </div>
                    <!--=========================-->

            </div>
          </div>
        </div>
      </div>



    <script src="JS/jquery-3.3.1.min.js"></script>
    <script src="JS/bootstrap.bundle.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/all.min.js"></script>
    <script src="JS/adminPage.js"></script>
</body>
</html>