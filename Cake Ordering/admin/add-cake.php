<?php include('partitals/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Cake</h1>

		<br>
		<?php 
			if(isset($_SESSION['add'])){
				echo $_SESSION['add']; 
				unset($_SESSION['add']); 
			}

			if(isset($_SESSION['upload'])){
				echo $_SESSION['upload']; 
				unset($_SESSION['upload']); 
			}
		?>

		<br><br>

		<!-- add cake form start  -->

		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td><input type="text" name="title" placeholder="Cake Title"></td>
				</tr>

				<tr>
					<td>Description: </td>
					<td><textarea name="description" cols="30" rows="5" placeholder="Cake Description"></textarea></td>
				</tr>

				<tr>
					<td>Price: </td>
					<td><input type="number" name="price" placeholder="Cake Price"></td>
				</tr>

				<tr>
					<td>Select Image: </td>
					<td><input type="file" name="image"></td>
				</tr>

				<tr>
					<td>Category: </td>
					<td><select name="category">

						<?php  

							// display categories form database
							$sql = "SELECT * FROM categoris WHERE active ='Yes'";
							$res = mysqli_query($conn, $sql);
							$count = mysqli_num_rows($res);
							if ($count > 0) {
								
								while ($row=mysqli_fetch_assoc($res)) {
									// get the details
									$id =$row['id'];
									$title =$row['title'];

									?>

									<option value="<?php echo $id ?>;"><?php echo $title ?></option>

									<?php  
								}
							}
							else{
								?>
								<option value="0">No Category Found</option>
								<?php 
							}
						?>

					</select></td>
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
						<input type="submit" name="submit" value="Add Cake" class="btn-secondary">
					</td>
				</tr>
			</table>

		</form>

		<!-- add cake form end  -->

		<?php 	
			// check whether the submit button is click or not
			if(isset($_POST['submit'])){
				// get the data for form
				$title = mysqli_real_escape_string($conn, $_POST['title']);
				$description = mysqli_real_escape_string($conn, $_POST['description']);
				$price = mysqli_real_escape_string($conn, $_POST['price']);
				$category = mysqli_real_escape_string($conn, $_POST['category']);

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
				if(isset($_FILES['image']['name'])){
					// for uploading image we need img name, source path and destination path
					$image_name = $_FILES['image']['name'];

					if ($image_name != "") {
						// auto rename our image
						// get the extension of our image(jpg, png, gif etc)
						$ext =end(explode('.', $image_name));

						// rename the image
						$image_name = "Cake_Name_".rand(000, 999).'.'.$ext;

						$source_path = $_FILES['image']['tmp_name'];

						$dest_path = "../images/food/".$image_name;

						// uploading image
						$upload = move_uploaded_file($source_path, $dest_path);

						// check image is uploaded or not if not so we will stop this process
						if($upload == false){
							$_SESSION['upload'] = "<div class = 'error'> Failed to Upload Image. </div>";
							header('Location:'.SITEURL.'admin/add-cake.php');
							die();
						}
					}
					
				}
				else{
					// doesn't upload the image and put image_name = ""
					$image_name ="";
				}

				$sql2 = "INSERT INTO cake SET 
					title='$title',
					description = '$description',
					price = '$price',
					image_name = '$image_name',
					category_id = '$category',
					feature='$feature',
					active='$active'
				";

				$res2 = mysqli_query($conn, $sql2);

				if($res2 == TRUE){
					$_SESSION['add'] = "<div class = 'success'> Cake Added Successfully. </div>";
					header('Location:'.SITEURL.'admin/manage-cake.php');
				}
				else{
					$_SESSION['add'] = "<div class = 'error text-center'> Failed to Add Cake. </div>";
					header('Location:'.SITEURL.'admin/add-cake.php');
				}

			}
		?>

	</div>
</div>