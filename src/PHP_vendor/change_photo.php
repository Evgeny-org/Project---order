<?php
	session_start();
	require_once 'connect.php';

	$id = $_POST['photo_id'];

	$photo = mysqli_query($connect, "SELECT `one`, `two`, `three`, `four`, `five`, `six`, `seven`, `eight`, `nine`, `ten` FROM `orders` JOIN `photos` ON `orders`.`photos` = `photos`.`id` WHERE `photos`.`id` = '$id'");
	$photo_col = mysqli_fetch_assoc($photo);

	$delPhoto_1 = $_POST['delPhoto_' . strval($id)];
	// переменные для выводы выбранного и не выбранного фото
	if ($delPhoto_1 == 'true') {
		if (!empty($_FILES['photo1']['name'])) {
		    // Если файл выбран, сохраняем его на сервер
		    $path_one = 'img/photos/' . time() . $_FILES['photo1']['name'];
		    move_uploaded_file($_FILES['photo1']['tmp_name'], '../' . $path_one);
		} else {
		    // Если файл не выбран, устанавливаем путь к изображению по умолчанию
		    $path_one = $photo_col['one'];
		}
	} elseif ($delPhoto_1 == 'false') {
		 $path_one = '';
	}

	$delPhoto_2 = $_POST['delPhoto_' . strval($id) . '1'];
	if ($delPhoto_2 == 'true') {
		if (!empty($_FILES['photo2']['name'])) {
		    $path_two = 'img/photos/' . time() . $_FILES['photo2']['name'];
			move_uploaded_file($_FILES['photo2']['tmp_name'], '../' . $path_two);
		} else {
		    $path_two = $photo_col['two'];
		}
	} elseif ($delPhoto_2 == 'false') {
		 $path_two = '';
	}

	$delPhoto_3 = $_POST['delPhoto_' . strval($id) . '2'];
	if ($delPhoto_3 == 'true') {
		if (!empty($_FILES['photo3']['name'])) {
		    // Если файл выбран, сохраняем его на сервер
		    $path_three = 'img/photos/' . time() . $_FILES['photo3']['name'];
			move_uploaded_file($_FILES['photo3']['tmp_name'], '../' . $path_three);
		} else {
		    $path_three = $photo_col['three'];
		}
	} elseif ($delPhoto_3 == 'false') {
		 $path_three = '';
	}

	$delPhoto_4 = $_POST['delPhoto_' . strval($id) . '3'];
	if ($delPhoto_4 == 'true') {
		if (!empty($_FILES['photo4']['name'])) {
		    $path_four = 'img/photos/' . time() . $_FILES['photo4']['name'];
			move_uploaded_file($_FILES['photo4']['tmp_name'], '../' . $path_four);
		} else {
		    $path_four = $photo_col['four'];
		}
	} elseif ($delPhoto_4 == 'false') {
		 $path_four = '';
	}

	$delPhoto_5 = $_POST['delPhoto_' . strval($id) . '4'];
	if ($delPhoto_5 == 'true') {
		if (!empty($_FILES['photo5']['name'])) {
		    $path_five = 'img/photos/' . time() . $_FILES['photo5']['name'];
			move_uploaded_file($_FILES['photo5']['tmp_name'], '../' . $path_five);
		} else {
		    $path_five = $photo_col['five'];
		}
	} elseif ($delPhoto_5 == 'false') {
		 $path_five = '';
	}

	$delPhoto_6 = $_POST['delPhoto_' . strval($id) . '5'];
	if ($delPhoto_6 == 'true') {
		if (!empty($_FILES['photo6']['name'])) {
		    $path_six = 'img/photos/' . time() . $_FILES['photo6']['name'];
			move_uploaded_file($_FILES['photo6']['tmp_name'], '../' . $path_six);
		} else {
		    $path_six = $photo_col['six'];
		}
	} elseif ($delPhoto_6 == 'false') {
		 $path_six = '';
	}

	$delPhoto_7 = $_POST['delPhoto_' . strval($id) . '6'];
	if ($delPhoto_7 == 'true') {
		if (!empty($_FILES['photo7']['name'])) {
		    $path_seven = 'img/photos/' . time() . $_FILES['photo7']['name'];
			move_uploaded_file($_FILES['photo7']['tmp_name'], '../' . $path_seven);
		} else {
		    $path_seven = $photo_col['seven'];
		}
	} elseif ($delPhoto_7 == 'false') {
		 $path_seven = '';
	}

	$delPhoto_8 = $_POST['delPhoto_' . strval($id) . '7'];
	if ($delPhoto_8 == 'true') {
		if (!empty($_FILES['photo8']['name'])) {
		   $path_eight = 'img/photos/' . time() . $_FILES['photo8']['name'];
			move_uploaded_file($_FILES['photo8']['tmp_name'], '../' . $path_eight);
		} else {
		    $path_eight = $photo_col['eight'];
		}
	} elseif ($delPhoto_8 == 'false') {
		 $path_eight = '';
	}

	$delPhoto_9 = $_POST['delPhoto_' . strval($id) . '8'];
	if ($delPhoto_9 == 'true') {
		if (!empty($_FILES['photo9']['name'])) {
		    $path_nine = 'img/photos/' . time() . $_FILES['photo9']['name'];
			move_uploaded_file($_FILES['photo9']['tmp_name'], '../' . $path_nine);
		} else {
		    $path_nine = $photo_col['nine'];
		}
	} elseif ($delPhoto_9 == 'false') {
		 $path_nine = '';
	}

	$delPhoto_10 = $_POST['delPhoto_' . strval($id) . '9'];
	if ($delPhoto_10 == 'true') {
		if (!empty($_FILES['photo10']['name'])) {
		    $path_ten = 'img/photos/' . time() . $_FILES['photo10']['name'];
			move_uploaded_file($_FILES['photo10']['tmp_name'], '../' . $path_ten);
		} else {
		    $path_ten = $photo_col['ten'];
		}
	} elseif ($delPhoto_10 == 'false') {
		 $path_ten = '';
	}

	mysqli_query($connect, "UPDATE `photos` SET `one` = '$path_one', `two` = '$path_two',  `three` = '$path_three', `four` = '$path_four',  `five` = '$path_five', `six` = '$path_six',  `seven` = '$path_seven', `eight` = '$path_eight',  `nine` = '$path_nine', `ten` = '$path_ten' WHERE `photos`.`id` = $id");

	header("Location: ../admin.php");
?>