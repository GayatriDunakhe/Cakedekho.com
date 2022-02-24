<?php include('partitals/menu.php'); ?>

<?php  
	// get the id of selected or not
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql2 = "SELECT * FROM cake WHERE id=$id";
		$res2 = mysqli_query($conn, $sql2);

		$row2 = mysqli_fetch_assoc($res2);

		$title =$row2['title'];
		$description = $row2['description'];
		$price = $row2['price'];
		$cu_image = $row2['image_name'];
		$cu_category_id = $row2['category_id'];
		$feature = $row2['feature'];
		$active = $row2['active'];

	}
	else{
		header('Location:'.SITEURL.'admin/manage-cake.php');
	}

?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Cake</h1>

		<br><br>
		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td><input type="text" name="title" value="<?php echo $title; ?>"></td>
				</tr>

				<tr>
					<td>Description: </td>
					<td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
				</tr>

				<tr>
					<td>Price: </td>
					<td><input type="number" name="price" value="<?php echo $price; ?>"></td>
				</tr>

				<tr>
					<td>Current Image: </td>
					<td>
						<?php  
							if ($cu_image == "") {
								echo "<div class = 'error'> Image is not added. </div>";
							}
							else{
								?>
								<img src="<?php echo SITEURL; ?>images/food/<?php echo $cu_image; ?>" width="100px">
								<?php
								
							}
						?>
					</td>
				</tr>

				<tr>
					<td>New Image: </td>
					<td><input type="file" name="image"></td>
				</tr>

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">
							<?php  

								// display categories form database
								$sql = "SELECT * FROM categoris WHERE active ='Yes'";
								$res = mysqli_query($conn, $sql);
								$count = mysqli_num_rows($res);
								// category is available or not
								if ($count > 0) {

									while ($row=mysqli_fetch_assoc($res)) {
										// get the details
										$category_id =$row['id'];
										$category_title =$row['title'];

										// echo "<option value='$category_id'>$category_title</option>";
										?>
											<option <?php if ($cu_category_id == $category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title;?>
											</option>
										
										<?php
									}

								}
								else{
									echo "<option value='0'>No Category Found</option>";
								}
							?>
						</select>
					</td>
				</tr>

				<tr>
					<td>Feature: </td>
					<td>
						<input <?php if ($feature == "Yes"){ echo "checked";} ?> type="radio" name="feature" value="Yes"> Yes
						<input <?php if ($feature == "No"){ echo "checked";} ?> type="radio" name="feature" value="No"> No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input <?php if ($active == "Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
						<input <?php if ($active == "No"){ echo "checked";} ?> type="radio" name="active" value="No"> No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="cu_image" value="<?php echo $cu_image; ?>">

						<input type="submit" name="submit" value="Update Cake" class="btn-secondary">
					</td>
				</tr>

			</table>
		</form>	

		<?php  
			// chekc button is click or not
			if(isset($_POST['submit'])){
				// get all details from form
				$id = mysqli_real_escape_string($conn, $_POST['id']);
				$title = mysqli_real_escape_string($conn, $_POST['title']);
				$description = mysqli_real_escape_string($conn, $_POST['description']);
				$price = mysqli_real_escape_string($conn, $_POST['price']);
				$cu_image = mysqli_real_escape_string($conn, $_POST['cu_image']);
				$category = mysqli_real_escape_string($conn, $_POST['category']);
				$feature  = mysqli_real_escape_string($conn, $_POST['feature']);
				$active = mysqli_real_escape_string($conn, $_POST['active']);

				// upload the image
				// button is clicked or not
				if (isset($_FILES['image']['name'])){

					$image_name = $_FILES['image']['name']; // new image name

					if($image_name != ""){
						// auto rename our image
						// get the extension of our image(jpg, png, gif etc)
						$ext =end(explode('.', $image_name));

						// rename the image
						$image_name = "Cake_Category_".rand(000, 999).'.'.$ext;

						// get source and destination path
						$source_path = $_FILES['image']['tmp_name'];
						$dest_path = "../images/food/".$image_name;

						// uploading image
						$upload = move_uploaded_file($source_path, $dest_path);

						// check image is uploaded or not
						if($upload == false){
							$_SESSION['upload'] = "<div class = 'error'> Failed to Upload Image. </div>";
							header('Location:'.SITEURL.'admin/manage-cake.php');
							die();
						}

						// remove the image if new image is uploaded
						// remove current image
						if($cu_image != ""){
							$remove_path = "../images/food/".$cu_image;
							$remove = unlink($remove_path);

							// check image is remove or not
							if($remove == false){
								$_SESSION['failed-remove'] = "<div class = 'error'> Fail to  remove curretnt data. </div>";
								header('Location:'.SITEURL.'admin/manage-cake.php');
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

				//	update the cake database
				// create query for update data base
				$sql3 = "UPDATE cake SET 
				title='$title',
				description = '$description',
				price = $price,
				image_name = '$image_name',
				category_id = '$category',
				feature='$feature',
				active='$active'
				WHERE id='$id'
				";

				$res3 = mysqli_query($conn, $sql3);

				if($res3 == TRUE){
					$_SESSION['update'] = "<div class = 'success'> Cake Update Successfully. </div>";
					header('Location:'.SITEURL.'admin/manage-cake.php');
				}
				else{
					$_SESSION['update'] = "<div class = 'error'> Fail to Update. </div>";

					// redirect the page to manage category
					header('Location:'.SITEURL.'admin/update-cake.php');
				}
			}
		?>

	</div>
</div>