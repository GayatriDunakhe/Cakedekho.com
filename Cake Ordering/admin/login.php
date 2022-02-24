<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<title>Login </title>
</head>
<body>
	<div class="login">
		<h1 class="text-center">Login</h1>

		<br><br>
		<?php 
			// login 
			if(isset($_SESSION['login'])){
				echo $_SESSION['login']; // displaying the session message
				unset($_SESSION['login']); // remove the session message
			}

			if(isset($_SESSION['no-login-mesg'])){
				echo $_SESSION['no-login-mesg']; 
				unset($_SESSION['no-login-mesg']); 
			}
		?>


		<!-- Login form start -->
		<form action="" method="POST" class="text-center">
		<br>Username: 
		<input type="text" name="username" placeholder="Enter username"><br><br>	
		Password: 
		<input type="password" name="password" placeholder="Enter password"><br><br>
		<input type="submit" name="submit" value="Login" class="btn-primary">		
		</form>
		<!-- Login form end -->
	</div>
</body>
</html>

<?php 	
	// check whether the submit button is click or not
	if(isset($_POST['submit'])){
		// get the data from login form
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn,md5($_POST['password']));

		$sql = "SELECT * FROM admin WHERE username= '$username' AND password = '$password'";

		$res = mysqli_query($conn, $sql);

		$count = mysqli_num_rows($res);

		if($count == 1){
			$_SESSION['login'] = "<div class = 'success'> Login Successfully. </div>";

			$_SESSION['user'] = $username; // to check user is logged in or not

			header('Location:'.SITEURL.'admin/');
		}
		else{
			$_SESSION['login'] = "<div class = 'error text-center'> Failed to Login. </div>";
			header('Location:'.SITEURL.'admin/login.php');
		}

	}
?>