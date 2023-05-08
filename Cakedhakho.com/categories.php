<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Cakes</h2>

            <?php    

                // display all categorys
                $sql = "SELECT * FROM categoris WHERE active = 'Yes'";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count>0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        // get the values like id, title, image_name
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        ?>

                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php    

                                        if ($image_name == "") {
                                            // display message
                                            echo "<div class = 'error'> Image is not available. </div>";
                                        }
                                        else{
                                            // image is availabe
                                            ?>

                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive2 img-curve">

                                            <?php
                                        }

                                    ?>
                                   
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>

                        <?php
                    }
                }
                else{
                    echo "<div class = 'error'> Categorys are not Added. </div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


</body>
</html>