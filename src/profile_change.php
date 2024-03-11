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
	<span id="big-photo"></span>
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
		<main class="flex-auto px-10 tracking-widest mb-[125px] relative">
				<div class="max-w-[1920px] mx-auto">
					<form class="w-[80%] mx-auto flex" action="./PHP_vendor/change_profile.php" method="post" enctype="multipart/form-data">
						<div class="flex flex-col justify-between mr-[50px]">

							<!-- Аватар -->
							<div class="photoOut w-[400px] h-[500px] bg-[#D9D9D9] mb-[25px] relative"> 
								<?php if ($_SESSION['user']['avatar'] !== '' && $_SESSION['user']['avatar'] !== NULL) { ?>

									<div onclick="open_photo('<?= $_SESSION['user']['avatar'] ?>')" class="photoYes absolute top-0 left-0 w-full h-full bg-[rgba(0,0,0,.5)] z-10 cursor-pointer"></div>

								<?php } ?>
								<label class="w-full h-full absolute top-0 left-0 avatarOut" for="avatar">
									<div class="w-full h-full absolute top-0 left-0">
									<?php if ($_SESSION['user']['avatar'] !== '' && $_SESSION['user']['avatar'] !== NULL) { ?>

										<img id="img" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="<?= $_SESSION['user']['avatar'] ?>" alt="">

									<?php } elseif ($_SESSION['user']['avatar'] == '' || $_SESSION['user']['avatar'] == NULL) { ?>
										<img id="img" class="w-full h-full object-cover absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%]" src="./img/Screenshot_24.png" alt="">
									<?php } ?>
									</div>
									<?php if ($_SESSION['user']['avatar'] == '' || $_SESSION['user']['avatar'] == NULL) { ?>
									<svg xmlns="http://www.w3.org/2000/svg" class="relative z-10">
										<rect class="shape"/>
									<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] avatarIn" src="./img/free-icon-plus-3398952.png" alt="Фото профиля">
								</label>
								<input id="avatar" class="invisible" type="file" accept="image/*" name="avatar">
								<?php } elseif ($_SESSION['user']['avatar'] !== '' && $_SESSION['user']['avatar'] !== NULL) { ?>
									<img class="absolute z-10 top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] photoYes pointer-events-none" src="./img/Mask_group.png" alt="">
								<?php } ?>
								<input type="hidden" class="delPhoto" name="delPhoto" value="true">
								<?php if ($_SESSION['user']['avatar'] !== '' && $_SESSION['user']['avatar'] !== NULL) { ?>
									<!-- Удалить фото -->
									<button type="button" class="w-12 h-12 absolute top-2 right-2 focus:outline-0 photoYes z-10 cursor-pointer" onclick="deletePhoto()">
										<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] rotate-45"></div>
										<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] -rotate-45"></div>
									</button>
								<?php } ?>


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

								<script type="text/javascript">
									function deletePhoto() {
										var photoId_ = document.getElementById('img');
										photoId_.src = './img/Mask_group.png';
										document.querySelector('.delPhoto').value = 'false';
									}

									window.addEventListener('load', function() {
									  document.querySelector('input[type="file"]').addEventListener('change', function() {
									      if (this.files && this.files[0]) {
									          var img = document.querySelector('img');
									          img.onload = () => {
									              URL.revokeObjectURL(img.src);
									          }

									          img.src = URL.createObjectURL(this.files[0]);
									          document.querySelector('.delPhoto').value = 'true';
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
</footer>	</div>

	
</body>
</html>
