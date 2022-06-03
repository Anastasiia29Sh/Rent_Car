<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Регистрация'; 
require_once "head.php";
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>

		<?php
			$first_name = isset($first_name) ? $first_name : "";
			$last_name = isset($last_name) ? $last_name : "";
			$patronymic = isset($patronymic) ? $patronymic : "";
			$date_birth = isset($date_birth) ? $date_birth : "";
			$passport = isset($passport) ? $passport : "";
			$email = isset($email) ? $email : "";
			$driver_license = isset($driver_license) ? $driver_license : "";
			$tel = isset($tel) ? $tel : "";
			?>

			
      <div class="registration">
			<h3>Регистрация на сайте</h3>

			<form action="registration_processing.php" method="post" id="registration_form">
				   <label>Фамилия: <br>
						<input type="text" name="last_name" value="<?=$last_name?>">
					</label>
					<label>Имя: <br>
						<input type="text" name="first_name" value="<?=$first_name?>">
					</label>
					<label>Отчество: <br>
						<input type="text" name="patronymic" value="<?=$patronymic?>">
					</label>
				<label>Дата рождения: <br>
					<input type="date" name="date_birth" value="<?=$date_birth?>">
				</label>
				<label>Паспорт: <br>
					<input type="text" name="passport" value="<?=$passport?>">
				</label>
				<label>Водительские права: <br>
					<input type="text" name="driver_license" value="<?=$driver_license?>">
				</label>
				<label>E-mail: <br>
					<input type="email" name="email" value="<?=$email?>">
				</label>
				<label>Телефон: <br>
					<input type="tel" name="tel" value="<?=$tel?>">
				</label>
				<div></div>
				<label>Создайте пароль: <br>
					<input type="password" name="password">
				</label>
				<label>Подтвердите пароль: <br>
					<input type="password" name="password2" value="">
				</label>

				<input type="submit" name="registration" value="Зарегистрироваться" class="submit">

			</form>

			<p style="color: red; font-size: 1.1em;"><?=isset($mes)? $mes : "";?></p>

			<div class="registration_success" id="registration_success">
				<p>Поздравляем! Вы успешно зарегистрировались.</p>
				<a href="#" id="uname" onmousedown="viewDiv()">Войти</a>
			</div>

			<script>
			function viewDiv(){
				document.getElementById("entrance").style.display = "block";
			};
		  </script>

		</div>

    <!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>