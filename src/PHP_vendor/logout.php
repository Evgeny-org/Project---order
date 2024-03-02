<?php
	session_start();
	if ($_SESSION['user']) {
		unset($_SESSION['user']);
	} elseif ($_SESSION['admin']) {
		unset($_SESSION['admin']);
	}
	
	header('Location: ../index.php');
?>