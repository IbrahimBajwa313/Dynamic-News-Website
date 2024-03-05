<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php
                    include "config.php";
                         $sql = "SELECT p.post_id, p.title, p.description, p.post_img,
                         p.post_date, c.category_name, u.username, p.category
                         FROM post p
                         inner JOIN category c ON p.category = c.category_id
                         inner JOIN user u ON p.author = u.user_id
                         ORDER BY p.post_id DESC  ";   

                        $result = mysqli_query($conn,$sql) or die("Query Failed");
                                                                    
                        if(mysqli_num_rows($result) > 0){
                            while( $row = mysqli_fetch_assoc($result)){
                    
                    ?>

                    <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                <a class="post-img" href="single.php">
                                    <img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                                </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php'><?php echo $row['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php'><?php echo $row['category']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php'><?php echo $row['username']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']; ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo $row['description']; ?>                                 
                                         </p>
                                        <a class='read-more pull-right' href='single.php'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  }} ?>
                        
                        </div>
                        <ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                        </ul>
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
