<?php include('partitals/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Admin</h1>

		<br><br>

		<?php  
			// get the id of selected admin
			$id = $_GET['id'];

			// create sql query to get the details
			$sql = "SELECT * FROM admin WHERE id=$id";

			$res = mysqli_query($conn, $sql);

			if($res == TRUE){
				$count = mysqli_num_rows($res);

				if($count == 1){
					$row = mysqli_fetch_assoc($res);

					$full_name =$row['full_name'];
					$username = $row['username'];
				}
				else{
					header('Location:'.SITEURL.'admin/manage-admin.php');
				}
			}
		?>

		<form action="" method="POST">
			
			<table class="tbl-30">
				<tr>
					<td>Full Name: </td>
					<td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
				</tr>

				<tr>
					<td>Username: </td>
					<td><input type="text" name="username" value="<?php echo $username; ?>"></td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
					</td>
				</tr>
			</table>

		</form>

	</div>
</div>

<?php  
	// check submit button is clicked or not
	if(isset($_POST['submit'])){
		// get all values
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);

		// create query for update data base
		$sql = "UPDATE admin SET 
		full_name = '$full_name',
		username = '$username'
		WHERE id='$id'";

		$res = mysqli_query($conn, $sql);

		if($res == TRUE){
			$_SESSION['update'] = "<div class = 'success'> Admin Updated Successfully. </div>";

			// redirect the page to manage admin
			header('Location:'.SITEURL.'admin/manage-admin.php');
		}
		else{
			$_SESSION['update'] = "<div class = 'error'> Fail to Update. </div>";

			// redirect the page to manage admin
			header('Location:'.SITEURL.'admin/update-admin.php');
		}
	}
?>