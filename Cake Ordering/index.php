<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Cake.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php  

        if(isset($_SESSION['order'])){
            echo $_SESSION['order']; 
            unset($_SESSION['order']); 
        }

    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Cakes</h2>

            <?php 

                // create sql query for accessing data from database
                $sql = "SELECT * FROM categoris WHERE active = 'Yes' AND feature = 'Yes' LIMIT 3";
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

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Cake Menu</h2>

            <?php  

                // getthing cakes from database that are active and feature
                $sql2 = "SELECT * FROM cake WHERE active = 'Yes' AND feature = 'Yes' LIMIT 6";
                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if ($count2>0) {
                    while ($rows2 = mysqli_fetch_assoc($res2)) {
                        // get the values like id, title, decription, price, image_name
                        $id = $rows2['id'];
                        $title = $rows2['title'];
                        $price = $rows2['price'];
                        $description = $rows2['description'];
                        $image_name = $rows2['image_name'];
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php  

                                        if ($image_name == "") {
                                            // display message image is not available
                                            echo "<div class = 'error'> Cake is not available. </div>";
                                        }
                                        else{
                                            // image is availabe
                                            ?>

                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">

                                            <?php
                                        }

                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">₹<?php echo $price; ?></p>
                                    <p class="food-detail">
                                       <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?cake_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }
                }
                else{
                    echo "<div class = 'error'> Cakes are not Added. </div>";
                }

            ?>


                <div class="clearfix"></div>

            </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
</body>
</html>