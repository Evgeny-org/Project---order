		<header class="w-screen h-[75px] bg-[#D9D9D9] mb-[100px]">
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
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-1" type="text" name="login">
										</div>

										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">Пароль*</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-1" type="password" name="password">
										</div>

										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">Telegram*</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-1" type="text" name="telegram">
										</div>

										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">ФИО</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-1" type="text" name="full_name">
										</div>

										<div class="flex items-center mb-3">
											<p class="text-2xl m-0">Телефон</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-1" type="text" name="telephone"s>
										</div>

										<div class="flex items-center mb-[40px]">
											<p class="text-2xl m-0">vK</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-1" type="text" name="vk">
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
											<input class="w-full outline-none border-b-[1px] border-black px-2 pt-1" type="text" name="login">
										</div>
										<div class="flex items-center mb-[40px]">
											<p class="text-2xl m-0">Пароль</p>
											<input class="w-full outline-none border-b-[1px] border-black px-2" type="password" name="password">
										</div>
										<div class="relative w-full">
											<button type="submit" class="block relative z-10 w-8/12 mx-auto font-TNRB text-2xl text-white tracking-[.20em] py-3 bg-black hover:translate-x-[-15px] hover:translate-y-[-15px] duration-300 focus:outline-0">Войти</button>
											<div class="w-8/12 h-full bg-[#D9D9D9] absolute top-0 left-2/4 translate-x-[-50%] z-0"></div>
										</div>
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