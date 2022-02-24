<?php include('partitals/menu.php'); ?>

<!-- Main Content Section Start -->
<div class="main-content">
	<div class="wrapper">
		<h1>Manage Category</h1>

		<br>
		<?php 
			if(isset($_SESSION['add'])){
				echo $_SESSION['add']; 
				unset($_SESSION['add']); 
			}

			if(isset($_SESSION['remove'])){
				echo $_SESSION['remove']; 
				unset($_SESSION['remove']); 
			}

			if(isset($_SESSION['delete'])){
				echo $_SESSION['delete']; 
				unset($_SESSION['delete']); 
			}

			if (isset($_SESSION['no-category-found'])){
			 	echo $_SESSION['no-category-found'];
				unset($_SESSION['no-category-found']);
			}

			if (isset($_SESSION['update'])){
			 	echo $_SESSION['update'];
				unset($_SESSION['update']);
			}

			if (isset($_SESSION['upload'])){
			 	echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}

			if (isset($_SESSION['failed-remove'])){
			 	echo $_SESSION['failed-remove'];
				unset($_SESSION['failed-remove']);
			}

		?>

		<br><br>
		<!-- Button to add admin -->
		<a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Categorys</a>


		<br><br><br>
		<table class="tbl-full">
			<tr>
				<th>Sr.No.</th>
				<th>Title</th>
				<th>Image</th>
				<th>Feature</th>
				<th>Active</th>
				<th>Actions</th>
			</tr>

			<?php 	

				// query to get all admin data
				$sql = "SELECT * FROM categoris";

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
						$image = $rows['image_name'];
						$feature = $rows['feature'];
						$active = $rows['active'];

						// display that all values
						?>

						<!-- html part start here -->
						<tr>
							<td><?php echo $srno++; ?></td>
							<td><?php echo $title; ?></td>

							<td>
								<?php 
									// check the image is available or not
									if($image != ""){
										// display the img
										?>
										
										<img src="<?php echo SITEURL; ?>images/category/<?php echo $image; ?>" width="100px">
										
										<?php 
									} 
									else{
										// display the msg
										echo "<div class = 'error'> Image Not Added. </div>";
									}
								?>
							</td>

							<td><?php echo $feature; ?></td>
							<td><?php echo $active; ?></td>
							<td>
								<a href="<?php echo	SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
								<a href="<?php echo	SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="btn-danger">Delete Category</a>
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
						<td colspan="6"><div class="error"> No Category Added.</div></td>
					</tr>

					<?php 
				}

			?>


		</table>
	</div>
</div>
<!-- Main Contect Section End -->