<?php include('partitals/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Category</h1>

		<br>
		<?php 
			if (isset($_SESSION['update'])){
			 	echo $_SESSION['update'];
				unset($_SESSION['update']);
			}
		?>

		<br><br>

		<?php  
			// get the id of selected admin
			if (isset($_GET['id'])) {
				$id = $_GET['id'];

				$sql = "SELECT * FROM categoris WHERE id=$id"; 
				$res = mysqli_query($conn, $sql);

				$count = mysqli_num_rows($res);

				if($count == 1){
					$row = mysqli_fetch_assoc($res);

					$title =$row['title'];
					$cu_image = $row['image_name'];
					$feature = $row['feature'];
					$active = $row['active'];
				}
				else{
					$_SESSION['no-category-found'] = "<div class = 'error'> Category Not Found. </div>";
					header('Location:'.SITEURL.'admin/manage-category.php');
				} 

			}
			else{
				header('Location:'.SITEURL.'admin/manage-category.php');
			}

		?>

		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td><input type="text" name="title" value="<?php echo $title; ?>"></td>
				</tr>

				<tr>
					<td>Current Image: </td>
					<td>
						<?php  
							if ($cu_image != "") {
								?>

								<img src="<?php echo SITEURL; ?>images/category/<?php echo $cu_image; ?>" width="100px">
								
								<?php
							}
							else{
								echo "<div class = 'error'> Image is not added. </div>";
							}
						?>
					</td>
				</tr>

				<tr>
					<td>New Image: </td>
					<td><input type="file" name="image"></td>
				</tr>

				<tr>
					<td>Feature: </td>
					<td><input <?php if ($feature == "Yes"){ echo "checked";} ?> type="radio" name="feature" value="Yes"> Yes
						<input <?php if ($feature == "No"){ echo "checked";} ?>  type="radio" name="feature" value="No"> No</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td><input <?php if ($active == "Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
						<input <?php if ($active == "No"){ echo "checked";} ?> type="radio" name="active" value="No"> No</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="cu_image" value="<?php echo $cu_image; ?>">
						<input type="submit" name="submit" value="Update Category" class="btn-secondary">
					</td>
				</tr>
			</table>

		</form>

		<?php 

		if(isset($_POST['submit'])){
		// get all values
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$cu_image = mysqli_real_escape_string($conn, $_POST['cu_image']);
		$feature  = mysqli_real_escape_string($conn, $_POST['feature']);
		$active = mysqli_real_escape_string($conn, $_POST['active']);

		// check the image is uploaded or not
		if (isset($_FILES['image']['name'])) {
			
			$image_name = $_FILES['image']['name'];

			if($image_name != ""){

				// upload new image

				// auto rename our image
				// get the extension of our image(jpg, png, gif etc)
				$ext =end(explode('.', $image_name));

				// rename the image
				$image_name = "Cake_Category_".rand(000, 999).'.'.$ext;

				$source_path = $_FILES['image']['tmp_name'];

				$dest_path = "../images/category/".$image_name;

				// uploading image
				$upload = move_uploaded_file($source_path, $dest_path);

				// check image is uploaded or not if not so we will stop this process
				if($upload == false){
					$_SESSION['upload'] = "<div class = 'error'> Failed to Upload Image. </div>";
					header('Location:'.SITEURL.'admin/manage-category.php');
					die();
				}

				// remove current image
				if($cu_image != ""){
					$remove_path = "../images/category/".$cu_image;
					$remove = unlink($remove_path);

					// check image is remove or not
					if($remove == false){
						$_SESSION['failed-remove'] = "<div class = 'error'> Fail to  remove curretnt data. </div>";
						header('Location:'.SITEURL.'admin/manage-category.php');
						die();
					}

				}
				
			}
			else{
				$image_name =$cu_image;
			}
		}
		else{
			$image_name =$cu_image;
		}

		// create query for update data base
		$sql2 = "UPDATE categoris SET 
		title = '$title',
		image_name = '$image_name',
		feature = '$feature',
		active = '$active'
		WHERE id='$id'
		";

		$res2 = mysqli_query($conn, $sql2);

		if($res2 == TRUE){
			$_SESSION['update'] = "<div class = 'success'> Cateory Update Successfully. </div>";
			header('Location:'.SITEURL.'admin/manage-category.php');
		}
		else{
			$_SESSION['update'] = "<div class = 'error'> Fail to Update. </div>";

			// redirect the page to manage category
			header('Location:'.SITEURL.'admin/update-category.php');
		}
	}

		?>