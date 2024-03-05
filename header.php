<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
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
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
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
