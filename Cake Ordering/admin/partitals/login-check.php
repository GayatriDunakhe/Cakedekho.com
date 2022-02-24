<?php 
	
	// authorization - access control
	// to check user is logged in or not
	if(!isset($_SESSION['user'])) // if user session is not set
	{
		$_SESSION['no-login-mesg'] = "<div class = 'error text-center'> Please Login to access the Admin Panel. </div>";
		header('Location:'.SITEURL.'admin/login.php');
	}
?>