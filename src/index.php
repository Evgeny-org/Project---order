<?php
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ALL);
	
	session_start();
	if($_SESSION['user']) {
		header('Location: profile.php');
	} elseif ($_SESSION['admin']) {
		header('Location: admin.php');
	}
?>

<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dmitry</title>
	<link rel="stylesheet" href="CSS/style.css">
	<link href="./output.css" rel="stylesheet">
	<!-- Слайдер -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
	<link rel="stylesheet" href="./CSS/slider.css">
	<!-- ------- -->
</head>
<body class="h-full font-TNRR">
	<div class="min-h-full flex flex-col">

		<header class="w-screen h-[75px] bg-[#D9D9D9] mb-[100px] px-10">
			<div class="max-w-[1600px] h-full mx-auto">
				<div class="h-full flex items-center justify-end">
					<div class="flex justify-end items-center text-2xl">
						<button onclick="showDialogReg()" class="text-[#007bff] cursor-pointer p-0 focus:outline-0 hover:underline">Регистрация</button>

						<!-- Модальное окно "Регистрация" -->
						<div onclick="hideDialogReg()" id="dialogReg" class="w-screen h-screen fixed left-0 top-0 z-10 bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-300 opacity-0 hidden">
							<div onclick="event.stopImmediatePropagation()" class="relative w-2/5 bg-white p-10 shadow-closeDialog">

								<!-- Кнопка "Закрыть" -->
								<button onclick="hideDialogReg()" class="w-12 h-12 absolute top-[-100px] right-[-100px] focus:outline-0 ">
									<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] translate-y-[-50%] rotate-45 z-10"></div>
									<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] translate-y-[-50%] -rotate-45"></div>
								</button>
								<!-- ------- -->

								<!-- Форма "Регистрация"" -->
								<div>
									<form class="flex flex-col text-black" action="./PHP_vendor/signup.php" method="post">
										<h2 class="text-center ">Регистрация</h2>

										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">Логин*</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-right" type="text" name="login">
										</div>

										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">Пароль*</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-right" type="password" name="password">
										</div>

										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">Telegram*</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-right" type="text" name="telegram">
										</div>

										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">ФИО</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-right" type="text" name="full_name">
										</div>

										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">Телефон</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-right" type="text" name="telephone"s>
										</div>

										<div class="flex items-center mb-[40px]">
											<p class="text-2xl m-0">vK</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-right" type="text" name="vk">
										</div>
										<div class="relative w-full">
											<button type="submit" class="block relative z-10 w-8/12 mx-auto font-TNRB text-2xl text-white tracking-[.20em] py-3 bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300 focus:outline-0">Зарегистрироваться</button>
											<div class="w-8/12 h-full bg-[#D9D9D9] absolute top-0 left-2/4 translate-x-[-50%] z-0"></div>
										</div>
									</form>
								</div>
								<!-- ------- -->

							</div>
						</div>
						<!-- ------- -->

						<p class="text-[#007bff] mx-2 m-0">/</p>

						<button onclick="showDialogAuth()" class="text-[#007bff] cursor-pointer p-0 focus:outline-0 hover:underline">Авторизация</button>

						<!-- Модальное окно "Авторизация" -->
						<div onclick="hideDialogAuth()" id="dialogAuth" class="w-screen h-screen fixed left-0 top-0 z-10 bg-black bg-opacity-50 flex justify-center items-center transition-opacity duration-300 opacity-0 hidden">
							<div onclick="event.stopImmediatePropagation()" class="relative w-2/5 bg-white p-10 shadow-closeDialog">

								<!-- Кнопка "Закрыть"" -->
								<button onclick="hideDialogAuth()" class="w-12 h-12 absolute top-[-100px] right-[-100px] focus:outline-0 ">
									<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] translate-y-[-50%] rotate-45 z-10"></div>
									<div class="absolute w-12 h-1.5 bg-white shadow-[0_0_10px_rgba(255,0,0,1)] translate-y-[-50%] -rotate-45"></div>
								</button>
								<!-- ------- -->

								<!-- Форма "Авторизация"" -->
								<div>
									<form class="flex flex-col text-black" action="./PHP_vendor/signin.php" method="post">
										<h2 class="text-center ">Авторизация</h2>
										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">Логин</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-right" type="text" name="login">
										</div>
										<div class="flex items-center mb-[40px]">
											<p class="text-2xl m-0">Пароль</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-2 text-right" type="password" name="password">
										</div>
										<div class="relative w-full">
											<button type="submit" class="block relative z-10 w-8/12 mx-auto font-TNRB text-2xl text-white tracking-[.20em] py-3 bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300 focus:outline-0">Войти</button>
											<div class="w-8/12 h-full bg-[#D9D9D9] absolute top-0 left-2/4 translate-x-[-50%] z-0"></div>
										</div>
										<?php
											if ($_SESSION['messageAuth']) {
												echo 
													'<p class="text-center text-red-600 mt-3"">
														' . $_SESSION['messageAuth'] . '
													</p>';
												unset($_SESSION['messageAuth']);
											} elseif ($_SESSION['messageReg']){
												echo 
													'<p class="text-center text-green-600 mt-3"">
														' . $_SESSION['messageReg'] . '
													</p>';
												unset($_SESSION['messageReg']);
											}
											
										?>
									</form>
								</div>
								<!-- ------- -->

							</div>
						</div>
						<!-- ------- -->
					</div>
				</div>
			</div>
		</header>
		<main class="flex-auto">
			<div class="max-w-[1920px] mx-auto">
				<p class="max-w-[80%] mx-auto text-2xl text-center leading-normal tracking-widest mb-[100px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae auctor risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc et quam aliquet lacus feugiat vehicula sit amet eu neque. Aenean ac dui pellentesque, dignissim ante sed, condimentum ipsum. Quisque sagittis lorem lacus, sit amet tempus sapien semper nec. Integer sagittis euismod</p>
				<!-- Слайдер -->
				<div class="container mb-[100px]">
				  <div class="row cursor-grab active:cursor-grabbing">
				    <div class="swiper-container" id="js-carousel">
				      <div class="swiper-wrapper">
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/664bca768342b505821a725715aea6eba4020f48_original.jpeg" alt="">
				        </div>
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/653552.932x1242.jpg" alt="">
				        </div>
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/6701c401eac7e4c6915f0670139304ca56ee9d33_original.jpeg" alt="">
				        </div>
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/681e52cd1218a5c2544c197b4b820e1c11d52025_original.jpeg" alt="">
				        </div>
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/81173380299.jpg" alt="">
				        </div>
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/rBVa3mIE7o6AUiScAAEwmJ9KFXQ966.jpg" alt="">
				        </div>
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/c646e780a221f0f944b94fecfac879c3a80c9535_original.jpeg" alt="">
				        </div>
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/images.jpeg" alt="">
				        </div>
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/14bf49c5b55b16c5ded910982505e67f340c33d3_original.jpeg" alt="">
				        </div>
				        <div class="swiper-slide" style="text-align: center">
				          <img src="img/himchistka-shapki-muzhskoj-tekstil.jpg" alt="">
				        </div>
				      </div>
				    </div>
				  </div>
				</div>
				<!-- ------- -->
				<div class="flex justify-center mb-[100px]">
					<a href="#" class="block w-[400px] h-[75px] normal-case relative mx-6">
						<div class="w-full h-full bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300">
							<p class="font-TNRB text-3xl text-white tracking-[.20em] whitespace-nowrap absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] mb-0">Сделать заказ</p>
						</div>
						<div class="w-full h-full bg-[#D9D9D9] absolute top-0 left-0 z-[-10]"></div>
					</a>

					<a href="#" class="block w-[400px] h-[75px] normal-case relative mx-6">
						<div class="w-full h-full bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300">
							<p class="font-TNRB text-3xl text-white tracking-[.20em] whitespace-nowrap absolute top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] mb-0">Мои заказы</p>
						</div>
						<div class="w-full h-full bg-[#D9D9D9] absolute top-0 left-0 z-[-10]"></div>
					</a>
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
		function showDialogAuth(){
			// window.location.href = 'index.php#myModal';
			let dialog = document.getElementById('dialogAuth');
			dialog.classList.remove('hidden');
			dialog.classList.add('flex');
			setTimeout(()=>{
				dialog.classList.add("opacity-100");
			}, 1)
		};

		function hideDialogAuth(){
			let dialog = document.getElementById('dialogAuth');
			dialog.classList.add("opacity-0");
			dialog.classList.remove("opacity-100");
			setTimeout(()=>{
				dialog.classList.add('hidden');
				dialog.classList.remove('flex');
			}, 300)
		}

		function showDialogReg(){
			let dialog = document.getElementById('dialogReg');
			dialog.classList.remove('hidden');
			dialog.classList.add('flex');
			setTimeout(()=>{
				dialog.classList.add("opacity-100");
			}, 1)
		};

		function hideDialogReg(){
			let dialog = document.getElementById('dialogReg');
			dialog.classList.add("opacity-0");
			dialog.classList.remove("opacity-100");
			setTimeout(()=>{
				dialog.classList.add('hidden');
				dialog.classList.remove('flex');
			}, 300)
		}
	</script>

	<script src="./JS/slider.js"></script>
</body>
</html>