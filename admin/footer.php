 


<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php   
                 $sql = "SELECT footerdesc FROM settings";
                 $result = mysqli_query($conn,$sql) or die("Logo Query Failed");
                 $row = mysqli_fetch_assoc($result);
            ?>
                <span><?php echo $row['footerdesc'] ; ?></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
