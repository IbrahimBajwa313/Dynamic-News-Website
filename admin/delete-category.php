<?php
include 'header.php';
include 'config.php';

// Check if the user has admin privileges
if ($_SESSION['user_role'] != 1) {
    header("location: {$hostname}/admin/post.php");
    exit; // Add an exit to prevent further execution
}

// Check if the confirmation form is submitted
if (isset($_POST["confirm_delete"])) {
    $category_id = $_GET["id"];
    $sql = "DELETE FROM category WHERE category_id={$category_id}"; // Corrected the SQL statement for deleting categories
    $result = mysqli_query($conn, $sql) or die("Query unsuccessful: " . mysqli_error($conn)); // Add error handling

    header("location: {$hostname}/admin/category.php");
    exit; // Add an exit to prevent further execution
}

// Check if the ID parameter is provided in the URL and it is numeric
else if (isset($_GET["cid"]) && is_numeric($_GET["cid"])) {
    // Get the category ID from the URL
    $category_id = $_GET["cid"];

    // Retrieve category information based on the ID
    $sql = "SELECT * FROM category WHERE category_id={$category_id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if a record with the provided ID exists
    if ($row) {
?>
<div id="main-content">
    <h2>Delete Confirmation</h2>
    <div class="confirmation-info">
        <p><strong>ID:</strong> <?php echo $row['category_id']; ?></p>
        <p><strong>Category Name:</strong> <?php echo $row['category_name']; ?></p>
    </div>

    <form action="delete-category.php?id=<?php echo $row['category_id']; ?>" method="post"> 
        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
        <div class="confirmation-buttons">
            <input type="submit" name="confirm_delete" value="Confirm Delete" class="btn btn-danger">
            <button type="button" onclick="window.history.back();" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<?php 
    } else {
        // No record found with the provided ID
        echo "<div class='error-message'>Category with ID: {$category_id} does not exist.</div>";
    }
} else {
    // ID parameter not provided in the URL or not numeric
    echo "<div class='error-message'>Invalid category ID provided.</div>";
}

mysqli_close($conn); 
?>
