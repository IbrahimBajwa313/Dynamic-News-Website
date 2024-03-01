<?php 
include "header.php";
include "config.php"; 
if( $_SESSION['user_role'] != 1){
    header("location: http://localhost/news-website/admin/post.php");
}
 
    $UserID = $_GET['id']; 

    $sql = "SELECT * FROM user WHERE user_id={$UserID}";
    $result = mysqli_query($conn, $sql) or die("Query Failed");

    if(mysqli_num_rows($result) > 0 ){
        $row = mysqli_fetch_assoc($result);
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php
                if (isset($_POST['submit'])) { 
                    $user_id = $_GET['id'];

                    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
                    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
                    $user = mysqli_real_escape_string($conn, $_POST['username']); 
                    $role = mysqli_real_escape_string($conn, $_POST['role']);

                    // Update SQL query with proper WHERE clause
                    $sql = "UPDATE user
                            SET first_name = '{$fname}',
                                last_name = '{$lname}',
                                username = '{$user}',
                                role = '{$role}' 
                            WHERE user_id={$user_id}";

                    $result = mysqli_query($conn, $sql) or die("Query Failed");
                    if ($result) {
                        header("Location: {$hostname}/admin/users.php");
                        exit;
                    } else {
                        echo "Error updating record: " . mysqli_error($conn);
                    }
                }
                ?>
                <!-- Form Start -->
                <form action="" method="POST">
                    <!-- Hidden field for user_id -->
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <option value="0" <?php if($row['role'] == "0") echo "selected"; ?>>Normal User</option>
                            <option value="1" <?php if($row['role'] == "1") echo "selected"; ?>>Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php 
    } // End of if(mysqli_num_rows($result) > 0 )
 
include "footer.php"; 
?>
