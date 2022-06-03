<?php
      error_reporting(E_ALL);
		ini_set('display_errors', 'on');

		$db = mysqli_connect('localhost','root','vertrigo', 'rent_car') or die(mysqli_error($db));

		// подключаемся к серверу
     $conn = new PDO("mysql:host=localhost; dbname=rent_car", "root", "vertrigo");

		mysqli_query($db, "SET NAMES 'utf8'");
?>