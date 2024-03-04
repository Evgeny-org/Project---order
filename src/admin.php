<?php
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ALL);

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
								<div class="flex py-8 text-3xl">
									<p class="w-[150px] mr-20">Заказ №<?= $counter ?></p>
									<div class="w-[250px] flex mr-28 relative" action="./PHP_vendor/upload_file.php" method="post" enctype="multipart/form-data">
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

									<form id="form_<?=$row['id']?>" class="" action="./PHP_vendor/state_admin.php" method="post">
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