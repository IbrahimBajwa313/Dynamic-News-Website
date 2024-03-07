<?php include "header.php";
include "config.php"; 
  
if( $_SESSION['user_role'] != "1"){
    header("location: http://localhost/news-website/admin/post.php");
}
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>

                      <?php 
                            $limit = 7;
                            
                            if(isset($_GET['page'])){
                                $page = $_GET['page'];
                            } else {
                                $page = 2 ;
                            }
                            $offset = ($page-1)*$limit;

                            $sql = "Select * From user ORDER BY user_id desc LIMIT {$offset} ,{$limit}" ;
                            $result = mysqli_query($conn,$sql) or die("Query Failed");
                    
                            if(mysqli_num_rows($result) > 0){
                                while( $row = mysqli_fetch_assoc($result)){
                                     
                      ?>
                      <tbody>
                          <tr>
                              <td class='id'> <?php echo $row['user_id'] ; ?></td>
                              <td><?php echo $row['first_name'] . " " . $row['last_name'] ; ?></td>
                              <td><?php echo $row['username'] ; ?></td>
                              <td><?php if ( $row['role'] == 1){ echo "admin";} else {echo "Normal user";}   ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id'] ; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete_user.php?id=<?php echo $row['user_id'] ; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                      
                      </tbody>
                      <?php }
                     }
                       ?>
                  </table>
                  <?php
                        $sql1 = 'SELECT * FROM user';
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                        
                        if(mysqli_num_rows($result1) > 0) {
                            $total_Users = mysqli_num_rows($result1);
                            
                            $total_Page = ceil($total_Users / $limit);
                            echo '<ul class="pagination admin-pagination">';
                            if ($page > 1) {
                            echo '<li><a href="users.php?page='.($page - 1).'">Prev</a></li>';
                            }
                            for($i = 1; $i <= $total_Page; $i++) {
                                if($i == $page){
                                    $active = "active";
                                } else {
                                    $active = "";
                                }

                                echo '<li class="'.$active.'"><a  href="users.php?page='.$i.'">'. $i . '</a></li>';
                            }
                            if ($page < $total_Page) {
                                echo '<li><a href="users.php?page='.($page + 1).'">Next</a></li>';
                            }
                            
                            echo '</ul>';
                        }
                    ?>

              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
