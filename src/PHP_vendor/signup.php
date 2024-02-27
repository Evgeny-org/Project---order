<?php
	session_start();
	require_once 'connect.php';

	$login = $_POST['login'];
	$password = $_POST['password'];
	$telegram = $_POST['telegram'];
	$full_name = $_POST['full_name'];
	$telephone = $_POST['telephone'];
	$vk = $_POST['vk'];

	mysqli_query($connect, "INSERT INTO `users` (`id`, `login`, `password`, `telegram`, `full_name`, `telephone`, `vk`, `avatar`) VALUES (NULL, '$login', '$password', '$telegram', '$full_name', '$telephone', '$vk', NULL)");
	$_SESSION['messageReg'] = "$login успешно зарегистрирован(а), пожалуйста, авторизируйтесь! :)";
	header("Location: ../index.php");