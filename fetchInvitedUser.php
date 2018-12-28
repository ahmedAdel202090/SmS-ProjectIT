<?php
session_start();
$con=mysqli_connect("localhost","root","","sms");
$board_id=$_SESSION["board_id"];
$user_id=$_POST["user_id"];
$output='';
$query="SELECT u.name,u.email,u.user_id,b.admin FROM board b,onboard o,user u WHERE b.board_id=o.board_id and u.user_id=o.user_id and o.board_id=$board_id";
                                 $users_on_board=mysqli_query($con,$query);
                            
                                 while($row=mysqli_fetch_assoc($users_on_board))
                                 {
                
                                     if($user_id!=$row["user_id"])
                                     {
                                         if($row["user_id"]==$row["admin"])
                                         {
                                            $output.= '<div style="margin: 4px;border: 1.5px solid #0067A3;">
                                            <span class="dropdown-item" style="font-size: 20px;">
                                                <a class="btn btn-dark" style="color: rgb(255, 255, 255)" href="#">'.$row["name"].'</a>
                                                <br>
                                                <span class="badge badge-light" style="font-size:12px; ">'.$row["email"].'</span>
                
                                            </span>
                                        </div>';
                                         }
                                         else
                                         {
                                            $curr_user_id=$row["user_id"];
                                            $output.= '<div  style="margin: 4px;border: 1.5px solid #0067A3;">
                                            <form method="POST" class="delete_from_board" id="delete_onBoard" action="deleteUserFromBoard.php">
                                            
                                                <input type="hidden" id="user_id" name="user_id" value="'.$curr_user_id.'"/>
                                                <span class="dropdown-item" style="font-size: 20px;">
                                                    <a class="btn btn-dark" id="user_name" style="color: rgb(255, 255, 255)" href="#">'.$row["name"].'</a>
                                                    <div style="float: right;clear: right;">
                                                        <button type="submit" class="btn btn-outline-danger" style="border-radius:50px; " aria-hidden="true">&times;</button>
                                                    </div>
                                                    <br>
                                                    <span class="badge badge-light" id="user_email" style="font-size:12px; ">'.$row["email"].'</span>
                                            </span>
                                            </form>
                                        </div>';
                                         }
                                     }
                                 }
$result=array('users'=>$output);
echo json_encode($result);
?>