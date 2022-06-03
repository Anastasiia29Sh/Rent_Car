<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Контакты'; 
require_once "head.php";
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>
		<style>
			menu a:nth-child(7) {
				color: #FFDA15;
			}
		</style>

		<div class="cont">
			<h3>Наши контакты</h3>

			<div class="c">
			<div>
				<h4>Наш адрес:</h4>
			   <p>ул.Котиков, д.15, корп.3</p>
			</div>

			<div>
				<h4>Часы работы:</h4>
			   <p>Ежедневно с 10:00 до 20:00</p>
		   </div>

			<div>
				<h4>Телефон:</h4>
			   <p>8 (912) 909-15-25</p>
		   </div>

			<div>
				<h4>e-mail:</h4>
			   <p>rent_car@mail.ru</p>
			</div>
			</div>

			<div class="cont_soc_network">
				<a href="#" class="ctelegram"></a>
				<a href="#" class="cwhatsapp"></a>
				<a href="#" class="cviber"></a>
			</div>

			<img src="../img/contact-us.jpg" alt="">

		</div>



<!-- footer -->
		<?php
		require_once "footer.php";
		?>

   </div>

</body>
</html>