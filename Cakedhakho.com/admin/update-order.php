<?php include('partitals/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Order</h1>

		<br><br>

		<?php  

			// get the id of selected or not
			if (isset($_GET['id'])) {
				$id = $_GET['id'];

				$sql = "SELECT * FROM order_table WHERE id=$id";
				$res = mysqli_query($conn, $sql);

				$count = mysqli_num_rows($res);

				if ($count==1) {
					$row = mysqli_fetch_assoc($res);

					$food = $row['food'];
					$price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address  = $row['customer_address'];
				}
				else{
					header('Location:'.SITEURL.'admin/manage-order.php');
				}
			}
			else{
				header('Location:'.SITEURL.'admin/manage-order.php');
			}
		?>

		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
					<td>Cake Name</td>
					<td><b><?php echo $food; ?></b></td>
				</tr>

				<tr>
					<td>Price</td>
					<td><b>₹<?php echo $price; ?></b></td>
				</tr>

				<tr>
					<td>Qty.</td>
					<td>
						<input type="number" name="qty" value="<?php echo $qty; ?>">
					</td>
				</tr>

				<tr>
					<td>Status</td>
					<td>
						<select name="status">
							<option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
							<option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
							<option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
							<option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
						</select>
					</td>
				</tr>

				<tr>
					<td>Customer Name</td>
					<td>
						<input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
					</td>
				</tr>

				<tr>
					<td>Customer Contact</td>
					<td>
						<input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
					</td>
				</tr>

				<tr>
					<td>Customer Email</td>
					<td>
						<input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
					</td>
				</tr>

				<tr>
					<td>Customer Address</td>
					<td>
						<textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="price" value="<?php echo $price; ?>">
						<input type="submit" name="submit" value="Update Order" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<?php 	 

			// chekc button is click or not
			if(isset($_POST['submit'])){
				// get all details from form
				$id = mysqli_real_escape_string($conn, $_POST['id']);
				$price = mysqli_real_escape_string($conn, $_POST['price']);
				$qty = mysqli_real_escape_string($conn, $_POST['qty']);

				$total = $price * $qty;

				$status = mysqli_real_escape_string($conn, $_POST['status']);
				$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
				$customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
				$customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
				$customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

				$sql2 = "UPDATE order_table SET 
					qty ='$qty',
					total = '$total',
					status = '$status',
					customer_name = '$customer_name',
					customer_contact = '$customer_contact',
					customer_email = '$customer_email',
					customer_address = '$customer_address'
					WHERE id='$id'
				";

				$res2 = mysqli_query($conn, $sql2);

				if($res2 == TRUE){
					$_SESSION['update'] = "<div class = 'success'> Order Update Successfully. </div>";
					header('Location:'.SITEURL.'admin/manage-order.php');
				}
				else{
					$_SESSION['update'] = "<div class = 'error'> Fail to update Order. </div>";

					// redirect the page to manage category
					header('Location:'.SITEURL.'admin/update-order.php');
				}
			}

		?>

	</div>
</div>