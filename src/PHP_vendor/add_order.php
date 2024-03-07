<?php
	session_start();
	require_once 'connect.php';

	$user = $_SESSION['user']['id'];
	$excel = './excels/Example.xlsx';
	$state = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `name` FROM `state` LIMIT 1"));

	mysqli_query($connect, "INSERT INTO `photos` (`id`, `one`, `two`, `three`, `four`, `five`, `six`, `seven`, `eight`, `nine`, `ten`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)");

	$newId = mysqli_insert_id($connect);

	mysqli_query($connect, "INSERT INTO `orders` (`id`, `user`, `excel`, `state`, `photos`) VALUES (NULL, '$user', '$excel', '".$state["name"]."', '$newId')");

	header("Location: ../my_orders.php");
?>