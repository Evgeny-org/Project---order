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
											<p class="w-[150px] mr-20">Заказ №<?= $counter ?></p>
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

											<div class=""><?php
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

						<!-- Чудо скрипт от You.com, который активирует куки файлы и при достижени лимита - блокирует нажатия :) -->
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