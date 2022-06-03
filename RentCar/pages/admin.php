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

		<div class="functional">
			<h3>Вы вошли как администратор</h3>

			<div class="func">
            <div class="fun_cars">
					<h4>Автомобили</h4>
					<a href="add_car.php">Добавить</a><br>
					<a href="edit_car.php">Редактировать</a><br>
					<a href="delete_car.php">Удалить</a>
				</div>

				<div class="fun_employees">
					<h4>Сотрудники</h4>
					<a href="add_user.php">Добавить</a><br>
					<a href="edit_user.php">Изменить данные</a><br>
					<a href="delete_driver.php">Удалить</a>
				</div>

				<div class="statistics">
					<h4>Статистика</h4>
					<a href="statistics.php">Смотри</a>
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