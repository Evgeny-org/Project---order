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
					<form class="w-[80%] mx-auto flex" action="./PHP_vendor/change_profile.php" method="post" enctype="multipart/form-data">

						<div class="flex flex-col justify-between mr-[50px]">

							<div class="w-[400px] h-[500px] bg-[#D9D9D9] mb-[25px] relative">
								<label class="w-full h-full absolute top-0 left-0 avatarOut" for="avatar">

									<div class="w-full h-full absolute top-0 left-0">
										<img class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] opacity-25" src="<?= $_SESSION['user']['avatar'] ?>" alt="">
									</div>

									<svg xmlns="http://www.w3.org/2000/svg" class="">
										<rect class="shape"/>
									<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] avatarIn" src="./img/free-icon-plus-3398952.png" alt="Фото профиля">

								</label>

								<input id="avatar" class="invisible" type="file" accept="image/*" name="avatar"> 

								<script type="text/javascript">
									window.addEventListener('load', function() {
									  document.querySelector('input[type="file"]').addEventListener('change', function() {
									      if (this.files && this.files[0]) {
									          var img = document.querySelector('img');
									          img.onload = () => {
									              URL.revokeObjectURL(img.src);  // no longer needed, free memory
									          }

									          img.src = URL.createObjectURL(this.files[0]); // set src to blob url
									      }
									  });
									});
								</script>
							</div>

							<a href="./profile.php" class="block w-[400px] h-[55px] normal-case relative">
								<div class="w-full h-full bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300">
									<p class="font-TNRB text-xl text-white tracking-[.20em] whitespace-nowrap absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] mb-0">Назад</p>
								</div>
								<div class="w-full h-full bg-[#D9D9D9] absolute top-0 left-0 z-[-10]"></div>
							</a>
						</div>

						<div class="w-[50%] flex flex-col justify-between">
							<div class="">
								<h1 class="font-TNRB text-5xl mb-[100px]">Что Вы хотите изменить?</h1>

								<div class="flex items-center mb-[45px]">
									<p class="text-3xl">ФИО:</p>
									<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-3xl text-right tracking-widest" type="text" name="full_name" value="<?= $_SESSION['user']['full_name'] ?>">
								</div>

								<div class="flex items-center mb-[45px]">
									<p class="text-3xl">Телефон:</p>
									<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-3xl text-right tracking-widest" type="text" name="telephone" value="<?= $_SESSION['user']['telephone'] ?>">
								</div>

								<div class="flex items-center mb-[45px]">
									<p class="text-3xl">Telegram:</p>
									<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-3xl text-right tracking-widest" type="text" name="telegram" value="<?= $_SESSION['user']['telegram'] ?>">
								</div>

								<div class="flex items-center mb-[45px]">
									<p class="text-3xl">vK:</p>
									<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-3xl text-right tracking-widest" type="text" name="vk" value="<?= $_SESSION['user']['vk'] ?>">
								</div>
							</div>

							<button type="submit" class="block w-[400px] h-[75px] normal-case relative">
								<div class="w-full h-full bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300">
									<p class="font-TNRB text-3xl text-white tracking-[.20em] whitespace-nowrap absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] mb-0">Сохранить</p>
								</div>
								<div class="w-full h-full bg-[#D9D9D9] absolute top-0 left-0 z-[-10]"></div>
							</button>
						</div>
					</form>
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
