<?php 
	// inculde constants 
	include('../config/constants.php');

	// get the id of admin to be delete
	$id = $_GET['id'];

	//create sql query to delete admin
	$sql = "DELETE FROM admin WHERE id=$id";

	$res = mysqli_query($conn, $sql);

	if($res == TRUE){
		// session varaible for message
		$_SESSION['delete'] = "<div class = 'success'> Admin Deleted Successfully. </div>";

		// redirect the page to add admin
		header('Location:'.SITEURL.'admin/manage-admin.php');
	}
	else{
		// session varaible for message
		$_SESSION['delete'] = "<div class = 'error'> Failed to Delete Admin. </div>";

		// redirect the page to add admin
		header('Location:'.SITEURL.'admin/manage-admin.php');
	}


	//redirect to manage admin page with message	
?>