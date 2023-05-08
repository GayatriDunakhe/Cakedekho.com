<?php 	

	include('../config/constants.php');

	// destory the session
	session_destroy(); // unset the $_SESSION['user']

	// redirect to login page
	header('Location:'.SITEURL.'admin/login.php');
?>