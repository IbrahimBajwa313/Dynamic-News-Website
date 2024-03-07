<?php
include "header.php";

if ($_SESSION['user_role'] != 1) {
    header("location: {$hostname}/admin/category.php");
    exit; // Add exit to stop further execution
}

include "config.php";

if(isset($_POST['submit'])) {
    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);

    $sql = "UPDATE category SET category_name = '$cat_name' WHERE category_id = $cat_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: {$hostname}/admin/category.php");
        exit; // Add exit to stop further execution
    } else {
        echo "<p class='error-message'>Failed to update category.</p>";
    }
}

?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Category</h1>
            </div>

            <?php
            $cid = $_GET['cid'];
            $sql = "SELECT * FROM category WHERE category_id = $cid";
            $result = mysqli_query($conn, $sql) or die("Query Failed");

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>

            <div class="col-md-offset-3 col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['category_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update">
                </form>
            </div>

            <?php
                }
            }
            ?>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>
