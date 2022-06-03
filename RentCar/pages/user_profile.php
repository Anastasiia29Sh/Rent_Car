<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Мой профиль'; 
require_once "head.php";
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>

		<div class="profile">
			<h3>Мой профиль</h3>

			<?php
			// подключаемся к базе
			include ("../data_processing/bd.php");
			$id_user = $_COOKIE['id_user'];
			$user = mysqli_query($db, "SELECT * FROM all_users user WHERE user.id='$id_user'") or die(mysqli_error($db));
		   $myuser = mysqli_fetch_assoc($user);
			$first_name = isset($first_name1) ? $first_name1 : $myuser['first_name'];
			$last_name = isset($last_name1) ? $last_name1 : $myuser['last_name'];
			$patronymic = isset($patronymic1) ? $patronymic1 : $myuser['patronymic'];
			$date_birth = isset($date_birth1) ? $date_birth1 : $myuser['date_birth'];
			$passport = isset($passport1) ? $passport1 : $myuser['passport'];
			$email = isset($email1) ? $email1 : $myuser['email'];
			$driver_license = isset($driver_license1) ? $driver_license1 : $myuser['driver_license'];
			$tel = isset($tel1) ? $tel1 : $myuser['tel'];
			$password = isset($password1) ? $password1 : $myuser['password'];
			$status = $myuser['status'];
			?>

			<form action="user_profile_processing.php" method="post">
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
				<label>Пароль: <br>
					<input type="password" name="password" value="<?=$password?>">
				</label>

				<input type="submit" name="leave" value="Выйти" class="submit">

				<div id="set"></div>
				<input type="submit" name="settings" value="Настройки сайта" class="submit" id="settings">

				<input type="submit" name="save" value="Сохранить" class="submit">

			</form>
			<p style="color: red; font-size: 1.1em;"><?=isset($mes)? $mes : "";?></p>
			
		</div>

		<?php
		if($status=='admin'){
			?>
			<script>
				document.getElementById("set").style.display = "none";
			</script>
			<?php
		}
		else{
			?>
			<script>
				document.getElementById("settings").style.display = "none";
			</script>
			<?php
		}
		?>




   <!-- footer -->
		<?php
		require_once "footer.php";
		?>

   </div>


</body>
</html>