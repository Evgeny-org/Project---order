<?php
	session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = $_POST['password'];
$telegram = $_POST['telegram'];
$full_name = $_POST['full_name'];
$telephone = $_POST['telephone'];
$vk = $_POST['vk'];

// Проверка обязательных полей
if (empty($login) || empty($password) || empty($telegram)) {
    $_SESSION['messageRegFalse'] = "Пожалуйста, заполните все обязательные поля.";
} else {
    $identical_logins = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS `logins` FROM `users` WHERE `login` = '$login'"));

    if ($identical_logins['logins'] > 0) {
        $_SESSION['messageRegFalse'] = "Логин: $login уже используется";
    } else {
        mysqli_query($connect, "INSERT INTO `users` (`id`, `login`, `password`, `telegram`, `full_name`, `telephone`, `vk`, `avatar`) VALUES (NULL, '$login', '$password', '$telegram', '$full_name', '$telephone', '$vk', NULL)");
        $_SESSION['messageRegTrue'] = "$login успешно зарегистрирован(а), пожалуйста, авторизируйтесь! :)";
    }
}

header("Location: ../index.php");