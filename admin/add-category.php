<?php
include "header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "config.php";

    $category = mysqli_real_escape_string($conn, $_POST['cat']);

    $sql = "INSERT INTO category (category_name) VALUES ('$category')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: {$hostname}/admin/category.php");
        exit;
    } else {
        echo "<p class='error-message'>Failed to add category.</p>";
    }
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
