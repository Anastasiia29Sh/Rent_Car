<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Услуги'; 
require_once "head.php";
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>
		<style>
			menu a:nth-child(3) {
				color: #FFDA15;
			}
		</style>

		<div class="serv">
			<h3>Услуги</h3>
			<div class="sdiv">
			<div>
				<p>Детское кресло <br>500 руб.</p>
				<img src="../img/28259b.jpg" alt="">
			</div>
			<div>
				<p>Животные <br>1000 руб.</p>
				<img src="../img/1627470783_31-funart-pro-p-zhivotnie-za-rulem-zhivotnie-krasivo-foto-35.jpg" alt="">
			</div>
			<div>
				<p>Навигатор <br>300 руб.</p>
				<img src="../img/navigacziya.jpg" alt="">
			</div>
			<div>
				<p>Свадьба <br>5000 руб.</p>
				<img src="../img/car15.webp" alt="">
			</div>
			<div>
				<p>Водитель <br>800 руб.</p>
				<img src="../img/Rejting-samyh-udobnyh-mashin-po-mneniju-rossiyan.jpg" alt="">
				<ul>
					<?php
					include ("../data_processing/bd.php");
				   $result = mysqli_query($db, "SELECT * FROM all_drivers where status_dr!='delete'") or die(mysqli_error($db));
					while($res = mysqli_fetch_array($result)){
						$year = $res['date_birth'];
						$result2 = mysqli_query($db, "SELECT user_year('$year') AS user_year") or die(mysqli_error($db));
						$res2 = mysqli_fetch_assoc($result2);
					?>
					<li><?=$res['last_name'] . ' ' . $res['first_name'] . ': возраст - ' . $res2['user_year'] . ', вод. стаж - ' . $res['experience']?></li>
					<?php
					}
					?>
				</ul>
			</div>
			</div>
		</div>

<!-- footer -->
		<?php
		require_once "footer.php";
		?>

   </div>

</body>
</html>