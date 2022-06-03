<?php

# Если кнопка "Удалить" нажата
if( isset( $_POST['del_car'] ) ){

	$mas = $_POST['delete'];
	foreach($mas as $i){
		// подключаемся к базе
		include ("../data_processing/bd.php");
		$sql = "call delete_driver(:userid)";
		$stmt = $conn->prepare($sql);
		$rowsNumber = $stmt->execute(array(":userid" => $i));

	}
	$mes = "Данные удалены";

	require_once "delete_driver.php";
}
# Если кнопка "Назад" нажата
elseif( isset( $_POST['back'] ) ){
	require_once "admin.php";
}




?>