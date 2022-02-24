<?php include('partials-front/menu.php'); ?>


<?php    

    // check id is passed or not
    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];

        // get category title based on category id
        $sql = "SELECT title FROM categoris WHERE id=$category_id";

        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        $rows = mysqli_fetch_assoc($res);
        $category_title = $rows['title'];
    }
    else{
        header('Location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Cakes on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Cake Menu</h2>

            <?php    

            $sql2 = "SELECT * FROM cake WHERE category_id=$category_id";

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
                echo "<div class = 'error'> Categorys are not Added. </div>";
            }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


</body>
</html>