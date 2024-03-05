<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php  
                if(isset($_GET['cid'])){
                    $cid = $_GET['cid'];
                }
                    include "config.php"; 
                    $sql2="Select category_name FROM category where category_id={$cid}";
                    $result2= mysqli_query($conn, $sql2);
                    $row2= mysqli_fetch_assoc($result2);
                ?>
                <div class="post-container">
                  <h2 class="page-heading"><?php echo $row2['category_name'] ; ?></h2>
                      <!-- Main Content -->
            <?php
             
            $limit = 3;
            
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $offset = ($page - 1) * $limit;
            
            

            // SQL Command To Select Only The News Of Specific Category
            $sql = "SELECT p.post_id, p.title, p.description, p.post_img,p.author,
                    p.post_date, c.category_name, u.username, p.category
                    FROM post p
                    INNER JOIN category c ON p.category = c.category_id
                    INNER JOIN user u ON p.author = u.user_id
                    WHERE c.category_id = {$cid}
                    ORDER BY p.post_id DESC LIMIT {$offset}, {$limit}";   

            $result = mysqli_query($conn, $sql) or die("Query Failed");
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                   
            ?> <div class="post-container">
                <!-- Post Content: Displaying the Content of the Post -->
                <div class="post-content">
                    <div class="row">
                        <div class="col-md-4">
                            <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>">
                                <img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="inner-content clearfix">
                                <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
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
                                <p class="description">
                                    <?php 
                                    $description = $row['description'];
                                    $lines = explode('.', $description);
                                    $trimmedDescription = implode('.', array_slice($lines, 0, 4));
                                    echo $trimmedDescription . "...";
                                    ?>                                 
                                </p>
                                <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- Post Content End  -->
            
            <?php
                }
            } else {
                echo "<h>No Records Found</h>";
            }

            // Code For Pagination
            $sql1 = "SELECT * FROM post WHERE category = {$cid}";

            $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
            if(mysqli_num_rows($result1) > 0) {
                $total_Posts = mysqli_num_rows($result1);
                $total_Page = ceil($total_Posts / $limit);
                echo '<ul class="pagination admin-pagination">';
                if ($page > 1) {
                    echo "<li><a href='category.php?cid={$cid}&page=".($page - 1)."'>Prev</a></li>";
                }
                for ($i = 1; $i <= $total_Page; $i++) {
                    if ($i == $page) {
                        $active = "active";
                    } else {
                        $active = "";
                    }
                    echo "<li class='{$active}'><a href='category.php?cid={$cid}&page={$i}'>{$i}</a></li>";
                }
                if ($page < $total_Page) {
                    echo "<li><a href='category.php?cid={$cid}&page=".($page + 1)."'>Next</a></li>";
                }
                
                echo '</ul>';
            } else {
                echo "<h>No Records Found</h>";
            }
            ?> 
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
