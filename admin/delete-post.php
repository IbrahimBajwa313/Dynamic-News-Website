<?php
include 'header.php';
include 'config.php';

if(isset($_POST["confirm_delete"])){

    $post_id = $_GET["id"];
    $category_id = $_GET['catid'];
    
    // To delete the specific image from the folder
    $sql1 = "SELECT * FROM post WHERE post_id={$post_id};";
    $result1 = mysqli_query($conn,$sql1) or die("Select Query Failed");
    $row1 = mysqli_fetch_assoc($result1);
    unlink("upload/".$row1['post_img']);

    // To delete the specific record from the database
    $sql = "DELETE FROM post WHERE post_id={$post_id};"; // Corrected to separate the statements with a semicolon
    $sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$category_id};"; // Concatenating the update statement 
    $result = mysqli_multi_query($conn, $sql) or die("Query unsuccessful");
    
     header("location: {$hostname}/admin/post.php");

    mysqli_close($conn);
     
}

// Check if the ID parameter is provided in the URL and it is numeric
else if(isset($_GET["id"]) && is_numeric($_GET["id"])) { // Changed from "id" to "id"

    // Get the student ID from the URL
    $post_id = $_GET["id"]; // Changed from "id" to "id"

    // Retrieve post information based on the ID
    $sql = "SELECT * FROM post WHERE post_id={$post_id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if a record with the provided ID exists
    if($row) {
?>
<div id="main-content">
    <h2>Delete Confirmation</h2>
    <div class="confirmation-info">
        <p><strong>ID:</strong> <?php echo $row['post_id']; ?></p>
        <p><strong>Post Tilte:</strong> <?php echo $row['title']; ?></p>
        <p><strong>Author's ID:</strong> <?php echo $row['author']; ?></p>
        <p><strong>Post Date:</strong> <?php echo $row['post_date']; ?></p>
    </div>

    <form action="delete-post.php?id=<?php echo $row['post_id'] ; ?>&catid=<?php echo $row['category'] ?>" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <div class="confirmation-buttons">
            <input type="submit" name="confirm_delete" value="Confirm Delete" class="btn btn-danger">
            <button type="button" onclick="window.history.back();" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<?php 
    } else {
        // No record found with the provided ID
        echo "<div class='error-message'>Student record with ID: {$post_id} does not exist.</div>";
    }
} else {
    // ID parameter not provided in the URL or not numeric
    echo "<div class='error-message'>Invalid student ID provided.</div>";
}

mysqli_close($conn); 
?>
