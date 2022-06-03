<?php
   $mes = "";
	// подключаемся к базе
	include ("../data_processing/bd.php");
   # Если кнопка "Зарегистрироваться" нажата
	if( isset( $_POST['registration'] ) ){

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$date_birth = $_POST['date_birth'];
		$passport = $_POST['passport'];
		$driver_license = $_POST['driver_license'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$patronymic = $_POST['patronymic'];
		$status = "user";
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		$is_login = mysqli_query($db, "SELECT is_login('$email') as is_log") or die(mysqli_error($db));
		$is_l = mysqli_fetch_assoc($is_login);

		$is_password = mysqli_query($db, "SELECT is_password('$password') as is_pass") or die(mysqli_error($db));
		$is_pass = mysqli_fetch_assoc($is_password);

	   if($first_name == "" || $last_name == "" || $date_birth == null || $passport == "" || $driver_license == "" || $email == "" || $tel == "" || $password == "" || $password2 == ""){
			$mes = "Пожалуйста, введите все данные";
			require_once "registration.php";
		}
		elseif(strlen($first_name) < 2 || strlen($last_name) < 2 || strlen($patronymic) == 1 || strlen($patronymic) == 2 || strlen($driver_license) != 10 || strlen($passport) != 10 || !preg_match('/^\d+$/', $driver_license) || !preg_match('/^\d+$/', $passport) || strlen($tel) != 11 || !preg_match('/^\d+$/', $tel)){
			$mes = "Вы ввели некорректные данные";
			require_once "registration.php";
		}
		elseif(strlen($password) < 8){
			$mes = "Пароль должен состоять из 8 и более символов";
			require_once "registration.php";
		}
		elseif($password != $password2){
			$mes = "Пароль и подтверждение пароля не совпадают";
			require_once "registration.php";
		}
		elseif($is_l['is_log'] == 1){
			$mes = "Пользователь с таким email уже существует";
			require_once "registration.php";
		}
		elseif($is_pass['is_pass'] == 1){
			$mes = "Такой пароль уже существует";
			require_once "registration.php";
		}
		else{
			$mes = "";
			
			$user1 = mysqli_query($db, "call add_user('$passport', '$first_name', '$last_name', '$patronymic', '$driver_license', '$date_birth', '$email', '$tel', '$status', '$password')") or die(mysqli_error($db));

			require_once "registration.php";

			?>

			<script>
				document.getElementById("registration_form").style.display = "none";
				document.getElementById("registration_success").style.display = "block";
			</script>

			<?php

		}
	}

?>