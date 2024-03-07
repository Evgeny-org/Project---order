<?php
	session_start();
	require_once 'connect.php';

	$id = $_POST['photo_id'];

	$path_one = 'img/photos/' . time() . $_FILES['photo']['name'];
	move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path_one);



	// $_SESSION['photos'] = [
	// 	"photo" => $path_one,
	// ];

	// mysqli_query($connect, "UPDATE `photos` SET `one` = '$path_one' WHERE `photos`.`id` = $id");
	// header("Location: ../admin.php");
?>

<pre>
	<?php 
		print_r($_FILES);
	 ?>
</pre>