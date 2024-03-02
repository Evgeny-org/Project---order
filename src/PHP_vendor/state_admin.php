<?php
	session_start();
	require_once 'connect.php';

	$state = $_POST['select'];
	$state_id = $_POST['state_id'];

	mysqli_query($connect, "UPDATE `orders` SET `state` = '$state' WHERE `orders`.`id` = '$state_id'");

	header("Location: ../admin.php");
?>