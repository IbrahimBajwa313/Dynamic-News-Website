<?php
include "config.php";

// Check the image is uploaded or not
if(empty($_FILES['new_image']['name'])){
    $file_name= $_POST['old_image'];
} else {

    $errors = array();

    $file_name = $_FILES['new_image']['name'];
    $file_size = $_FILES['new_image']['size'];
    $file_tmp = $_FILES['new_image']['tmp_name'];
    $file_type = $_FILES['new_image']['type'];
    
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
        move_uploaded_file($file_tmp, "images/".$file_name);
    } else {
        print_r($errors);
        die();
    }  
}

// Escape string values for security
$websitename = $_POST['websitename'];
$footerdecs = $_POST['footerdesc']; 

// Query to Update the records in the database table post
$sql = "UPDATE settings SET websitename='{$websitename}', footerdesc='{$footerdecs}', logo='{$file_name}'";

$result = mysqli_query($conn, $sql);

if ($result !== false && mysqli_affected_rows($conn) > 0) {
    header("location: {$hostname}/admin/post.php");
} else {
    echo "Query Failed";
}



?>