<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php
$title = 'Аренда авто';
require_once "pages/head.php";

// $src="data_processing/bd.php";
include "pages/count.php";
?> 

<body>

	<div class="main">

		<header>
			<div class="logo">
				<a href="main.php" class="text_logo"><span>R</span>entCar</a>
				<div></div>
				<img src="img/logo.png" alt="">
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
					window.location.href = "pages/user_profile.php";
				}
			};
		</script>

		<menu>
			<a href="main.php">Автопарк</a>
			<a href="pages/prices.php">Тарифы</a>
			<a href="pages/services.php">Услуги</a>
			<a href="pages/stock.php">Акции</a>
			<a href="pages/rent_terms.php">Условия аренды</a>
			<a href="pages/about_company.php">О компании</a>
			<a href="pages/contacts.php">Контакты</a>
		</menu>
		<style>
			menu a:nth-child(1) {
				color: #FFDA15;
			}
		</style>

		<!-- вход в свой профиль -->
		<section class="entrance" id="entrance">
			<a href="#" onmousedown="noneDiv()"></a>
			<h3>Войти или создать профиль</h3>
			<script>
			function noneDiv(){
				document.getElementById("entrance").style.display = "none";
			};
		   </script>
			<form action="authorization_processing.php" method="post">
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




		<section class="cover">
			<img src="img/Car1.png" alt="">
			<h1>Аренда авто в <br>Санкт-Петербурге</h1>
			<a href="#" onmousedown="viewDiv2()">Забронировать</a>
		</section>
		<script>
			let un1 = String(document.getElementById("uname").textContent);
			function viewDiv2(){
				if(un1 == "Профиль"){
					document.getElementById("entrance").style.display = "block";
				}
				else window.location.href = "pages/form_booking.php";
			};
		</script>
		

		<section class="services">
			<a href="#" class="ser1">Автомобиль на свадьбу</a>
			<a href="#" class="ser2">Аренда с водителем</a>
			<a href="#" class="ser3">Дополнительные услуги</a>
		</section>


		<section class="list_cars" id="list_cars">
			<!-- ПОИСК -->
			<h3>Выбрать автомобиль в аренду</h3>
			<div class="search">
				<form action="search_car.php" method="post">
					<div class="div_brand">
						<label>МАРКА:<br>
							<select name="brandd[]" onchange="if (this.selectedIndex) this.form.submit ()">
								<option value="all_brand" <?=isset($brandd) ? '' : 'selected'?> onclick='this.form.submit()' >Все</option>
								<?php
								// подключаемся к базе
								include ("data_processing/bd.php");
								$result = mysqli_query($db, "SELECT * FROM brand ") or die(mysqli_error($db));
								//получаем массив всех данных
								while($res = mysqli_fetch_array($result)){
								?>
								<option <?=isset($brandd) && $brandd==$res['title'] ? 'selected' : ''?> value="<?=$res['title']?>"  ><?=$res['title']?>
							   </option>
								<?php
								}
								?>
							</select>
							</label>
					</div>
					<div class="div_class">
						<label>КЛАСС:</label><br>
						<input type="submit" name="Economy" value="Эконом" id="Ec">
						<input type="submit" name="Comfort" value="Комфорт" id="Com">
						<input type="submit" name="Business" value="Бизнес" id="Bus">
						<input type="submit" name="Minibus" value="Микроавтобус" id="Mimi">
						<input type="submit" name="SUVs" value="Внедорожники" id="SUV">
						<br>
						<input type="radio" name="all_class" value = "all_class" <?=isset($class) && $class!='all' ? '' : 'checked'?> onclick='this.form.submit()'>Все классы
					</div>
					<div class="div_price">
						<?php
						// подключаемся к базе
						include ("data_processing/bd.php");
						$result = mysqli_query($db, "SELECT MAX(price_day) as max_price FROM all_cars ") or die(mysqli_error($db));
						$max = mysqli_fetch_assoc($result);
						$max_price = (int)$max['max_price'];
						$result = mysqli_query($db, "SELECT min(price_day) as min_price FROM all_cars  ") or die(mysqli_error($db));
						$min = mysqli_fetch_assoc($result);
						$min_price = (int)$min['min_price'];
						?>
						<label>СТОИМОСТЬ В СУТКИ:<br>
							<div>
								<p><?=$min_price?> &#8381</p>
								<p>&#8212</p>
								<p><?=$max_price?> &#8381</p>
							</div>
							<input type="range" name="price" min="<?=$min_price?>" max="<?=$max_price?>" value="<?=isset($set_price) ? $set_price : $min_price?>"
								onchange="document.getElementById('rangeValue').innerHTML = this.value;" onclick='this.form.submit()' >
							<p id="rangeValue"> <?=isset($set_price) ? $set_price : $min_price?> </p>

						</label>
					</div>
				</form>
			</div>



			<!-- КАРТОЧКИ С МАШИНАМИ -->
			<!-- ************************************************************************** -->
			<div class="cards" id="container_cards" name="icards">
				<?php
				if(!isset($poisk)){
					$result1 = mysqli_query($db, "select * from all_cars where status!='delete'") or die(mysqli_error($db));			
				}
				//получаем массив всех данных
			   while($res = mysqli_fetch_array($result1)){
				if($res['src_img'] == null) $src_img = "i.webp";
				else $src_img = $res['src_img'];
				?>

				<div type="submit" onclick="window.location.href = 'pages/car_booking.php?id=<?=$res['id']?>';" class="but">
					<h4><?=$res['model']?></h4>
					<div class="img">
						<img src="img/car/<?=$src_img?>" alt="<?=$res['model']?>">
					</div>
					<ul>
						<li>Мощность: <?=$res['engine_power']?></li>
						<li>Объем двигателя: <?=$res['engine_volume']?></li>
						<li>Год выпуска: <?=$res['year_start']?></li>
						<li>Залог: <?=$res['prepayment']?> &#8381</li>
					</ul>
					<div class="cp">
						<span class="car_price"><?=$res['price_day']?> &#8381</span>
						<span class="pday">сутки</span>
						<a href="pages/car_booking.php?id=<?=$res['id']?>#booking" >Забронировать</a>
					</div>
				</div>
			  
			<?php
			}
			?>
			
			</div>

			<!-- require_once "search_car.php"; -->
			<!-- ************************************************************************** -->
		</section>



		<section class="booking_requirements">
			<div class="booking">
				<h3>Как забронировать автомобиль?</h3>
				<ol>
					<li>Оформляете заявку на сайте, через онлайн-консультанта или по телефону: <br> 8 (912) 909-15-25.</li>
					<li>Согласовываете дату и время аренды с менеджером.</li>
					<li>Забираете машину в пункте проката.</li>
					<li>Подписываете договор, вносите залог, оплачиваете стоимость проката автомобиля.</li>
				</ol>
			</div>
			<img src="img/tesla.png" alt="">
			<div class="requirements">
				<h3>ТРЕБОВАНИЯ К ВОДИТЕЛЮ:</h3>
				<p class="driver_license">Водительское удостоверение</p>
				<p class="passport">Паспорт</p>
				<p class="age22">Возраст от 21 года</p>
				<p class="experience">Стаж вождения более 2 лет</p>
			</div>
		</section>



		<section class="advantages">
			<div class="new_cars">
				<img src="img/ExecutiveCar_Black_icon-icons.com_54904.png" alt="">
				<p>Новые машины 2016-2021 года.</p>
			</div>
			<div class="diversity">
				<img src="img/CSR_Racing_icon-icons.com_75325.png" alt="">
				<p>Автомобили эконом-, бизнес- и премиум-класса.</p>
			</div>
			<div class="technical_inspection">
				<img src="img/magnifier_and_car_icon-icons.com_71919.png" alt="">
				<p>Сдаем транспорт напрокат после обязательного техосмотра.</p>
			</div>
			<div class="support">
				<img src="img/-customer-service-agent_89777.png" alt="">
				<p>Круглосуточная поддержка клиентов без выходных и праздников.</p>
			</div>
		</section>



		<section class="info">
			<p>Прокат автомобилей в Санкт-Петербурге RentCar - это удобство и доступность, надежность сотрудничества и
				высокое качество прокатных автомобилей и сервиса.</p>
			<a href="#" onmousedown="viewDiv2()">Забронировать</a>
		</section>



		<div class="world">
        <div class="highway"></div>
        <div class="city"></div>
        <div class="car">
            <img src="img/car.png" alt="" class="anicar">
        </div>
        <div class="wheel">
            <img src="img/wheel.png" alt="" class="back-wheel">
            <img src="img/wheel.png" alt="" class="front-wheel">
        </div>
		</div>


		<footer>
			<div class="footer_top">
				<div class="footer_logo">
					<div class="flogo_img">
						<img src="img/logo.png" alt="">
					</div>
					<div class="flogo_text">
						<!-- <h3 class="ftext_logo"><span>R</span>entCar</h3> -->
						<a href="main.php" class="ftext_logo"><span>R</span>entCar</a>
						<p>Аренда авто в Санкт-Петербурге</p>
					</div>
				</div>
				<div class="footer_contact">
					<p class="ftel">8 (912) 909-15-25</p>
					<p class="femail">rent_car@mail.ru</p>
				</div>
				<div class="footer_address">
					<p class="fcite">Санкт-Петербург</p>
					<p class="fdop_address">ул.Котиков, д.15, корп.3</p>
					<div class="soc_network">
						<a href="#" class="telegram"></a>
						<a href="#" class="whatsapp"></a>
						<a href="#" class="viber"></a>
					</div>
				</div>
			</div>
			<div class="footer_bottom">
				<p>&copy <?=date('Y')?> RentCar | прокат автомобилей. Все права защищены.</p>
			</div>
		</div>
	</footer>


</body>
</html>