<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Аренда авто'; 
require_once "head.php";
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>

      <div class="edit_car">
			<h3>Редактирование</h3>
			<table>
				<tr>
					<th>Автомобиль</th>
				</tr>

				<?php
				// подключаемся к базе
				include ("../data_processing/bd.php");
				$result1 = mysqli_query($db, "select * from all_cars where status!='delete'") or die(mysqli_error($db));
				//получаем массив всех данных
			   while($res = mysqli_fetch_array($result1)){
				?>
				<tr>
					<td><?=$res['model']?></td>
					<td><a href="edit_car_processing.php?id=<?=$res['id']?>">Изменить</a></td>
				</tr>
				<?php
				}
				?>
			</table>

			<a href="admin.php" class="back">Назад</a>

		</div>

		<!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>