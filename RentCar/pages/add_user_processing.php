<?php
   $mes = "";
	// подключаемся к базе
	include ("../data_processing/bd.php");

   # Если кнопка "Добавить" нажата
	if( isset( $_POST['add'] ) ){

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$date_birth = $_POST['date_birth'];
		$passport = $_POST['passport'];
		$driver_license = $_POST['driver_license'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$patronymic = $_POST['patronymic'];
		$status = 'driver';
		$password = $_POST['password'];
		$experience = $_POST['experience'];
		$price_day = $_POST['price_day'];

		$is_login = mysqli_query($db, "SELECT is_login('$email') as is_log") or die(mysqli_error($db));
		$is_l = mysqli_fetch_assoc($is_login);

		$is_password = mysqli_query($db, "SELECT is_password('$password') as is_pass") or die(mysqli_error($db));
		$is_pass = mysqli_fetch_assoc($is_password);


	   if($first_name == "" || $last_name == "" || $date_birth == null || $passport == "" || $driver_license == "" || $email == "" || $tel == "" || $password == "" || $experience == null || $price_day == ""){
			$mes = "Пожалуйста, введите все данные";
			require_once "add_user.php";
		}
		elseif(strlen($first_name) < 2 || strlen($last_name) < 2 || strlen($patronymic) == 1 || strlen($patronymic) == 2 || strlen($driver_license) != 10 || strlen($passport) != 10 || !preg_match('/^\d+$/', $driver_license) || !preg_match('/^\d+$/', $passport) || strlen($tel) != 11 || !preg_match('/^\d+$/', $tel) || !preg_match('/^\d+$/', $price_day)){
			$mes = "Вы ввели некорректные данные";
			require_once "add_user.php";
		}
		elseif(strlen($password) < 8){
			$mes = "Пароль должен состоять из 8 и более символов";
			require_once "add_user.php";
		}
		elseif($is_l['is_log'] == 1){
			$mes = "Пользователь с таким email уже существует";
			require_once "add_user.php";
		}
		elseif($is_pass['is_pass'] == 1){
			$mes = "Такой пароль уже существует";
			require_once "add_user.php";
		}
		else{
			$mes = "";

			// SQL-выражение для добавления данных
         $sql = "call add_driver(:userpassport, :userfirst_name, :userlast_name, :userpatronymic, :userdriver_license, :userdate_birth, :useremail, :usertel, :userstatus, :userpassword, :userexperience, :userprice_day)";
			$stmt = $conn->prepare($sql);
			$rowsNumber = $stmt->execute(array(":userpassport" => $passport, ":userfirst_name" => $first_name, ":userlast_name" => $last_name, ":userpatronymic" => $patronymic, ":userdriver_license" => $driver_license, ":userdate_birth" => $date_birth, ":useremail" => $email, ":usertel" => $tel, ":userstatus" =>$status, ":userpassword" =>$password, ":userexperience" =>$experience, ":userprice_day" =>$price_day));
			

			$mes = "Водитель успешно добавлен";

			require_once "add_user.php";

		}
	}

	# Если кнопка "Назад" нажата
	if( isset( $_POST['back'] ) ){
		require_once "admin.php";
	}


?>