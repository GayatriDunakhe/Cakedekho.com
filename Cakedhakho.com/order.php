<?php include('partials-front/menu.php'); ?>

<?php  

    // check cake id is set or not
    if (isset($_GET['cake_id'])) {
        // get details of  selected cake
        $cake_id = $_GET['cake_id'];

        // get the details of the selected food
        $sql = "SELECT * FROM cake WHERE id=$cake_id";

        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count == 1){
            // we have data so get that data form database
            $rows = mysqli_fetch_assoc($res);

            $title = $rows['title'];
            $price = $rows['price'];
            $image_name = $rows['image_name'];
        }
        else{
            // data is not present and redirect homepage
            header('Location:'.SITEURL);
        }
    }
    else{

        // redirect to homepage
        header('Location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Cake</legend>

                    <div class="food-menu-img">

                        <?php  

                            // check image is available or not
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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. First Last Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 8943xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. go@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <div class="order-label">Are you Vaccineated?
                    <input type="radio" name="vaccine" value="Yes"> Yes
                    <input type="radio" name="vaccine" value="No"> No</div>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php  

                // check whether the submit button is clicked or not
                if (isset($_POST['submit'])) {
                    // get all data
                    $food = mysqli_real_escape_string($conn, $_POST['food']);
                    $price = mysqli_real_escape_string($conn, $_POST['price']);
                    $qty = mysqli_real_escape_string($conn, $_POST['qty']);

                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:i:sa");

                    $status = "Ordered"; // ordered, on delivery, delivered, cancelled
                    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                    $customer_email = mysqli_real_escape_string($conn,$_POST['email']);
                    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

                    // vaccineated radio input type we need to check button is selected or not
                    if(isset($_POST['vaccine'])){
                        // seting form value
                        $vaccineated = mysqli_real_escape_string($conn, $_POST['vaccine']);

                    }
                    else{
                        // seting default value
                        $vaccineated = "No";
                    }

                    // save order in database, create database
                    $sql2 = "INSERT INTO  order_table SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address  = '$customer_address',
                        vaccineated = '$vaccineated'
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == TRUE){
                        $_SESSION['order'] = "<div class = 'success text-center'> Order Placed Successfully . </div>";
                        header('Location:'.SITEURL);
                    }
                    else{
                        $_SESSION['order'] = "<div class = 'error text-center'> Failed to Ordered Cake. </div>";
                        header('Location:'.SITEURL);
                    }
                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

</body>
</html>