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

		<div class="profile">
			<h3>Добавьте нового водителя</h3>

			<form action="add_user_processing.php" method="post">
				   <label>Фамилия: <br>
						<input type="text" name="last_name" value="<?=isset($last_name) ? $last_name : ''?>" >
					</label>
					<label>Имя: <br>
						<input type="text" name="first_name" value="<?=isset($first_name) ? $first_name : ''?>">
					</label>
					<label>Отчество: <br>
						<input type="text" name="patronymic" value="<?=isset($patronymic) ? $patronymic : ''?>">
					</label>
				<label>Дата рождения: <br>
					<input type="date" name="date_birth" value="<?=isset($date_birth) ? $date_birth : ''?>">
				</label>
				<label>Паспорт: <br>
					<input type="text" name="passport" value="<?=isset($passport) ? $passport : ''?>">
				</label>
				<label>Водительские права: <br>
					<input type="text" name="driver_license" value="<?=isset($driver_license) ? $driver_license : ''?>">
				</label>
				<label>E-mail: <br>
					<input type="email" name="email" value="<?=isset($email) ? $email : ''?>">
				</label>
				<label>Телефон: <br>
					<input type="tel" name="tel" value="<?=isset($tel) ? $tel : ''?>">
				</label>
				<label>Пароль: <br>
					<input type="password" name="password">
				</label>
				<label>Статус: <br>
				   <input type="text" name="status" value="Водитель" disabled>
				</label>
				<label>Водительский стаж: <br>
					<input type="number" name="experience" value="<?=isset($experience) ? $experience : ''?>">
				</label>
				<label>Цена/сутки: <br>
					<input type="text" name="price_day" value="<?=isset($price_day) ? $price_day : ''?>">
				</label>


				<input type="submit" name="back" value="Назад" class="submit">

				<div id="set"></div>

				<input type="submit" name="add" value="Добавить" class="submit">

			</form>
			<p style="color: red; font-size: 1.1em;"><?=isset($mes)? $mes : "";?></p>
			
		</div>

		<!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>