<?php
   # Если кнопка "Сохранить" нажата
	if( isset( $_POST['save'] ) ){

		$first_name1 = $_POST['first_name'];
		$last_name1 = $_POST['last_name'];
		$date_birth1 = $_POST['date_birth'];
		$passport1 = $_POST['passport'];
		$driver_license1 = $_POST['driver_license'];
		$email1 = $_POST['email'];
		$tel1 = $_POST['tel'];
		$password1 = $_POST['password'];
		$patronymic1 = $_POST['patronymic'];

	   if($first_name1 == "" || $last_name1 == "" || $date_birth1 == null || $passport1 == "" || $driver_license1 == "" || $email1 == "" || $tel1 == "" || $password1 == ""){
			$mes = "Пожалуйста, введите все данные";
		}
		elseif(strlen($first_name1) < 2 || strlen($last_name1) < 2 || strlen($patronymic1) == 1 || strlen($patronymic1) == 2 || strlen($driver_license1) != 10 || strlen($passport1) != 10 || !preg_match('/^\d+$/', $driver_license1) || !preg_match('/^\d+$/', $passport1) || strlen($tel1) != 11 || !preg_match('/^\d+$/', $tel1)){
			$mes = "Вы ввели некорректные данные";
		}
		elseif(strlen($password1) < 8){
			$mes = "Пароль должен состоять из 8 и более символов";
		}
		else{
			// подключаемся к базе
			include ("../data_processing/bd.php");
			$id_user = $_COOKIE['id_user'];

			$user2 = mysqli_query($db, "SELECT authorization.id FROM authorization JOIN user ON authorization.login = user.email WHERE user.id='$id_user'") or die(mysqli_error($db));
		   $myuser = mysqli_fetch_assoc($user2);
			$nid = $myuser['id'];

			$user1 = mysqli_query($db, "UPDATE user SET 
			                        first_name = '$first_name1', 
			                        last_name = '$last_name1',
											date_birth = '$date_birth1',
											driver_license = '$driver_license1',
											email = '$email1',
											tel = '$tel1',
											passport = '$passport1',
											patronymic = '$patronymic1'
										WHERE id='$id_user'") or die(mysqli_error($db));

			$user3 = mysqli_query($db, "UPDATE authorization SET 
											authorization.login = '$email1',
											authorization.password = '$password1'
										WHERE id='$nid'") or die(mysqli_error($db));

         
			$user_name = $first_name1 . ' ' . $last_name1;
			setcookie("user_name", $user_name, time() + 43200, '/');

			$mes = "Данные успешно изменины";
		}



		require_once "user_profile.php";
	}

	# Если кнопка "Выйти" нажата
	if( isset( $_POST['leave'] ) ){
		$user_name = $_COOKIE['user_name'];
		setcookie("user_name", "", time() - 43200, '/');
		setcookie("id_user", "", time() - 43200, '/');

		?>
		<script>
			window.location.href = "../main.php";
		</script>
		<?php
		// require_once "../main.php";
	}

	# Если кнопка "Настройки сайта" нажата
	if( isset( $_POST['settings'] ) ){
		?>
		<script>
			window.location.href = "admin.php";
		</script>
		<?php
	}
?>
