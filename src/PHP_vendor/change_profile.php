<?php
	session_start();
	require_once 'connect.php';
	
	$full_name = $_POST['full_name'];
	$telephone = $_POST['telephone'];
	$telegram = $_POST['telegram'];
	$vk = $_POST['vk'];

	$id = $_SESSION['user']['id'];

	$path = 'img/avatars/' . time() . $_FILES['avatar']['name'];
	move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path);

	mysqli_query($connect, "UPDATE `users` SET `full_name` = '$full_name', `telephone` = '$telephone', `telegram` = '$telegram', `vk` = '$vk', `avatar` = '$path' WHERE `users`.`id` = '$id'");

	$_SESSION['user']['full_name'] = $full_name;
	$_SESSION['user']['telephone'] = $telephone;
	$_SESSION['user']['telegram'] = $telegram;
	$_SESSION['user']['vk'] = $vk;
	$_SESSION['user']['avatar'] = $path;

	header("Location: ../profile.php");
?>
