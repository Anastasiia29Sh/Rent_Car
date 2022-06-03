<?php

# Если кнопка "Удалить" нажата
if( isset( $_POST['del_car'] ) ){

	$mas = $_POST['delete'];
	foreach($mas as $i){
		// подключаемся к базе
		include ("../data_processing/bd.php");
		$result = mysqli_query($db, "CALL delete_car('$i') ") or die(mysqli_error($db));
	}
	$mes = "Данные удалены";

	require_once "delete_car.php";
}
# Если кнопка "Назад" нажата
elseif( isset( $_POST['back'] ) ){
	require_once "admin.php";
}


?>