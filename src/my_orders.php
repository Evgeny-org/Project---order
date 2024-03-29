<?php
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ALL);

	session_start();
	if(!$_SESSION['user']){
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
		<main class="flex-auto px-10 tracking-widest">
			<span id="big-photo"></span>
			<div class="max-w-[1920px] mx-auto">
					<div class="w-[80%] mx-auto flex flex-col">

						<h1 class="font-TNRB text-5xl mb-[50px]">Мои заказы</h1>
						<hr class="border-black">
						<?php
							$connect = mysqli_connect('localhost', 'root', '', 'Dmitry');

							$result = mysqli_query($connect, "SELECT * FROM `orders`");
							$counter = 0;


							while ($row = mysqli_fetch_assoc($result)) {
								if ($row['user'] == $_SESSION['user']['id']) {
									$counter++;
									?>
										<div class="flex py-8 text-3xl">
											<!-- № Заказа -->
												<p class="w-[150px] mr-20">Заказ №<?= $counter ?></p>

											<!-- Excel загрзука / выгрузка -->
												<form id="<?= $row['id'] ?>" class="w-[250px] flex mr-28 relative" action="./PHP_vendor/upload_file.php" method="post" enctype="multipart/form-data">
													<a class="overflow-hidden text-[#4CAF50] hover:text-[#2E7D32] hover:underline transition:" href="<?= $row['excel'] ?>">
														<?php 
															if ($row['excel'] != './excels/Example.xlsx') {
																echo substr(basename($row['excel']), 10);
															} else {
																echo basename($row['excel']);
															}
														?>
													</a>

														<input type="hidden" name="order_id" value="<?=$row['id']?>">

														<label for="excel_<?= $row['id'] ?>">
															<svg class="w-7 h-7 absolute top-[10%] right-[-15%] cursor-pointer text-[#7f7f7f] hover:text-[#007bff] transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
																<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
															</svg>
														</label>
														<input id="excel_<?= $row['id'] ?>" class="absolute invisible" type="file" accept=".xlsx" name="excel">

												</form>

												<script>
							                document.getElementById('excel_<?= $row['id'] ?>').addEventListener('change', function() {
							                    var form = document.getElementById('<?= $row['id'] ?>');
							                    form.submit();
							                });
	            							</script>

	            						<!-- Статус заказа -->
												<div class="mr-20"><?php
													if ($row['state'] == 'Не подтверждён') {
														echo '<p class="text-[#FF0000]">' . $row['state'] . '</p>';
													} elseif ($row['state'] == 'Подтверждён'){
														echo '<p class="text-[#FF5C00]">' . $row['state'] . '</p>';
													} elseif ($row['state'] == 'Куплен'){
														echo '<p class="text-[#FFB800]">' . $row['state'] . '</p>';
													} elseif ($row['state'] == 'Отправлен'){
														echo '<p class="text-[#00FF1A]">' . $row['state'] . '</p>';
													} elseif ($row['state'] == 'Получен'){
														echo '<p class="text-[#8FFF00]">' . $row['state'] . '</p>';
													}
												?></div>

											<!-- Действия с фото -->
													<?php
														$photo = mysqli_query($connect, "SELECT `photos`.`id` AS `id`, `one`, `two`, `three`, `four`, `five`, `six`, `seven`, `eight`, `nine`, `ten` FROM `orders` JOIN `photos` ON `orders`.`photos` = `photos`.`id` WHERE `photos`.`id` = '".$row["photos"]."'");
														$photo_col = mysqli_fetch_assoc($photo);
														// print_r($photo_col);
													?>

													<button onclick="showDialog_<?=$row['photos']?>()" class="previewUp mr-10 flex relative">
														<div class="w-10 h-10 bg-[#e5e7eb] mr-4 relative">
															<img class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['one']?>" alt="" onerror="this.style.visibility = 'hidden'">
														</div>
														<div class="w-10 h-10 bg-[#e5e7eb] mr-4 relative">
															<img class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['two']?>" alt="" onerror="this.style.visibility = 'hidden'">
														</div>
														<div class="w-10 h-10 bg-[#e5e7eb] mr-4 relative">
															<img class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['three']?>" alt="" onerror="this.style.visibility = 'hidden'">
														</div>
														<div class="w-10 h-10 bg-[#e5e7eb] mr-4 relative">
															<img class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['four']?>" alt="" onerror="this.style.visibility = 'hidden'">
														</div>
														<div class="w-10 h-10 bg-[#e5e7eb] relative">
															<img class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['five']?>" alt="" onerror="this.style.visibility = 'hidden'">
														</div>
														<div class="previewDown absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] flex justify-center items-center">
															<p class="text-white tracking-widest opacity-100 text-2xl">Посмотреть фото</p>
														</div>
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

																	<div class="flex justify-between w-full h-full mb-5">
																		<!-- Фото №1 -->
																			<div class="photoOut w-[19%] bg-[#D9D9D9] relative">

																				<?php if ($photo_col['one'] !== '' && $photo_col['one'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['one']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>

																				<label for="photo_<?=$row['photos']?>" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0 left-0">
																						<?php if ($photo_col['one'] !== '' && $photo_col['one'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['one']?>" alt="">
																						<?php } elseif ($photo_col['one'] == '' || $photo_col['one'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<input id="photo_<?=$row['photos']?>" class="invisible">
																				<?php if ($photo_col['one'] !== '' && $photo_col['one'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																			</div>

																			

																			<script>
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
																				      }
																				  });
																				});
																			</script>

																		<!-- Фото №2 -->
																			<div class="photoOut w-[19%] bg-[#D9D9D9] relative">
																				<?php if ($photo_col['two'] !== '' && $photo_col['two'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['two']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>
																				<label for="photo_<?=$row['photos']?>1" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0 left-0">
																						<?php if ($photo_col['two'] !== '' && $photo_col['two'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>1" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['two']?>" alt="">
																						<?php } elseif ($photo_col['two'] == '' || $photo_col['two'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>1" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<input id="photo_<?=$row['photos']?>1" class="invisible">
																				<?php if ($photo_col['two'] !== '' && $photo_col['two'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																			</div>

																			<script>
																				window.addEventListener('load', function() {
																				  document.querySelector('input#photo_<?=$row['photos']?>1').addEventListener('change', function() {
																				      if (this.files && this.files[0]) {
																				          var img = document.querySelector('img#img_<?=$row['photos']?>1');
																				          img.onload = () => {
																				              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																				          }
																				          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																				      }
																				  });
																				});
																			</script>

																		<!-- Фото №3 -->
																			<div class="photoOut w-[19%] bg-[#D9D9D9] relative">
																				<?php if ($photo_col['three'] !== '' && $photo_col['three'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['three']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>
																				<label for="photo_<?=$row['photos']?>2" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0 left-0">
																						<?php if ($photo_col['three'] !== '' && $photo_col['three'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>2" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['three']?>" alt="">
																						<?php } elseif ($photo_col['three'] == '' || $photo_col['three'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>2" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<input id="photo_<?=$row['photos']?>2" class="invisible"> 
																				<?php if ($photo_col['three'] !== '' && $photo_col['three'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																			</div>

																			<script>
																				window.addEventListener('load', function() {
																				  document.querySelector('input#photo_<?=$row['photos']?>2').addEventListener('change', function() {
																				      if (this.files && this.files[0]) {
																				          var img = document.querySelector('img#img_<?=$row['photos']?>2');
																				          img.onload = () => {
																				              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																				          }
																				          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																				      }
																				  });
																				});
																			</script>

																		<!-- Фото №4 -->
																			<div class="photoOut w-[19%] bg-[#D9D9D9] relative">
																				<?php if ($photo_col['four'] !== '' && $photo_col['four'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['two']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>
																				<label for="photo_<?=$row['photos']?>3" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0">
																						<?php if ($photo_col['four'] !== '' && $photo_col['four'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>3" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['four']?>" alt="">
																						<?php } elseif ($photo_col['four'] == '' || $photo_col['four'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>3" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<input id="photo_<?=$row['photos']?>3" class="invisible"> 
																				<?php if ($photo_col['four'] !== '' && $photo_col['four'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																			</div>

																			<script>
																				window.addEventListener('load', function() {
																				  document.querySelector('input#photo_<?=$row['photos']?>3').addEventListener('change', function() {
																				      if (this.files && this.files[0]) {
																				          var img = document.querySelector('img#img_<?=$row['photos']?>3');
																				          img.onload = () => {
																				              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																				          }
																				          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																				      }
																				  });
																				});
																			</script>

																		<!-- Фото №5 -->
																			<div class="photoOut w-[19%] bg-[#D9D9D9] relative">
																				<?php if ($photo_col['five'] !== '' && $photo_col['five'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['five']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>
																				<label for="photo_<?=$row['photos']?>4" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0 left-0">
																						<?php if ($photo_col['five'] !== '' && $photo_col['five'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>4" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['five']?>" alt="">
																						<?php } elseif ($photo_col['five'] == '' || $photo_col['five'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>4" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<input id="photo_<?=$row['photos']?>4" class="invisible"> 
																				<?php if ($photo_col['five'] !== '' && $photo_col['five'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																			</div>

																			<script>
																				window.addEventListener('load', function() {
																				  document.querySelector('input#photo_<?=$row['photos']?>4').addEventListener('change', function() {
																				      if (this.files && this.files[0]) {
																				          var img = document.querySelector('img#img_<?=$row['photos']?>4');
																				          img.onload = () => {
																				              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																				          }
																				          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																				      }
																				  });
																				});
																			</script>
																	</div>

																	<div class="flex justify-between w-full h-full">
																		<!-- Фото №6 -->
																			 <div class="photoOut w-[19%] bg-[#D9D9D9] relative">
																			 	<?php if ($photo_col['six'] !== '' && $photo_col['six'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['six']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>
																				<label for="photo_<?=$row['photos']?>5" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0 left-0">
																						<?php if ($photo_col['six'] !== '' && $photo_col['six'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>5" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['six']?>" alt="">
																						<?php } elseif ($photo_col['six'] == '' || $photo_col['six'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>5" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<input id="photo_<?=$row['photos']?>5" class="invisible"> 
																				<?php if ($photo_col['six'] !== '' && $photo_col['six'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																			</div>

																			<script>
																				window.addEventListener('load', function() {
																				  document.querySelector('input#photo_<?=$row['photos']?>5').addEventListener('change', function() {
																				      if (this.files && this.files[0]) {
																				          var img = document.querySelector('img#img_<?=$row['photos']?>5');
																				          img.onload = () => {
																				              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																				          }
																				          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																				      }
																				  });
																				});
																			</script>

																		<!-- Фото №7 -->
																			<div class="photoOut w-[19%] bg-[#D9D9D9] relative">
																				<?php if ($photo_col['seven'] !== '' && $photo_col['seven'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['seven']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>
																				<label for="photo_<?=$row['photos']?>6" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0 left-0">
																						<?php if ($photo_col['seven'] !== '' && $photo_col['seven'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>6" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['seven']?>" alt="">
																						<?php } elseif ($photo_col['seven'] == '' || $photo_col['seven'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>6" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<input id="photo_<?=$row['photos']?>6" class="invisible"> 
																				<?php if ($photo_col['seven'] !== '' && $photo_col['seven'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																			</div>

																			<script>
																				window.addEventListener('load', function() {
																				  document.querySelector('input#photo_<?=$row['photos']?>6').addEventListener('change', function() {
																				      if (this.files && this.files[0]) {
																				          var img = document.querySelector('img#img_<?=$row['photos']?>6');
																				          img.onload = () => {
																				              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																				          }
																				          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																				      }
																				  });
																				});
																			</script>

																		<!-- Фото №8 -->
																			<div class="photoOut w-[19%] bg-[#D9D9D9] relative">
																				<?php if ($photo_col['eight'] !== '' && $photo_col['eight'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['eight']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>
																				<label for="photo_<?=$row['photos']?>7" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0 left-0">
																						<?php if ($photo_col['eight'] !== '' && $photo_col['eight'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>7" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['eight']?>" alt="">
																						<?php } elseif ($photo_col['eight'] == '' || $photo_col['eight'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>7" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<?php if ($photo_col['eight'] !== '' && $photo_col['eight'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																				<input id="photo_<?=$row['photos']?>7" class="invisible"> 
																			</div>

																			<script>
																				window.addEventListener('load', function() {
																				  document.querySelector('input#photo_<?=$row['photos']?>7').addEventListener('change', function() {
																				      if (this.files && this.files[0]) {
																				          var img = document.querySelector('img#img_<?=$row['photos']?>7');
																				          img.onload = () => {
																				              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																				          }
																				          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																				      }
																				  });
																				});
																			</script>

																		<!-- Фото №9 -->
																			<div class="photoOut w-[19%] bg-[#D9D9D9] relative">
																				<?php if ($photo_col['nine'] !== '' && $photo_col['nine'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['nine']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>
																				<label for="photo_<?=$row['photos']?>8" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0 left-0">
																						<?php if ($photo_col['nine'] !== '' && $photo_col['nine'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>8" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['nine']?>" alt="">
																						<?php } elseif ($photo_col['nine'] == '' || $photo_col['nine'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>8" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<input id="photo_<?=$row['photos']?>8" class="invisible"> 
																				<?php if ($photo_col['nine'] !== '' && $photo_col['nine'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																			</div>

																			<script>
																				window.addEventListener('load', function() {
																				  document.querySelector('input#photo_<?=$row['photos']?>8').addEventListener('change', function() {
																				      if (this.files && this.files[0]) {
																				          var img = document.querySelector('img#img_<?=$row['photos']?>8');
																				          img.onload = () => {
																				              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																				          }
																				          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																				      }
																				  });
																				});
																			</script>

																		<!-- Фото №10 -->
																			<div class="photoOut w-[19%] bg-[#D9D9D9] relative">
																				<?php if ($photo_col['ten'] !== '' && $photo_col['ten'] !== NULL) { ?>
																					<div onclick="open_photo('<?=$photo_col['ten']?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>
																				<?php } ?>
																				<label for="photo_<?=$row['photos']?>9" class="w-full h-full absolute top-0 left-0 avatarOut">
																					<div class="w-full h-full absolute top-0 left-0">
																						<?php if ($photo_col['ten'] !== '' && $photo_col['ten'] !== NULL) { ?>
																							<img id="img_<?=$row['photos']?>9" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?=$photo_col['ten']?>" alt="">
																						<?php } elseif ($photo_col['ten'] == '' || $photo_col['ten'] == NULL) { ?>
																							<img id="img_<?=$row['photos']?>9" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
																						<?php } ?>
																					</div>
																				</label>
																				<input id="photo_<?=$row['photos']?>9" class="invisible"> 
																				<?php if ($photo_col['ten'] !== '' && $photo_col['ten'] !== NULL) { ?>
																					<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
																				<?php } ?>
																			</div>

																			<script>
																				window.addEventListener('load', function() {
																				  document.querySelector('input#photo_<?=$row['photos']?>9').addEventListener('change', function() {
																				      if (this.files && this.files[0]) {
																				          var img = document.querySelector('img#img_<?=$row['photos']?>9');
																				          img.onload = () => {
																				              URL.revokeObjectURL(img.src);  // no longer needed, free memory
																				          }
																				          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
																				      }
																				  });
																				});
																			</script>
																	</div>

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
										</div>
										<hr class="border-black">
									<?php
								}
							}
						?>

						<div class="flex mt-[50px] mb-[100px]">
							<a href="./profile.php" class="block w-[400px] h-[55px] normal-case relative mr-10">
								<div class="w-full h-full bg-black hover:translate-x-[-15px] duration-300">
									<p class="font-TNRB text-xl text-white tracking-[.20em] whitespace-nowrap absolute top-2/4 left-5 translate-y-[-50%] mb-0">Назад</p>
								</div>
								<div class="w-full h-full bg-[#D9D9D9] absolute top-0 left-0 z-[-10]"></div>
							</a>

						<form action="./PHP_vendor/add_order.php" method="post">
						    <button type="submit" id="myButton" class="block w-[400px] h-[55px] normal-case relative">
						        <div class="w-full h-full bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300">
						            <p class="font-TNRB text-xl text-white tracking-[.20em] whitespace-nowrap absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] mb-0">Добавить</p>
						        </div>
						        <div class="w-full h-full bg-[#D9D9D9] absolute top-0 left-0 z-[-10]"></div>
						    </button>
						</form>

						<script>
						  function open_photo(photo) {
						    document.getElementById("big-photo").innerHTML =
						      (
						        "<div onclick='close_photo()' style='position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,.5); z-index: 12; cursor: pointer;'>" +
						          "<img style='position: absolute; height: 80vh; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 11;' src='" + photo + "'>" +
						        "</div>"
						      );
						  }

						  function close_photo() {
						    document.getElementById("big-photo").innerHTML = "";
						  }
						</script>

						<!-- Чудо скрипт от юшки, который активирует куки файлы и при достижени лимита - блокирует нажатия :) -->
							<script>
							    var button = document.getElementById('myButton');
							    var clickCount = getCookie('clickCount');

							    if (clickCount >= 4) {
							        button.disabled = true;
							    }

							    button.addEventListener('click', function() {
							        clickCount++;
							        if (clickCount >= 4) {
							            button.disabled = true;
							        }
							        setCookie('clickCount', clickCount);
							    });

							    function setCookie(name, value) {
							        document.cookie = name + '=' + value + '; path=/';
							    }

							    function getCookie(name) {
							        var cookieName = name + '=';
							        var cookies = document.cookie.split(';');
							        for (var i = 0; i < cookies.length; i++) {
							            var cookie = cookies[i].trim();
							            if (cookie.indexOf(cookieName) === 0) {
							                return parseInt(cookie.substring(cookieName.length), 10);
							            }
							        }
							        return 0;
							    }
							</script>
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
						</div>

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

</body>
</html>