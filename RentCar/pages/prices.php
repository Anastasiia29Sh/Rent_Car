<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Тарифы'; 
require_once "head.php";
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>
		<style>
			menu a:nth-child(2) {
				color: #FFDA15;
			}
		</style>

		<div class="prices">
			<h3>Тарифы на автомобили</h3>

			<table>
				<tr>
					<th>Автомобиль</th>
					<th>1-2 суток</th>
					<th>3-6 суток</th>
					<th>7-14 суток</th>
					<th>15-30 суток</th>
					<th>Более 30 суток</th>
					<th>Выходные дни</th>
					<th>Залог</th>
				</tr>

				<?php
				// подключаемся к базе
				include ("../data_processing/bd.php");
				$result1 = mysqli_query($db, "select * from all_cars where status!='delete'") or die(mysqli_error($db));
				//получаем массив всех данных
			   while($res = mysqli_fetch_array($result1)){

				?>
				<tr>
					<td><a href="car_booking.php?id=<?=$res['id']?>"><?=$res['model']?></a></td>
					<td><?=$res['price_day']?></td>
					<td><?=(int)$res['price_day']*90/100?></td>
					<td><?=(int)$res['price_day']*80/100?></td>
					<td><?=(int)$res['price_day']*70/100?></td>
					<td><?=(int)$res['price_day']*60/100?></td>
					<td><?=(int)$res['price_day']*115*2/100?> </td>
					<td><?=$res['prepayment']?> </td>
					<td><a href="car_booking.php?id=<?=$res['id']?>#booking">Забронировать</a></td>
				</tr>

				<?php
				}
				?>


			</table>
		</div>


<!-- footer -->
		<?php
		require_once "footer.php";
		?>

   </div>

</body>
</html>