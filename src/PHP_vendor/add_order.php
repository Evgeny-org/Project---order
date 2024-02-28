<?php
	session_start();
	require_once 'connect.php';

	// $id = $_SESSION['user']['id'];
	$id = // крч отсюда начинай как придёшь, яхочу вывести id orders, чтобы знать, правильно ли я иду в my_orders.php
	$user = $_SESSION['user']['id'];
	$excel = '../Example.xlsx';
	$state = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `name` FROM `state` LIMIT 1"));

	// echo $user;
	// echo $state['name'];
	// echo $user;

	$_SESSION['order'] = [
			"id" => 
			"user" => $user,
			"excel" => $excel,
			"state" => $state["name"]
		];

	mysqli_query($connect, "INSERT INTO `orders` (`id`, `user`, `excel`, `state`, `photos`) VALUES (NULL, '$user', '$excel', '".$state["name"]."', NULL)");
	header("Location: ../my_orders.php");
?>