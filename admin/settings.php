<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Settings</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <?php
         
        include 'config.php';
        // Query to take the Data of that specific user 
        $sql = "SELECT * FROM settings";

        $result = mysqli_query($conn, $sql) or die("Query Failed");
                                    
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
        ?>
        <!-- Form for show edit-->
        <form action="save-settings.php" method="POST" enctype="multipart/form-data" autocomplete="off">
             
            <!-- Website Name -->
            <div class="form-group">
                <label for="exampleInputTile">Website Name</label>
                <input type="text" name="websitename" class="form-control" id="exampleInputUsername" value="<?php echo $row['websitename']; ?>">
            </div>
             
            <!-- Footer Description -->
            <div class="form-group">
                <label for="exampleInputCategory">Footer Description</label>
                <!-- <textarea  name="footerdesc" class="form-control" id="exampleInputUsername" value="<?php echo $row['footerdesc']; ?>"></textarea> -->
                <textarea name="footerdesc" class="form-control" id="exampleInputUsername"><?php echo $row['footerdesc']; ?></textarea>

            </div>

            <!-- Logo image -->
            <div class="form-group">
                <label for="">Logo image</label><br>
                <img  src="images/<?php echo $row['logo']; ?>" height="150px"> <br>
                <label style=margin-top:8px for="">Change Logo</label><br>
                <input style=margin-top:8px type="file" name="new_image">
                <!-- <label for="">Previous image</label> -->
                <input type="hidden" name="old_image" value="<?php echo $row['logo']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>

        <!-- Form End -->
        <?php
            }
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
