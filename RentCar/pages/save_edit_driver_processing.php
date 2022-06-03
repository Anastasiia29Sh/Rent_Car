<?php
   $mes = "";
	// подключаемся к базе
	include ("../data_processing/bd.php");

	$id = $_GET['id'];

   # Если кнопка "Добавить" нажата
	if( isset( $_POST['save'] ) ){

		$first_name1 = $_POST['first_name'];
		$last_name1 = $_POST['last_name'];
		$date_birth1 = $_POST['date_birth'];
		$passport1 = $_POST['passport'];
		$driver_license1 = $_POST['driver_license'];
		$email1 = $_POST['email'];
		$tel1 = $_POST['tel'];
		$patronymic1 = $_POST['patronymic'];
		$status1 = 'driver';
		$password1 = $_POST['password'];
		$experience1 = $_POST['experience'];
		$price_day1 = $_POST['price_day'];


	   if($first_name1 == "" || $last_name1 == "" || $date_birth1 == null || $passport1 == "" || $driver_license1 == "" || $email1 == "" || $tel1 == "" || $password1 == "" || $experience1 == null || $price_day1 == ""){
			$mes = "Пожалуйста, введите все данные";
			require_once "edit_driver_processing.php";
		}
		elseif(strlen($first_name1) < 2 || strlen($last_name1) < 2 || strlen($patronymic1) == 1 || strlen($patronymic1) == 2 || strlen($driver_license1) != 10 || strlen($passport1) != 10 || !preg_match('/^\d+$/', $driver_license1) || !preg_match('/^\d+$/', $passport1) || strlen($tel1) != 11 || !preg_match('/^\d+$/', $tel1) || !preg_match('/^\d+$/', $price_day1)){
			$mes = "Вы ввели некорректные данные";
			require_once "edit_driver_processing.php";
		}
		elseif(strlen($password1) < 8){
			$mes = "Пароль должен состоять из 8 и более символов";
			require_once "edit_driver_processing.php";
		}
		else{
			$mes = "";

			// SQL-выражение для добавления данных
         $sql = "call edit_driver(:userid, :userpassport, :userfirst_name, :userlast_name, :userpatronymic, :userdriver_license, :userdate_birth, :useremail, :usertel, :userstatus, :userpassword, :userexperience, :userprice_day)";
			$stmt = $conn->prepare($sql);
			$rowsNumber = $stmt->execute(array(":userid" => $id, ":userpassport" => $passport1, ":userfirst_name" => $first_name1, ":userlast_name" => $last_name1, ":userpatronymic" => $patronymic1, ":userdriver_license" => $driver_license1, ":userdate_birth" => $date_birth1, ":useremail" => $email1, ":usertel" => $tel1, ":userstatus" =>$status1, ":userpassword" =>$password1, ":userexperience" =>$experience1, ":userprice_day" =>$price_day1));
			

			$mes = "Данные успешно изменины";

			require_once "edit_driver_processing.php";

		}
	}

	# Если кнопка "Назад" нажата
	if( isset( $_POST['back'] ) ){
		require_once "edit_user.php";
	}


?>