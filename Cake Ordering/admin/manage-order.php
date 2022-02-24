<?php include('partitals/menu.php'); ?>

<!-- Main Content Section Start -->
<div class="main-content">
	<div class="wrapper">
		<h1>Manage Order</h1>

		<br><br><br>

		<?php  

			if (isset($_SESSION['update'])) {
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}

		?>

		<br><br>
		<table class="tbl-full">
			<tr>
				<th>Sr.No.</th>
				<th>Food</th>
				<th>Price</th>
				<th>Qty.</th>
				<th>Total</th>
				<th>Order Date</th>
				<th>Status</th>
				<th>Customer Name</th>
				<th>Contact</th>
				<th>Email</th>
				<th>Address</th>
				<th>Vaccineated</th>
				<th>Actions</th>
			</tr>

			<?php  

				// query to get all order data
				$sql = "SELECT * FROM  order_table ORDER BY id DESC";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);

				$srno = 1;

				if($count > 0){
					// data available
					while($rows = mysqli_fetch_assoc($res)){
						$id = $rows['id'];
						$food = $rows['food'];
                        $price = $rows['price'];
                        $qty = $rows['qty'];
                        $total = $rows['total'];
                        $order_date = $rows['order_date'];
                        $status = $rows['status'];
                        $customer_name = $rows['customer_name'];
                        $customer_contact = $rows['customer_contact'];
                        $customer_email = $rows['customer_email'];
                        $customer_address  = $rows['customer_address'];
                        $vaccineated = $rows['vaccineated'];

                        ?>

                        	<tr>
								<td><?php echo $srno++; ?></td>
								<td><?php echo $food; ?></td>
								<td><?php echo $price; ?></td>
								<td><?php echo $qty; ?></td>
								<td><?php echo $total; ?></td>
								<td><?php echo $order_date; ?></td>

								<td>
									<?php 
										// Ordered, On Delivery, Delivered, Cancelled
										if ($status == "Ordered") {
											echo "<label>$status</label>";
										}
										elseif ($status == "On Delivery") {
											echo "<label style='color: orange;'>$status</label>";
										}
										elseif ($status == "Delivered") {
											echo "<label style='color: green;'>$status</label>";
										}
										elseif ($status == "Cancelled") {
											echo "<label style='color: red;'>$status</label>";
										}
									?>
								</td>

								<td><?php echo $customer_name; ?></td>
								<td><?php echo $customer_contact; ?></td>
								<td><?php echo $customer_email; ?></td>
								<td><?php echo $customer_address; ?></td>
								<td><?php echo $vaccineated; ?></td>
								<td>
									<a href="<?php echo	SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Orderd</a>
								</td>
							</tr>

                        <?php  
					}
				}
				else{
					// data not available
					echo "<tr><td colspan='12' class='error'> Orders not Available </td></tr>";
				}

			?>

		</table>
	</div>
</div>
<!-- Main Contect Section End -->