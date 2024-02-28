<?php
	session_start();
	require_once 'connect.php';

	$user = $_SESSION['user']['id'];
	$excel = '../Example.xlsx';
	$state = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `name` FROM `state` LIMIT 1"));

	mysqli_query($connect, "INSERT INTO `orders` (`id`, `user`, `excel`, `state`, `photos`) VALUES (NULL, '$user', '$excel', '".$state["name"]."', NULL)");

	$id = mysqli_insert_id($connect);

	// $_SESSION['order'] = [
	// 		"id" => $id,
	// 		"user" => $user,
	// 		"excel" => $excel,
	// 		"state" => $state["name"]
	// 	];

	
	header("Location: ../my_orders.php");
?>