<?php
	session_start();
	require_once 'connect.php';

	$order_id = $_POST['order_id'];

	$path = 'excels/' . time() . $_FILES['excel']['name'];
	move_uploaded_file($_FILES['excel']['tmp_name'], '../' . $path);

	mysqli_query($connect, "UPDATE `orders` SET `excel` = '$path' WHERE `orders`.`id` = '$order_id'");

	header("Location: ../my_orders.php");
?>