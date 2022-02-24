<?php 
	include('../config/constants.php');
	include('login-check.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="images/logo.png">
	<title>Admin Panle - Cake Ordering</title>

	<!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	<!-- Menu Section Start -->
	<div class="menu text-center">
		<div class="wrapper">
			<ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Categories</a></li>
                <li><a href="manage-cake.php">Cake</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
		</div>
	</div>
	<!-- Menu Section End -->