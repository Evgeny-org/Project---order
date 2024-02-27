<?php
	session_start();
	require_once 'connect.php';
	
	// $full_name = $_POST['full_name'];
	// $telephone = $_POST['telephone'];
	// $telegram = $_POST['telegram'];
	// $vk = $_POST['vk'];

	// $id = $_SESSION['user']['id'];

	// // $_SESSION['messageReg'] = "$login успешно зарегистрирован(а), пожалуйста, авторизируйтесь! :)";

	// mysqli_query($connect, "UPDATE `users` SET `full_name` = '$full_name', `telephone` = '$telephone', `telegram` = '$telegram', `vk` = '$vk' WHERE `users`.`id` = '$id'");

	// $_SESSION['user']['full_name'] = $full_name;
	// $_SESSION['user']['telephone'] = $telephone;
	// $_SESSION['user']['telegram'] = $telegram;
	// $_SESSION['user']['vk'] = $vk;

	// header("Location: ../profile.php");
?>

<pre>
	<?php
		print_r($_FILES);
		print_r($_SESSION);
	?>
</pre>