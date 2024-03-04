<?php
include 'header.php';
include 'config.php';
if( $_SESSION['user_role'] != 1){
    header("location: http://localhost/news-website/admin/post.php");
}
if(isset($_POST["confirm_delete"])){

    $user_id = $_GET["id"];
    $sql = "DELETE FROM user WHERE user_id={$user_id}"; // Removed the asterisk (*) and corrected the SQL statement
    $result = mysqli_query($conn, $sql) or die("Query unsuccessful"); 

    header("location: {$hostname}/admin/users.php");

    mysqli_close($conn);
     
}

// Check if the ID parameter is provided in the URL and it is numeric
else if(isset($_GET["id"]) && is_numeric($_GET["id"])) { // Changed from "id" to "id"

    // Get the student ID from the URL
    $user_id = $_GET["id"]; // Changed from "id" to "id"

    // Retrieve student information based on the ID
    $sql = "SELECT * FROM user WHERE user_id={$user_id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if a record with the provided ID exists
    if($row) {
?>
<div id="main-content">
    <h2>Delete Confirmation</h2>
    <div class="confirmation-info">
        <p><strong>ID:</strong> <?php echo $row['user_id']; ?></p>
        <p><strong>First Name:</strong> <?php echo $row['first_name']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $row['last_name']; ?></p>
        <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
    </div>

    <form action="delete_user.php?id=<?php echo $row['user_id'] ; ?>" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div class="confirmation-buttons">
            <input type="submit" name="confirm_delete" value="Confirm Delete" class="btn btn-danger">
            <button type="button" onclick="window.history.back();" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<?php 
    } else {
        // No record found with the provided ID
        echo "<div class='error-message'>Student record with ID: {$user_id} does not exist.</div>";
    }
} else {
    // ID parameter not provided in the URL or not numeric
    echo "<div class='error-message'>Invalid student ID provided.</div>";
}

mysqli_close($conn); 
?>
