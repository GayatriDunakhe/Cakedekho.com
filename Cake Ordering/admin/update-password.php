<?php include('partitals/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Change Password</h1>

		<br><br>

		<?php  
			// get the id of selected admin
			if(isset($_GET['id'])){
				$id = $_GET['id'];
			}
		?>

		<form action="" method="POST">
			
			<table class="tbl-30">
				<tr>
					<td>Current Password: </td>
					<td><input type="password" name="current_pass" placeholder="Your Current Password"></td>
				</tr>

				<tr>
					<td>New Passowrd: </td>
					<td><input type="password" name="new_pass" placeholder="Your New Password"></td>
				</tr>

				<tr>
					<td>Confirm Passowrd: </td>
					<td><input type="password" name="confirm_pass" placeholder="Confirm Password"></td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Change Passowrd" class="btn-secondary">
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
		$current_pass = mysqli_real_escape_string($conn, md5($_POST['current_pass']));
		$new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
		$confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

		// create query for update data base
		$sql = "SELECT * FROM admin WHERE id=$id AND password ='$current_pass' ";

		$res = mysqli_query($conn, $sql);

		if($res == TRUE){
			// check data is present or not
			$count = mysqli_num_rows($res);

			if($count==1){
				//check new password and confim password match or not
				if($new_pass == $confirm_pass){
					$sql2 = "UPDATE admin SET password = '$new_pass' WHERE id=$id";

					$res2 = mysqli_query($conn, $sql);

					if($res2 == TRUE){
						$_SESSION['change-pwd'] = "<div class = 'success'> Password Change Successfully. </div>";

						// redirect the page to manage admin
						header('Location:'.SITEURL.'admin/manage-admin.php');
					}
					else{
						$_SESSION['change-pwd'] = "<div class = 'error'> Failed to Change the Password. </div>";

						// redirect the page to manage admin
						header('Location:'.SITEURL.'admin/manage-admin.php');
					}
				}
				else{
					$_SESSION['pwd-not-match'] = "<div class = 'error'> Password not match. </div>";

					// redirect the page to manage admin
					header('Location:'.SITEURL.'admin/manage-admin.php');
				}
				
			}
			else{
				$_SESSION['user-not-found'] = "<div class = 'error'> User not found. </div>";

				// redirect the page to manage admin
				header('Location:'.SITEURL.'admin/manage-admin.php');
			}
		}
	}
?>