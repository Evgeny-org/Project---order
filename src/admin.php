<?php
	// ini_set('display_errors', 0);
	// ini_set('display_startup_errors', 0);
	// error_reporting(E_ALL);

	session_start();
	if(!$_SESSION['admin']){
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="CSS/style.css">
	<link href="./output.css" rel="stylesheet">
</head>
<body class="h-full font-TNRR">
	<div class="min-h-full flex flex-col">

		<header class="w-screen h-[75px] bg-[#D9D9D9] mb-[100px] px-10">
			<div class="max-w-[1600px] h-full mx-auto">
				<div class="h-full flex items-center justify-end">
					<div class="flex justify-end items-center text-2xl">
						<a href="./PHP_vendor/logout.php" class="text-[#007bff] cursor-pointer p-0 focus:outline-0 hover:underline">Выход</a>
					</div>
				</div>
			</div>
		</header>
		<main class="flex-auto px-10 tracking-widest mb-[125px]">
			<div class="max-w-[1920px] mx-auto">
				<div class="w-[80%] mx-auto flex flex-col">

					<h1 class="font-TNRB text-5xl mb-[50px]">Приветствую, Администратор!</h1>
					<hr class="border-black">

					<?php
						$connect = mysqli_connect('localhost', 'root', '', 'Dmitry');

						$result = mysqli_query($connect, "SELECT * FROM `orders`");
						$counter = 0;

						while ($row = mysqli_fetch_assoc($result)) {
							$counter++;
							?>
								<div class="flex items-center py-8 text-3xl">

									<!-- № заказа -->
										<p class="block w-[150px] mr-10">Заказ №<?= $counter ?></p>

									<!-- Вывод Excel-файла -->
										<div class="w-[200px] flex mr-10 relative" action="./PHP_vendor/upload_file.php" method="post" enctype="multipart/form-data">
											<a class="overflow-hidden text-[#4CAF50] hover:text-[#2E7D32] hover:underline transition:" href="<?= $row['excel'] ?>">
												<?php 
													if ($row['excel'] != './excels/Example.xlsx') {
														echo substr(basename($row['excel']), 10);
													} else {
														echo basename($row['excel']);
													}
												?>
											</a>
										</div>

									<!-- Форма состояния заказа -->
										<form id="form_<?=$row['id']?>" class="mr-10" action="./PHP_vendor/state_admin.php" method="post">
											<input type="hidden" name="state_id" id="state_id" value="<?=$row['id']?>">
											<?php
												if ($row['state'] == 'Не подтверждён') {
												// echo
													// 		'<p class="text-[#FF0000]">
													// 			<select class="" id="select_'.$row['id'].'" name="select" size="1">
													// 				<option class="text-[#FF0000] hidden" selected value="'.$row['id'].'">' . $row['state'] . '</option>
													// 				<option class="text-[#FF5C00]" value="Подтверждён">Подтверждён</option>
													// 				<option class="text-[#FFB800]" value="Куплен">Куплен</option>
													// 				<option class="text-[#00FF1A]" value="Отправлен">Отправлен</option>
													// 				<option class="text-[#8FFF00]" value="Получен">Получен</option>
													// 			</select>
													// 		</p>';
													// 	} elseif ($row['state'] == 'Подтверждён'){
													// 		echo
													// 			'<p class="text-[#FF5C00]">
													// 				<select id="select_'.$row['id'].'" name="select" size="1">
													// 					<option class="text-[#FF5C00] hidden" selected value="'.$row['id'].'">' . $row['state'] . '</option>
													// 					<option class="text-[#FF0000]" value="Не подтверждён">Не подтверждён</option>
													// 					<option class="text-[#FFB800]" value="Куплен">Куплен</option>
													// 					<option class="text-[#00FF1A]" value="Отправлен">Отправлен</option>
													// 					<option class="text-[#8FFF00]" value="Получен">Получен</option>
													// 				</select>
													// 			</p>';
													// 	} elseif ($row['state'] == 'Куплен'){
													// 		echo
													// 			'<p class="text-[#FFB800]">
													// 				<select id="select_'.$row['id'].'" name="select" size="1">
													// 					<option class="text-[#FFB800] hidden" selected value="'.$row['id'].'">' . $row['state'] . '</option>
													// 					<option class="text-[#FF0000]" value="Не подтверждён">Не подтверждён</option>
													// 					<option class="text-[#FF5C00]" value="Подтверждён">Подтверждён</option>
													// 					<option class="text-[#00FF1A]" value="Отправлен">Отправлен</option>
													// 					<option class="text-[#8FFF00]" value="Получен">Получен</option>
													// 				</select>
													// 			</p>';
													// 	} elseif ($row['state'] == 'Отправлен'){
													// 		echo
													// 			'<p class="text-[#00FF1A]">
													// 				<select id="select_'.$row['id'].'" name="select" size="1">
													// 					<option class="text-[#00FF1A] hidden" selected value="'.$row['id'].'">' . $row['state'] . '</option>
													// 					<option class="text-[#FF0000]" value="Не подтверждён">Не подтверждён</option>
													// 					<option class="text-[#FF5C00]" value="Подтверждён">Подтверждён</option>
													// 					<option class="text-[#FFB800]" value="Куплен">Куплен</option>
													// 					<option class="text-[#8FFF00]" value="Получен">Получен</option>
													// 				</select>
													// 			</p>';
													// 	} elseif ($row['state'] == 'Получен'){
													// 		echo
													// 			'<p class="text-[#8FFF00]">
													// 				<select id="select_'.$row['id'].'" name="select" size="1">
													// 					<option class="text-[#8FFF00] hidden" selected value="'.$row['id'].'">' . $row['state'] . '</option>
													// 					<option class="text-[#FF0000]" value="Не подтверждён">Не подтверждён</option>
													// 					<option class="text-[#FF5C00]" value="Подтверждён">Подтверждён</option>
													// 					<option class="text-[#FFB800]" value="Куплен">Куплен</option>
													// 					<option class="text-[#00FF1A]" value="Отправлен">Отправлен</option>
													// 				</select>
													// 			</p>';
													// 	}
												echo
														'<input class="hidden" type="text" name="myVar" id="myVar_'.$row['id'].'" />
														<div class="__select" data-state="">
															<div class="__select__title text-[#FF0000]" data-default="Не подтверждён">Не подтверждён</div>
															<div class="__select__content">

																<input id="singleSelect0" class="__select__input" type="radio" name="singleSelect" checked />
																<label for="singleSelect0" class="__select__label hover:bg-[#FF0000] text-[#FF0000]">Не подтверждён</label>

																<input id="singleSelect1" class="__select__input" type="radio" name="singleSelect" />
																<label for="singleSelect1" class="__select__label hover:bg-[#FF5C00] text-[#FF5C00]">Подтверждён</label>

																<input id="singleSelect2" class="__select__input" type="radio" name="singleSelect" />
																<label for="singleSelect2" class="__select__label hover:bg-[#FFB800] text-[#FFB800]">Куплен</label>

																<input id="singleSelect3" class="__select__input" type="radio" name="singleSelect" />
																<label for="singleSelect3" class="__select__label hover:bg-[#00FF1A] text-[#00FF1A]">Отправлен</label>

																<input id="singleSelect4" class="__select__input" type="radio" name="singleSelect" />
																<label for="singleSelect4" class="__select__label hover:bg-[#8FFF00] text-[#8FFF00]">Получен</label>

															</div>
														</div>';
														} elseif ($row['state'] == 'Подтверждён'){
															echo
																'<input class="hidden" type="text" name="myVar" id="myVar_'.$row['id'].'" />
																<div class="__select" data-state="">
																<div class="__select__title text-[#FF5C00]" data-default="Не подтверждён">Подтверждён</div>
																<div class="__select__content">

																	<input id="singleSelect0" class="__select__input" type="radio" name="singleSelect" checked />
																	<label for="singleSelect0" class="__select__label hover:bg-[#FF5C00] text-[#FF5C00]">Подтверждён</label>

																	<input id="singleSelect1" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect1" class="__select__label hover:bg-[#FF0000] text-[#FF0000]">Не подтверждён</label>

																	<input id="singleSelect2" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect2" class="__select__label hover:bg-[#FFB800] text-[#FFB800]">Куплен</label>

																	<input id="singleSelect3" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect3" class="__select__label hover:bg-[#00FF1A] text-[#00FF1A]">Отправлен</label>

																	<input id="singleSelect4" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect4" class="__select__label hover:bg-[#8FFF00] text-[#8FFF00]">Получен</label>

																</div>
															</div>';
														} elseif ($row['state'] == 'Куплен'){
															echo
																'<input class="hidden" type="text" name="myVar" id="myVar_'.$row['id'].'" />
																<div class="__select" data-state="">
																<div class="__select__title text-[#FFB800]" data-default="Не подтверждён">Куплен</div>
																<div class="__select__content">

																	<input id="singleSelect0" class="__select__input" type="radio" name="singleSelect" checked />
																	<label for="singleSelect0" class="__select__label hover:bg-[#FF5C00] text-[#FFB800]">Куплен</label>

																	<input id="singleSelect2" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect2" class="__select__label hover:bg-[#FF0000] text-[#FF0000]">Не подтверждён</label>

																	<input id="singleSelect1" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect1" class="__select__label hover:bg-[#FF5C00] text-[#FF5C00]">Подтверждён</label>

																	<input id="singleSelect3" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect3" class="__select__label hover:bg-[#00FF1A] text-[#00FF1A]">Отправлен</label>

																	<input id="singleSelect4" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect4" class="__select__label hover:bg-[#8FFF00] text-[#8FFF00]">Получен</label>

																</div>
															</div>';
														} elseif ($row['state'] == 'Отправлен'){
															echo
																'<input class="hidden" type="text" name="myVar" id="myVar_'.$row['id'].'" />
																<div class="__select" data-state="">
																<div class="__select__title text-[#00FF1A]" data-default="Не подтверждён">Отправлен</div>
																<div class="__select__content">

																	<input id="singleSelect0" class="__select__input" type="radio" name="singleSelect" checked />
																	<label for="singleSelect0" class="__select__label hover:bg-[#FF5C00] text-[#00FF1A]">Отправлен</label>

																	<input id="singleSelect3" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect3" class="__select__label hover:bg-[#FF0000] text-[#FF0000]">Не подтверждён</label>

																	<input id="singleSelect1" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect1" class="__select__label hover:bg-[#FF5C00] text-[#FF5C00]">Подтверждён</label>

																	<input id="singleSelect2" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect2" class="__select__label hover:bg-[#FFB800] text-[#FFB800]">Куплен</label>

																	<input id="singleSelect4" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect4" class="__select__label hover:bg-[#8FFF00] text-[#8FFF00]">Получен</label>

																</div>
															</div>';
														} elseif ($row['state'] == 'Получен'){
															echo
																'<input class="hidden" type="text" name="myVar" id="myVar_'.$row['id'].'" />
																<div class="__select" data-state="">
																<div class="__select__title text-[#8FFF00]" data-default="Не подтверждён">Получен</div>
																<div class="__select__content">

																	<input id="singleSelect0" class="__select__input" type="radio" name="singleSelect" checked />
																	<label for="singleSelect0" class="__select__label hover:bg-[#8FFF00] text-[#8FFF00]">Получен</label>

																	<input id="singleSelect4" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect4" class="__select__label hover:bg-[#FF0000] text-[#FF0000]">Не подтверждён</label>

																	<input id="singleSelect1" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect1" class="__select__label hover:bg-[#FF5C00] text-[#FF5C00]">Подтверждён</label>

																	<input id="singleSelect2" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect2" class="__select__label hover:bg-[#FFB800] text-[#FFB800]">Куплен</label>

																	<input id="singleSelect3" class="__select__input" type="radio" name="singleSelect" />
																	<label for="singleSelect3" class="__select__label hover:bg-[#00FF1A] text-[#00FF1A]">Отправлен</label>

																</div>
															</div>';
														}
											?>
										</form>

									<!-- Действия с фото -->
										<button onclick="showDialog_<?=$row['photos']?>()" class="mr-10 flex">
											<div class="w-10 h-10 bg-[#e5e7eb] mr-4"></div>
											<div class="w-10 h-10 bg-[#e5e7eb] mr-4"></div>
											<div class="w-10 h-10 bg-[#e5e7eb] mr-4"></div>
											<div class="w-10 h-10 bg-[#e5e7eb] mr-4"></div>
											<div class="w-10 h-10 bg-[#e5e7eb]"></div>
										</button>

										<div onclick="hideDialog_<?=$row['photos']?>()" id="dialog_<?=$row['photos']?>" class="w-screen h-screen fixed left-0 top-0 z-10 bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-300 opacity-0 hidden">
											<div onclick="event.stopImmediatePropagation()" class="relative w-5/6 h-4/5 bg-white p-10 shadow-closeDialog">

												<!-- Кнопка "Закрыть" -->
												<button onclick="hideDialog_<?=$row['photos']?>()" class="w-12 h-12 absolute top-[-75px] right-[-100px] focus:outline-0 ">
													<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] translate-y-[-50%] rotate-45 z-10"></div>
													<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] translate-y-[-50%] -rotate-45"></div>
												</button>
												<!-- ------- -->

												<!-- Форма "Фото"" -->
												<div class="w-full h-full">
													<form id="form_<?=$row['photos']?>" class="w-full h-full flex flex-col text-black" action="./PHP_vendor/change_photo.php" method="post" enctype="multipart/form-data">
														<input type="hidden" name="photo_id" value="<?=$row['photos']?>">
														<!-- <p><?=$row['photos']?></p> -->

														<?php
															$photo = mysqli_query($connect, "SELECT `photos`.`id` AS `id`, `one`, `two`, `three`, `four`, `five`, `six`, `seven`, `eight`, `nine`, `ten` FROM `orders` JOIN `photos` ON `orders`.`photos` = `photos`.`id` WHERE `photos`.`id` = '".$row["photos"]."'");
															$photo_col = mysqli_fetch_assoc($photo);
															// print_r($photo_col);
														?>

														<div class="flex w-full h-full">
															<!-- Фото №1 -->
																<div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0 left-0">
																			<img id="img_<?=$row['photos']?>" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['one']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>" class="invisible" type="file" accept="image/*" name="photo1">

																	<input type="hidden" class="delPhoto_<?=$row['photos']?>" name="delPhoto_<?=$row['photos']?>" value="true">

																	<!-- Удалить фото 1 -->
																	<button type="button" class="w-12 h-12 absolute top-2 right-2 focus:outline-0" onclick="deletePhoto1(<?=$row['photos']?>)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	// false input для того, чтобы типа нет фото
																	function deletePhoto1(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	// даёт src фото, то есть путь к файлу, который выбрается в окне выбора изображения
																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          // true input для того, чтобы типа есть фото
																	          document.querySelector('.delPhoto_<?=$row['photos']?>').value = 'true';
																	      }
																	  });
																	});
																</script>

															<!-- Фото №2 -->
																<div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>1" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0 left-0">
																			<img id="img_<?=$row['photos']?>1" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['two']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>1" class="invisible" type="file" accept="image/*" name="photo2"> 

																	<input type="hidden" class="delPhoto_<?=$row['photos']?>1" name="delPhoto_<?=$row['photos']?>1" value="true">

																	<!-- Удалить фото 1 -->
																	<button type="button" class="w-12 h-12 absolute top-8 right-2 focus:outline-0" onclick="deletePhoto2(<?=$row['photos']?>1)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	function deletePhoto2(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>1').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>1');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          document.querySelector('.delPhoto_<?=$row['photos']?>1').value = 'true';
																	      }
																	  });
																	});
																</script>

															<!-- Фото №3 -->
																<div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>2" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0 left-0">
																			<img id="img_<?=$row['photos']?>2" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['three']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>2" class="invisible" type="file" accept="image/*" name="photo3"> 
																
																	<input type="hidden" class="delPhoto_<?=$row['photos']?>2" name="delPhoto_<?=$row['photos']?>2" value="true">

																	<!-- Удалить фото 3 -->
																	<button type="button" class="w-12 h-12 absolute top-8 right-2 focus:outline-0" onclick="deletePhoto2(<?=$row['photos']?>2)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	function deletePhoto3(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>2').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>2');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          document.querySelector('.delPhoto_<?=$row['photos']?>2').value = 'true';
																	      }
																	  });
																	});
																</script>

															<!-- Фото №4 -->
																<div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>3" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0">
																			<img id="img_<?=$row['photos']?>3" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['four']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>3" class="invisible" type="file" accept="image/*" name="photo4"> 

																	<input type="hidden" class="delPhoto_<?=$row['photos']?>3" name="delPhoto_<?=$row['photos']?>3" value="true">

																	<!-- Удалить фото 4 -->
																	<button type="button" class="w-12 h-12 absolute top-8 right-2 focus:outline-0" onclick="deletePhoto2(<?=$row['photos']?>3)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	function deletePhoto4(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>3').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>3');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          document.querySelector('.delPhoto_<?=$row['photos']?>3').value = 'true';
																	      }
																	  });
																	});
																</script>

															<!-- Фото №5 -->
																<div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>4" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0 left-0">
																			<img id="img_<?=$row['photos']?>4" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['five']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>4" class="invisible" type="file" accept="image/*" name="photo5"> 

																	<input type="hidden" class="delPhoto_<?=$row['photos']?>4" name="delPhoto_<?=$row['photos']?>4" value="true">

																	<!-- Удалить фото 4 -->
																	<button type="button" class="w-12 h-12 absolute top-8 right-2 focus:outline-0" onclick="deletePhoto2(<?=$row['photos']?>4)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	function deletePhoto5(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>4').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>4');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          document.querySelector('.delPhoto_<?=$row['photos']?>4').value = 'true';
																	      }
																	  });
																	});
																</script>
														</div>

														<div class="flex w-full h-full">
															<!-- Фото №6 -->
																 <div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>5" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0 left-0">
																			<img id="img_<?=$row['photos']?>5" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['six']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>5" class="invisible" type="file" accept="image/*" name="photo6"> 

																	<input type="hidden" class="delPhoto_<?=$row['photos']?>5" name="delPhoto_<?=$row['photos']?>5" value="true">

																	<!-- Удалить фото 5 -->
																	<button type="button" class="w-12 h-12 absolute top-8 right-2 focus:outline-0" onclick="deletePhoto2(<?=$row['photos']?>5)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	function deletePhoto6(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>5').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>5');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          document.querySelector('.delPhoto_<?=$row['photos']?>5').value = 'true';
																	      }
																	  });
																	});
																</script>

															<!-- Фото №7 -->
																<div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>6" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0 left-0">
																			<img id="img_<?=$row['photos']?>6" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['seven']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>6" class="invisible" type="file" accept="image/*" name="photo7"> 

																	<input type="hidden" class="delPhoto_<?=$row['photos']?>6" name="delPhoto_<?=$row['photos']?>6" value="true">

																	<!-- Удалить фото 7 -->
																	<button type="button" class="w-12 h-12 absolute top-8 right-2 focus:outline-0" onclick="deletePhoto2(<?=$row['photos']?>6)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	function deletePhoto7(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>6').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>6');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          document.querySelector('.delPhoto_<?=$row['photos']?>6').value = 'true';
																	      }
																	  });
																	});
																</script>

															<!-- Фото №8 -->
																<div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>7" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0 left-0">
																			<img id="img_<?=$row['photos']?>7" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['eight']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>7" class="invisible" type="file" accept="image/*" name="photo8"> 

																	<input type="hidden" class="delPhoto_<?=$row['photos']?>7" name="delPhoto_<?=$row['photos']?>7" value="true">

																	<!-- Удалить фото 8 -->
																	<button type="button" class="w-12 h-12 absolute top-8 right-2 focus:outline-0" onclick="deletePhoto2(<?=$row['photos']?>7)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	function deletePhoto8(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>7').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>7');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          document.querySelector('.delPhoto_<?=$row['photos']?>7').value = 'true';
																	      }
																	  });
																	});
																</script>

															<!-- Фото №9 -->
																<div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>8" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0 left-0">
																			<img id="img_<?=$row['photos']?>8" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['nine']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>8" class="invisible" type="file" accept="image/*" name="photo9"> 

																	<input type="hidden" class="delPhoto_<?=$row['photos']?>8" name="delPhoto_<?=$row['photos']?>8" value="true">

																	<!-- Удалить фото 9 -->
																	<button type="button" class="w-12 h-12 absolute top-8 right-2 focus:outline-0" onclick="deletePhoto2(<?=$row['photos']?>8)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	function deletePhoto9(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>8').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>8');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          document.querySelector('.delPhoto_<?=$row['photos']?>8').value = 'true';
																	      }
																	  });
																	});
																</script>

															<!-- Фото №10 -->
																<div class="w-[20%] bg-[#D9D9D9] relative">
																	<label for="photo_<?=$row['photos']?>9" class="w-full h-full absolute top-0 left-0 avatarOut">

																		<div class="w-full h-full absolute top-0 left-0">
																			<img id="img_<?=$row['photos']?>9" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?=$photo_col['ten']?>" alt="">
																		</div>

																		<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoIn" src="./img/free-icon-plus-3398952.png" alt="">
																	</label>
																	<input id="photo_<?=$row['photos']?>9" class="invisible" type="file" accept="image/*" name="photo10"> 

																	<input type="hidden" class="delPhoto_<?=$row['photos']?>9" name="delPhoto_<?=$row['photos']?>9" value="true">

																	<!-- Удалить фото 10 -->
																	<button type="button" class="w-12 h-12 absolute top-8 right-2 focus:outline-0" onclick="deletePhoto2(<?=$row['photos']?>9)">
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45 z-10"></div>
																		<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
																	</button>
																</div>

																<script>
																	function deletePhoto10(photoId) {
																		var photoId_ = document.getElementById('img_' + photoId);
																		photoId_.src = '';
																		document.querySelector('.delPhoto_' + photoId).value = 'false';
																	}

																	window.addEventListener('load', function() {
																	  document.querySelector('input#photo_<?=$row['photos']?>9').addEventListener('change', function() {
																	      if (this.files && this.files[0]) {
																	          var img = document.querySelector('img#img_<?=$row['photos']?>9');
																	          img.onload = () => {
																	              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																	          }

																	          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																	          document.querySelector('.delPhoto_<?=$row['photos']?>9').value = 'true';
																	      }
																	  });
																	});
																</script>

														</div>

														<button type="submit" class="block w-[400px] m-auto normal-case relative">
															<div class="w-full h-full border-2 border-black py-8 bg-black text-white hover:bg-white hover:text-black duration-300">
																<p class="font-TNRB text-3xl  tracking-[.20em] whitespace-nowrap absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] mb-0">Сохранить</p>
															</div>
														</button>

														<!-- автоматическая отправка формы -->
														<!-- <script>
															document.getElementById('photo_<?=$row['photos']?>').addEventListener('change', function() {
																var form = document.getElementById('form_<?=$row['photos']?>');
																form.submit();
															});
														</script> -->

													</form>
												</div>
												<!-- ------- -->
											</div>
										</div>

									<!-- ФИО -->
										<p class="w-[20%] overflow-x-scroll whitespace-nowrap">
											<?php 
												$user_fio = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `full_name` FROM `orders` JOIN `users` ON `orders`.`user` = `users`.`id` WHERE `users`.`id` = '".$row["user"]."' LIMIT 1"));
												echo $user_fio['full_name'];
											 ?>
										 </p>

									<script>
										// Модальное окно фото
											function showDialog_<?=$row['photos']?>(){
												let dialog = document.getElementById('dialog_<?=$row['photos']?>');
												dialog.classList.remove('hidden');
												dialog.classList.add('flex');
												setTimeout(()=>{
													dialog.classList.add("opacity-100");
												}, 1)
											};
											function hideDialog_<?=$row['photos']?>(){
												let dialog = document.getElementById('dialog_<?=$row['photos']?>');
												dialog.classList.add("opacity-0");
												dialog.classList.remove("opacity-100");
												setTimeout(()=>{
													dialog.classList.add('hidden');
													dialog.classList.remove('flex');
												}, 300)
											}
									</script>

									<script>
										// имитированный Select / Options
											const selectSingle_<?=$row['id']?> = document.querySelector('#form_<?=$row['id']?> .__select');
											const selectSingle_title_<?=$row['id']?> = selectSingle_<?=$row['id']?>.querySelector('.__select__title');
											const selectSingle_labels_<?=$row['id']?> = selectSingle_<?=$row['id']?>.querySelectorAll('.__select__label');

											// Toggle menu
											selectSingle_title_<?=$row['id']?>.addEventListener('click', () => {
											  if ('active' === selectSingle_<?=$row['id']?>.getAttribute('data-state')) {
											    selectSingle_<?=$row['id']?>.setAttribute('data-state', '');
											  } else {
											    selectSingle_<?=$row['id']?>.setAttribute('data-state', 'active');
											  }
											});

											// Close when click to option
											for (let i = 0; i < selectSingle_labels_<?=$row['id']?>.length; i++) {
											  selectSingle_labels_<?=$row['id']?>[i].addEventListener('click', (evt) => {
											    // selectSingle_title_<?=$row['id']?>.textContent = evt.target.innerText; // или evt.target.innerHTML
											    selectSingle_<?=$row['id']?>.setAttribute('data-state', '');

											    var form = document.getElementById('form_<?=$row['id']?>');

											    const myVarInput = document.getElementById('myVar_<?= $row['id'] ?>');
											    myVarInput.value = evt.target.innerText; // или evt.target.innerHTML

											    form.submit();
											  });
											}

											// Закрытие списка при клике вне него
											document.addEventListener('click', (evt) => {
											  if (!selectSingle_<?=$row['id']?>.contains(evt.target)) {
											    selectSingle_<?=$row['id']?>.setAttribute('data-state', '');
											  }
											});

											// //автоматическая отправка в оброботчик
						               //  document.getElementById('select_<?=$row['id']?>').addEventListener('change', function() {
						               //      var form = document.getElementById('form_<?=$row['id']?>');
						               //      form.submit();
						               //  });
									</script>
								</div>
								<hr class="border-black">
							<?php
						}
					?>
				</div>
			</div>
		</main>

<footer class="w-screen h-[75px] bg-[#D9D9D9] px-10">
	<div class="max-w-[1600px] h-full mx-auto">
		<div class="h-full flex items-center justify-end">
		<div class="flex justify-end py-1">
			<a href="#">
				<img src="img/tMe.png" alt="tMe" class="w-16 ml-8 grayscale-[50%] hover:grayscale-0">
			</a>
			<a href="#">
				<img src="img/vK.png" alt="vK" class="w-16 ml-8 grayscale-[50%] hover:grayscale-0">
			</a>
			<a href="#">
				<img src="img/Inst.png" alt="Inst" class="w-16 ml-8 grayscale-[50%] hover:grayscale-0">
			</a>
		</div>
	</div>
	</div>
</footer>
	</div>

	<script>
		let cords = ['scrollX','scrollY']; 
		// сохраняем позицию скролла в localStorage
		window.addEventListener('unload', e => cords.forEach(cord => localStorage[cord] = window[cord])); 
		// вешаем событие на загрузку (ресурсов) страницы
		window.addEventListener('load', e => {
		    // если в localStorage имеются данные
		    if (localStorage[cords[0]]) {
		        // скроллим к сохраненным координатам
		        window.scroll(...cords.map(cord => localStorage[cord]));
		        // удаляем данные с localStorage
		        cords.forEach(cord => localStorage.removeItem(cord));
		    }
		});
	</script>

</body>
</html>