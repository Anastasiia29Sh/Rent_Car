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

      <div class="del_car">
			<h3>Удалить автомобиль</h3>

			<form action="del_car_processing.php" method="post">
				
				<?php
				// подключаемся к базе
				include ("../data_processing/bd.php");
				$result = mysqli_query($db, "select * from all_cars where status!='delete'") or die(mysqli_error($db));
				//получаем массив всех данных
			   while($res = mysqli_fetch_array($result)){
				?>
				<label>
				<input type="checkbox" name="delete[]" value="<?=$res['id']?>"> <?=$res['model']?><br>
				</label>
				<?php
				}
				?>

            <input type="submit" name="back" value="Назад" style="margin-top: 3%; margin-left: -15%;">

				<input type="submit" name="del_car" value="Удалить">

				
			</form>

		</div>

		<!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>