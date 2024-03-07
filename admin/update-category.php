<?php include "header.php";
if( $_SESSION['user_role'] != 1){
    header("location: http://localhost/news-website/admin/post.php");
} ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>

                        <?php
                    include "config.php";
                    $cid = $_GET['cid'];
                    
                    // Query to take the Data of that specific user 
                    $sql = "SELECT * FROM category WHERE category_id={$cid} ";                           

                    $result = mysqli_query($conn, $sql) or die("Query Failed");
                                                
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                    ?>

                <!-- Form Start -->
              <div class="col-md-offset-3 col-md-6">
                  <form action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                <!-- Form End -->
                </div>
                <?php }} ?>


              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
