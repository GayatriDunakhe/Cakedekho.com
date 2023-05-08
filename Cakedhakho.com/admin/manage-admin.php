<?php include('partitals/menu.php'); ?>

<!-- Main Content Section Start -->
<div class="main-content">
	<div class="wrapper">
		<h1>Manage Admin</h1>

		<br>
		<?php 
			// adding 
			if(isset($_SESSION['add'])){
				echo $_SESSION['add']; // displaying the session message
				unset($_SESSION['add']); // remove the session message
			}

			// deleting
			if(isset($_SESSION['delete'])){
				echo $_SESSION['delete']; // displaying the session message
				unset($_SESSION['delete']); // remove the session message
			}

			// updating
			if(isset($_SESSION['update'])){
				echo $_SESSION['update']; // displaying the session message
				unset($_SESSION['update']); // remove the session message
			}

			// finding user
			if(isset($_SESSION['user-not-found'])){
				echo $_SESSION['user-not-found']; // displaying the session message
				unset($_SESSION['user-not-found']); // remove the session message
			}

			// password matching
			if(isset($_SESSION['pwd-not-match'])){
				echo $_SESSION['pwd-not-match']; // displaying the session message
				unset($_SESSION['pwd-not-match']); // remove the session message 
			}

			// password changing
			if(isset($_SESSION['change-pwd'])){
				echo $_SESSION['change-pwd']; // displaying the session message
				unset($_SESSION['change-pwd']); // remove the session message 
			}
		?>

		<br><br>

		<!-- Button to add admin -->
		<a href="add-admin.php" class="btn-primary">Add Admin</a>


		<br><br><br>
		<table class="tbl-full">
			<tr>
				<th>Sr.No.</th>
				<th>Name</th>
				<th>Username</th>
				<th>Actions</th>
			</tr>

			<?php  
				// query to get all admin data
				$sql = "SELECT * FROM admin";

				// execute the query
				$res = mysqli_query($conn, $sql);

				// check the query is executed or not
				if($res == TRUE){
					// count rows to check data in database or not
					$count = mysqli_num_rows($res);

					$srno = 1;

					// check the number of rows
					if($count > 0){
						// data is present in database

						while($rows = mysqli_fetch_assoc($res)){
							// by using this we get all data form database


							// get values from database
							$id = $rows['id'];
							$full_name = $rows['full_name'];
							$username = $rows['username'];

							// display that all values
							?>

								<!-- html part start here -->
								<tr>
									<td><?php echo $srno++; ?></td>
									<td><?php echo $full_name; ?></td>
									<td><?php echo $username; ?></td>
									<td>
										<a href="<?php echo	SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
										<a href="<?php echo	SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
										<a href="<?php echo	SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
									</td>
								</tr>
								<!-- html part end herer -->

							<?php 
						}
					}
					else{
						// data is not present in database
					}
				}

			?>

		</table>

	</div>
</div>
<!-- Main Contect Section End -->