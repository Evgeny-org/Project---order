<?php
	session_start();
	require_once 'connect.php';

	$user = $_SESSION['user']['id'];
	$excel = './excels/Example.xlsx';
	$state = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `name` FROM `state` LIMIT 1"));

	mysqli_query($connect, "INSERT INTO `orders` (`id`, `user`, `excel`, `state`, `photos`) VALUES (NULL, '$user', '$excel', '".$state["name"]."', NULL)");

	header("Location: ../my_orders.php");
?>