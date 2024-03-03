<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      
                      <tbody>
                      <?php 
                            $limit = 7;
                            
                            if(isset($_GET['page'])){
                                $page = $_GET['page'];
                            } else {
                                $page = 2 ;
                            }
                            $offset = ($page-1)*$limit; //LIMIT {$offset},{$limit}

                             
                            if( $_SESSION['user_role'] == 1){
                                $sql = "SELECT * FROM post
                                inner JOIN category ON post.category = category.category_id
                                inner JOIN user ON post.author = user.user_id
                                ORDER BY post.post_id DESC  ";                           
                             }
                              elseif( $_SESSION['user_role'] != 1)
                               {
                                $sql = "SELECT * FROM post
                                INNER JOIN category ON post.category = category.category_id
                                INNER JOIN user ON post.author = user.user_id
                                WHERE post.author = {$_SESSION['user_id']}
                                ORDER BY post.post_id DESC";

                             }

                            
 
                            $result = mysqli_query($conn,$sql) or die("Query Failed");
                    
                            if(mysqli_num_rows($result) > 0){
                                while( $row = mysqli_fetch_assoc($result)){
                      ?>
                          <tr>
                              <td class='id'><?php echo $row['post_id']; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td class='edit'><a href='update-page.php?id=<?php $row['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php $row['post_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php }} ?>
                      </tbody>
                  </table>
                  <?php
                        $sql1 = 'SELECT * FROM post';
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                        
                        if(mysqli_num_rows($result1) > 0) {
                            $total_Users = mysqli_num_rows($result1);
                            
                            $total_Page = ceil($total_Users / $limit);
                            echo '<ul class="pagination admin-pagination">';
                            if ($page > 1) {
                            echo '<li><a href="post.php?page='.($page - 1).'">Prev</a></li>';
                            }
                            for($i = 1; $i <= $total_Page; $i++) {
                                if($i == $page){
                                    $active = "active";
                                } else {
                                    $active = "";
                                }

                                echo '<li class="'.$active.'"><a  href="post.php?page='.$i.'">'. $i . '</a></li>';
                            }
                            if ($page < $total_Page) {
                                echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                            }
                            
                            echo '</ul>';
                        }
                    ?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
