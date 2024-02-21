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
<body class="h-full font-['Times_New_Roman_Regular']">
	<div class="min-h-full flex flex-col">
		<header class="w-screen h-[75px] bg-[#D9D9D9] mb-[100px]">
			<div class="max-w-[1600px] h-full mx-auto">
				<div class="h-full flex items-center justify-end">
					<div class="flex justify-end items-center text-2xl">
						<a href="./PHP_vendor/logout.php" class="text-[#007bff] cursor-pointer p-0 focus:outline-0 hover:underline">Выход</a>
					</div>
				</div>
			</div>
		</header>		<main class="flex-auto">

				<div class="w-[1920px] mx-auto">
					<div class="w-[80%] mx-auto flex">
						<div class="w-[30%] flex flex-col">

							<div class="w-[400px] h-[500px] bg-[#D9D9D9] mb-[25px]"></div>

							<a href="#" class="block w-[400px] h-[55px] normal-case relative">
								<div class="w-full h-full bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300">
									<p class="font-TNRB text-xl text-white tracking-[.20em] whitespace-nowrap absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] mb-0">Изменить профиль</p>
								</div>
								<div class="w-full h-full bg-[#D9D9D9] absolute top-0 left-0 z-[-10]"></div>
							</a>

						</div>

						<div class="w-[70%] flex flex-col justify-between">

							<div class="">
								<h1 class="font-TNRB text-5xl mb-[100px]">Здравствуйте, <?= $_SESSION['user']['login'] ?>!</h1>
								<p class="text-3xl mb-[50px]">ФИО: <?= $_SESSION['user']['full_name'] ?></p>
								<p class="text-3xl mb-[50px]">Телефон: <?= $_SESSION['user']['telephone'] ?></p>
								<p class="text-3xl mb-[50px]">Telegram: <?= $_SESSION['user']['telegram'] ?></p>
								<p class="text-3xl mb-[50px]">vK: <?= $_SESSION['user']['vk'] ?></p>
							</div>

							<a href="#" class="block w-[400px] h-[75px] normal-case relative">
								<div class="w-full h-full bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300">
									<p class="font-TNRB text-3xl text-white tracking-[.20em] whitespace-nowrap absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] mb-0">Мои заказы</p>
								</div>
								<div class="w-full h-full bg-[#D9D9D9] absolute top-0 left-0 z-[-10]"></div>
							</a>

						</div>
					</div>
				</div>

				<!-- <p> <?= $_SESSION['user']['login'] ?> </p>
				<p> <?= $_SESSION['user']['full_name'] ?> </p>
				<p> <?= $_SESSION['user']['telephone'] ?> </p>
				<p> <?= $_SESSION['user']['telegram'] ?> </p>
				<p> <?= $_SESSION['user']['vk'] ?> </p> -->

		</main>
<footer class="w-screen h-[75px] bg-[#D9D9D9]">
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
</footer>	</div>
</body>
</html>
