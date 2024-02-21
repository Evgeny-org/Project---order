<?php 

	$connect = mysqli_connect('localhost', 'root', '', 'Dmitry');

	if (!$connect) {
		die('Error conntect to DataBase');
	}