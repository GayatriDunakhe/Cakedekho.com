<?php include('partitals/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1>

		<br>
		<?php 
			if(isset($_SESSION['add'])){
				echo $_SESSION['add']; // displaying the session message
				unset($_SESSION['add']); // remove the session message
			}
		?>

		<br><br>

		<form action="" method="POST">
			
			<table class="tbl-30">
				<tr>
					<td>Full Name: </td>
					<td><input type="text" name="full_name" placeholder="Enter you name"></td>
				</tr>

				<tr>
					<td>Username: </td>
					<td><input type="text" name="username" placeholder="Enter username"></td>
				</tr>

				<tr>
					<td>Password: </td>
					<td><input type="password" name="password" placeholder="Enter password"></td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>
			</table>

		</form>

	</div>
</div>

<?php  
	// process the value form the Form and save it in database
	// check whether the submit button is clicked or not

	if (isset($_POST['submit'])) {
		// get data from form

		$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
		$uname = mysqli_real_escape_string($conn, $_POST['username']);
		$pass = mysqli_real_escape_string($conn, md5($_POST['password'])); // password encryption with md5

		// sql query for saving data into database
		$sql = "INSERT INTO admin SET
					full_name = '$full_name',
					username = '$uname',
					password = '$pass'
		";

		// executing query and saving data into database
		$res = mysqli_query($conn, $sql) or die(mysqli_error());

		// check whether the query is executed data is inserted or not and display appropriate message
		if($res == TRUE)
		{
			// data inserted successfully

			// create a session variable to display message
			$_SESSION['add'] = "<div class = 'success'> Admin Added Successfully. </div>"; 

			// redirect the page to manage admin
			header('Location:'.SITEURL.'admin/manage-admin.php');
		}
		else{
			// data fail to insert

			// create a session variable to display message
			$_SESSION['add'] = "<div class = 'error'> Fail to Add Admin. </div>"; 

			// redirect the page to add admin
			header('Location:'.SITEURL.'admin/add-admin.php');
		}
	}
?>