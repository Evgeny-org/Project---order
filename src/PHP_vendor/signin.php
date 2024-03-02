<?php
	session_start();
	require_once 'connect.php';

	$login = $_POST['login'];
	$password = $_POST['password'];

	if ($login == 'admin' && $password = '123') {
		$check_admin = mysqli_query($connect, "SELECT * FROM `admins` WHERE `login` = '$login' AND `password` = '$password'");

		if (mysqli_num_rows($check_admin) > 0) {
			$admin = mysqli_fetch_assoc($check_admin);

			$_SESSION['admin'] = [
				"id" => $admin['id'],
				"login" => $admin['login']
			];
			header('Location: ../admin.php');
		}
	} else {
		$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

		if (mysqli_num_rows($check_user) > 0) {
			$user = mysqli_fetch_assoc($check_user);

			$_SESSION['user'] = [
				"id" => $user['id'],
				"login" => $user['login'],
				"full_name" => $user['full_name'],
				"telephone" => $user['telephone'],
				"telegram" => $user['telegram'],
				"vk" => $user['vk'],
				"avatar" => $user['avatar']
			];

			header('Location: ../profile.php');
		} else {
			// тут должен быть код, который перенаправляет в header.php и октрывает модальное окно
			// header("Location: ../index.php#myModal");
			$_SESSION['messageAuth'] = 'Ошибка авторизации, неправильный логин или пароль.';
			header("Location: ../index.php");
		}
	}