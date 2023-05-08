<?php include('partitals/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>

		<br>
		<?php 
			if(isset($_SESSION['add'])){
				echo $_SESSION['add']; // displaying the session message
				unset($_SESSION['add']); // remove the session message
			}

			if(isset($_SESSION['upload'])){
				echo $_SESSION['upload']; // displaying the session message
				unset($_SESSION['upload']); // remove the session message
			}
		?>

		<br><br>

		<!-- add category form start  -->

		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td><input type="text" name="title" placeholder="Category Title"></td>
				</tr>

				<tr>
					<td>Select Image: </td>
					<td><input type="file" name="image"></td>
				</tr>

				<tr>
					<td>Feature: </td>
					<td><input type="radio" name="feature" value="Yes"> Yes
						<input type="radio" name="feature" value="No"> No</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td><input type="radio" name="active" value="Yes"> Yes
						<input type="radio" name="active" value="No"> No</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
					</td>
				</tr>
			</table>

		</form>

		<!-- add category form end  -->

		<?php 	
			// check whether the submit button is click or not
			if(isset($_POST['submit'])){
				// get the data from form
				$title = mysqli_real_escape_string($conn, $_POST['title']);

				// feature radio input type we need to check button is selected or not
				if(isset($_POST['feature'])){
					// seting form value
					$feature = mysqli_real_escape_string($conn, $_POST['feature']);

				}
				else{
					// seting default value
					$feature = "No";
				}

				// active radio input type we need to check button is selected or not
				if(isset($_POST['active'])){
					// seting form value
					$active = mysqli_real_escape_string($conn, $_POST['active']);

				}
				else{
					// seting default value
					$active = "No";
				}

				// checking image is selected or not and add name accoridingly
				// print_r($_FILES['image']);
				// die(); // break the code here

				if(isset($_FILES['image']['name'])){
					// upload the image
					// for uploading image we need img name, source path and destination path
					$image_name = $_FILES['image']['name'];

					if ($image_name != "") {
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
							header('Location:'.SITEURL.'admin/add-category.php');
							die();
						}
					}
					
				}
				else{
					// doesn't upload the image and put image_name = ""
					$image_name ="";
				}

				$sql = "INSERT INTO categoris SET 
					title='$title',
					image_name = '$image_name',
					feature='$feature',
					active='$active'
				";

				$res = mysqli_query($conn, $sql);

				if($res == TRUE){
					$_SESSION['add'] = "<div class = 'success'> Cateory Added Successfully. </div>";
					header('Location:'.SITEURL.'admin/manage-category.php');
				}
				else{
					$_SESSION['add'] = "<div class = 'error text-center'> Failed to Add Cateory. </div>";
					header('Location:'.SITEURL.'admin/add-category.php');
				}

			}
		?>

	</div>
</div>