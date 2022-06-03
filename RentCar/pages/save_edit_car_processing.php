<?php
$id = $_GET['id'];
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
$photo_car = $_POST['photo'];

# Если кнопка "Сохранить" нажата
if( isset( $_POST['save_car'] ) ){
	if($win_number == "" || $model == "" || $brand == "" || $year_start == "" || $engine_power == "" || $engine_volume == "" || $fuel_consumption == "" || $count_places == null || $color == "" || $class == "" || $insurance == "" || $price_day == "" || $prepayment == ""){
		$mes = "Пожалуйста, введите все данные";
		require_once "edit_car_processing.php";
	}
	elseif(strlen($win_number) != 17 || strlen($year_start) != 4 || !preg_match('/^\d+$/', $year_start) || !preg_match('/^\d+$/', $price_day) || !preg_match('/^\d+$/', $prepayment)){
		$mes = "Вы ввели некорректные данные";
		require_once "edit_car_processing.php";
	}
	else{
		// подключаемся к базе
		include ("../data_processing/bd.php");
		
		$result = mysqli_query($db, "CALL edit_car ('$id', '$win_number', '$model', '$brand', '$year_start', '$engine_power', '$engine_volume', '$fuel_consumption', '$count_places', '$color', '$class', '$insurance', '$price_day', '$prepayment', '$photo_car') ") or die(mysqli_error($db));

		$mes = "Данные успешно изменины";

		require_once "edit_car_processing.php";
	}
}
# Если кнопка "Назад" нажата
elseif( isset( $_POST['back'] ) ){
	require_once "edit_car.php";
}


?>