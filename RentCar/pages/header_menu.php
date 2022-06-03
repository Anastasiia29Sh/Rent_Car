
<header>
	<div class="logo">
		<a href="../main.php" class="text_logo"><span>R</span>entCar</a>
		<div></div>
		<img src="../img/logo.png" alt="">
	</div>
	<div class="contacts">
		<p class="tel">8 (912) 909-15-25</p>
		<p class="email">rent_car@mail.ru</p>
	</div>
	<div class="schedule">
		<p>Ежедневно с 10:00 до 20:00</p>
	</div>
	<div class="address">
		<p class="cite">Санкт-Петербург</p>
		<p class="dop_address">ул.Котиков, д.15, корп.3</p>
	</div>
	<div class="authorization">
		<a href="#" id="uname" onmousedown="viewDiv()"><?=isset($_COOKIE['user_name']) ? $_COOKIE['user_name'] : "Профиль";?></a>
	</div>
</header>

<script>
			let un = String(document.getElementById("uname").textContent);
			function viewDiv(){
				if(un == "Профиль"){
					document.getElementById("entrance").style.display = "block";
				}
				else{
					window.location.href = "user_profile.php";
				}
			};
</script>


<menu>
	<a href="../main.php">Автопарк</a>
	<a href="prices.php">Тарифы</a>
	<a href="services.php">Услуги</a>
	<a href="stock.php">Акции</a>
	<a href="rent_terms.php">Условия аренды</a>
	<a href="about_company.php">О компании</a>
	<a href="contacts.php">Контакты</a>
</menu>

<!-- вход в свой профиль -->
		<section class="entrance" id="entrance">
			<a href="#" onmousedown="noneDiv()"></a>
			<h3>Войти или создать профиль</h3>
			
			<script>
			function noneDiv(){
				document.getElementById("entrance").style.display = "none";
			};
		</script>
			<form action="../authorization_processing.php" method="post">
				<label>E-mail: <br>
					<input type="text" name="login">
				</label>
				<label>Пароль: <br>
					<input type="password" name="password">
				</label>

				<input type="submit" name="entrance" value="Войти" class="submit">
				<input type="submit" name="registration" value="Регистрация" class="submit">
			</form>
			<p style="color: red;"><?=isset($mes)? $mes : "";?></p>
		</section>