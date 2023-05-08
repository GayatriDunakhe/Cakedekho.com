<?php 	
	// include constant file
	include('../config/constants.php');

	// check the id and image name value is set or not
	if (isset($_GET['id']) AND isset($_GET['image_name'])) {
		$id = $_GET['id'];
		$image = $_GET['image_name'];

		// remore physical image file if available
		if($image != ""){
			$path = "../images/category/".$image;
			$remove = unlink($path);

			if($remove == false){
				$_SESSION['remove'] = "<div class = 'error'> Failed to Remove. </div>";
				header('Location:'.SITEURL.'admin/manage-category.php');
				die();
			}
		}

		$sql = "DELETE FROM categoris WHERE id= $id";
		$res = mysqli_query($conn, $sql);

		if ($res == true) {
			$_SESSION['delete'] = "<div class = 'success'> Deleted Successfully. </div>";
			header('Location:'.SITEURL.'admin/manage-category.php');	
		}
		else{
			$_SESSION['delete'] = "<div class = 'error'> Failed to Delete. </div>";
			header('Location:'.SITEURL.'admin/manage-category.php');
		}
	}
	else{
		header('Location:'.SITEURL.'admin/manage-category.php');
	}
?>