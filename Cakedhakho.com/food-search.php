<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php    

            // get search keyword
            $search =mysqli_real_escape_string($conn, $_POST['search']);

            ?>
            
            <h2>Cakes on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Cake Menu</h2>

            <?php    

                // sql qurey for getting the cake based on search keyword
                $sql = "SELECT * FROM cake WHERE title LIKE'%$search%' OR description LIKE '%$search%'";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count>0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        // get the values like id, title, description, price, image_name
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $price = $rows['price'];
                        $description = $rows['description'];
                        $image_name = $rows['image_name'];
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
                    echo "<div class = 'error'> Categorys are not Added. </div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

</body>
</html>