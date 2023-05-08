<?php include('partitals/menu.php'); ?>

<!-- Main Content Section Start -->
<div class="main-content">
	<div class="wrapper">
		<h1>Manage Cake</h1>

		<br><br>
		<!-- Button to add admin -->
		<a href="<?php echo SITEURL; ?>admin/add-cake.php" class="btn-primary">Add Cakes</a>

		<br><br>
		<?php 	 

		if(isset($_SESSION['add'])){
			echo $_SESSION['add']; 
			unset($_SESSION['add']); 
		}

		if(isset($_SESSION['unauthorized'])){
			echo $_SESSION['unauthorized']; 
			unset($_SESSION['unauthorized']); 
		}

		if(isset($_SESSION['delete'])){
			echo $_SESSION['delete']; 
			unset($_SESSION['delete']); 
		}


		if(isset($_SESSION['remove'])){
			echo $_SESSION['remove']; 
			unset($_SESSION['remove']); 
		}
		
		if (isset($_SESSION['upload'])){
		 	echo $_SESSION['upload'];
			unset($_SESSION['upload']);
		}

		if (isset($_SESSION['update'])){
		 	echo $_SESSION['update'];
			unset($_SESSION['update']);
		}

		if (isset($_SESSION['failed-remove'])){
		 	echo $_SESSION['failed-remove'];
			unset($_SESSION['failed-remove']);
		}

		if (isset($_SESSION['no-category-found'])){
		 	echo $_SESSION['no-category-found'];
			unset($_SESSION['no-category-found']);
		}

		?>

		<br><br><br>
		<table class="tbl-full">
			<tr>
				<th>Sr.No.</th>
				<th>Title</th>
				<th>Description</th>
				<th>Price</th>
				<th>Image</th>
				<!-- <th>Category</th> -->
				<th>Feature</th>
				<th>Active</th>
				<th>Action</th>
			</tr>

			<?php 	

				// query to get all admin data
				$sql = "SELECT * FROM cake";

				// execute the query
				$res = mysqli_query($conn, $sql);

				// count row
				$count = mysqli_num_rows($res);

				$srno = 1;

				// count rows to check data in database or not
				if($count > 0){
					// get the data
					while($rows = mysqli_fetch_assoc($res)){

						// get values from database
						$id = $rows['id'];
						$title = $rows['title'];
						$description = $rows['description'];
						$price = $rows['price'];
						$image = $rows['image_name'];
						$category_id = $rows['category_id'];
						$feature = $rows['feature'];
						$active = $rows['active'];

						// display that all values
						?>

						<!-- html part start here -->
						<tr>
							<td><?php echo $srno++; ?></td>
							<td><?php echo $title; ?></td>
							<td><?php echo $description; ?></td>
							<td>₹<?php echo $price; ?></td>

							<td>
								<?php 
									// check the image is available or not
									if($image != ""){
										// display the img
										?>
										
										<img src="<?php echo SITEURL; ?>images/food/<?php echo $image; ?>" width="100px">
										
										<?php 
									} 
									else{
										// display the msg
										echo "<div class = 'error'> Image Not Added. </div>";
									}
								?>
							</td>

							<!-- <td><?php // echo $category_id; ?></td> -->
							<td><?php echo $feature; ?></td>
							<td><?php echo $active; ?></td>
							<td>
								<a href="<?php echo	SITEURL; ?>admin/update-cake.php?id=<?php echo $id; ?>" class="btn-secondary">Update Cake</a><br><br>
								<a href="<?php echo	SITEURL; ?>admin/delete-cake.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="btn-danger">Delete Cake</a>
							</td>
						</tr>
						<!-- html part end herer -->

						<?php
					}
				}
				else{
					// display the msg  inside table data is available or not
					?>

					<tr>
						<td colspan="6"><div class="error"> No Cake Added.</div></td>
					</tr>

					<?php 
				}

			?>

		</table>
	</div>
</div>
<!-- Main Contect Section End -->