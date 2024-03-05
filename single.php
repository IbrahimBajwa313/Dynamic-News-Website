<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                <?php
                include "config.php";

                $post_id = $_GET['id'];

                    $sql = "SELECT p.post_id, p.title, p.description, p.post_img,p.author,
                    p.post_date, c.category_name, u.username, p.category
                    FROM post p
                    inner JOIN category c ON p.category = c.category_id
                    inner JOIN user u ON p.author = u.user_id 
                    WHERE p.post_id = {$post_id} ";  

                    $result = mysqli_query($conn,$sql) or die("Query Failed");
                                                                
                    if(mysqli_num_rows($result) > 0){
                       $row = mysqli_fetch_assoc($result)
                ?>
                  <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date']; ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                            <p class="description">
                                <?php echo $row['description']; ?>            
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                    <?php  } ?>
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
