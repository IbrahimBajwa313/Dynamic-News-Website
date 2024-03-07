<!DOCTYPE html>
<html lang="en">

<?php
    // echo "<pre>";
    // print_r($_SERVER);
    // echo "</pre>";

    // Code for Dynamic Title
    include 'config.php';
    $page = basename($_SERVER['PHP_SELF']);

    switch ($page) {
        case "single.php":
            if(isset($_GET['id'])){
                $sql_title = "SELECT * FROM post WHERE post_id= {$_GET['id']} "; 
                $result_title = mysqli_query($conn,$sql_title) or die("Title Query Failed") ;
                $row_title = mysqli_fetch_assoc($result_title);
                $title = $row_title['title'];
            } else {
                $title ="No Post Found";
            }
            break;
            
        case "category.php":
            if(isset($_GET['cid'])){
                $sql_title = "SELECT * FROM category WHERE category_id={$_GET['cid']} "; 
                $result_title = mysqli_query($conn,$sql_title) or die("Title Query Failed") ;
                $row_title = mysqli_fetch_assoc($result_title);
                $title = $row_title['category_name'] . " News";
            } else {
                $title ="No category Found";
            }
            break;
        case "author.php":
            if(isset($_GET['aid'])){
                $sql_title = "SELECT * FROM user WHERE user_id={$_GET['aid']} "; 
                $result_title = mysqli_query($conn,$sql_title) or die("Title Query Failed") ;
                $row_title = mysqli_fetch_assoc($result_title);
                $title = "News By " . $row_title['username'];
            } else {
                $title ="No Author Found";
            }
            break;
        case "search.php":
            if(isset($_GET['search'])){
                $title = $_GET['search'];
            } else {
                $title ="No Search Results Found";
            }
            break;

        default :
        $title = " News Site";

    }


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php  echo $title  ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <?php   
                 $sql_logo = "SELECT logo FROM settings";
                 $result_logo = mysqli_query($conn,$sql_logo) or die("Logo Query Failed");
                 $row_logo = mysqli_fetch_assoc($result_logo);
            ?>
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/<?php echo $row['logo'] ; ?>"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->


<?php
    include "config.php";
    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];
    }   
    $active = "";

    $sql = "SELECT * FROM category where post > 0";
    $result = mysqli_query($conn, $sql) or die("Category Query Failed");
?>

<div id="menu-bar">
    <div class="container">`
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                 <li><a href=' <?php echo $hostname ; ?>'>Home</a></li> 


                    <?php  while($row = mysqli_fetch_assoc($result)){ 
                        if(isset($_GET['cid'])){
                            if($cid == $row['category_id']){
                                $active = "active" ;
                            } else {
                                $active = "";
                            }
                        }                     
                        echo "<li><a class = '{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li> ";
                    } ?>
                </ul>

            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
