<?php

$win_number = $_POST['win_number'];
$model = $_POST['model'];
$brand = $_POST['brandd'];
$year_start = $_POST['year_start'];
$engine_power = $_POST['engine_power'];
$engine_volume = $_POST['engine_volume'];
$fuel_consumption = $_POST['fuel_consumption'];
$count_places = $_POST['count_places'];
$color = $_POST['color'];
$class = $_POST['class'][0];
$insurance = $_POST['insurance'];
$price_day = $_POST['price_day'];
$prepayment = $_POST['prepayment'];
$photo_car = $_FILES["photo"]["name"];

$target_dir = "../img/car/";
$target_file = $target_dir . $_FILES["photo"]["name"];


// echo $_FILES["photo"]["name"];

# Если кнопка "Добавить" нажата
if( isset( $_POST['add_car'] ) ){
	if($win_number == "" || $model == "" || $brand == "" || $year_start == "" || $engine_power == "" || $engine_volume == "" || $fuel_consumption == "" || $count_places == null || $color == "" || $class == "" || $insurance == "" || $price_day == "" || $prepayment == ""){
		$mes = "Пожалуйста, введите все данные";
		require_once "add_car.php";
	}
	elseif(strlen($win_number) != 17 || strlen($year_start) != 4 || !preg_match('/^\d+$/', $year_start) || !preg_match('/^\d+$/', $price_day) || !preg_match('/^\d+$/', $prepayment)){
		$mes = "Вы ввели некорректные данные";
		require_once "add_car.php";
	}
	elseif (file_exists($target_file)) {
    $mes = "Извините, файл уже существует";
    $uploadOk = 0;
	 require_once "add_car.php";
   }
	else{
		move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
		// подключаемся к базе
		include ("../data_processing/bd.php");
		$count = mysqli_query($db, "SELECT is_model('$model') as count_car ") or die(mysqli_error($db));
		$c = mysqli_fetch_assoc($count);
		if($c['count_car'] == 1){
			$mes = "Такой автомобиль уже существует";
		}
		else{
			$result = mysqli_query($db, "CALL add_car ('$win_number', '$model', '$brand', '$year_start', '$engine_power', '$engine_volume', '$fuel_consumption', '$count_places', '$color', '$class', '$insurance', '$price_day', '$prepayment', '$photo_car') ") or die(mysqli_error($db));

		    $mes = "Новый автомобиль успешно добавлен";
		}

		require_once "add_car.php";
	}
}
# Если кнопка "Назад" нажата
elseif( isset( $_POST['back'] ) ){
	require_once "admin.php";
}


?>