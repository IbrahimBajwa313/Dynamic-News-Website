<?php
include "config.php";

// Code for the file (image) to upload
if(isset($_FILES['fileToUpload'])){

    $errors = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    
    $file_ext_temp = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext_temp));   // This will explode the name of the image and the end part will be stored with lower case {like jpg}
    $extentions = array("jpeg" , "jpg" , "png" );

    // Checks for and Conditions for the images
    if(!in_array($file_ext,$extentions)){
        $errors[] = "This extention file is not allowoed. Plese chose a jpeg ,jpg or png file";
    }

    if($file_size > 2097152){
        $errors[] = "File Size should be 2mb or lower";
    }

    if(empty($errors)){
        move_uploaded_file($file_tmp, "upload/".$file_name);
    } else {
        print_r($errors);
        die();
    }
} 

// The title decription etc are stored after escaping the special chars
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$description = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d - m - y");

session_start();
$author = $_SESSION['user_id'];

// sql queries to store the data in the data base
$sql = "INSERT INTO post (title, description, category, post_date, author, post_img)
        VALUES ('$title', '$description', $category, '$date', $author, '$file_name')";
$sql .= "; UPDATE category SET post = post + 1 WHERE category_id = $category";


if(mysqli_multi_query($conn,$sql)){
    header("Location: {$hostname}/admin/post.php");
} else {
    echo "Query Failed";
}
?>