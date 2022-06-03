<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Аренда авто'; 
require_once "head.php";
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>

      <div class="del_car">
			<h3>Удалить аккаунт водителя</h3>

			<form action="del_driver_processing.php" method="post">
				
				<?php
				// подключаемся к базе
				include ("../data_processing/bd.php");
				$sql = "SELECT * FROM all_drivers where status_dr!='delete'";
				$result = $conn->query($sql);
				while($res = $result->fetch()){
				?>
				<label>
				<input type="checkbox" name="delete[]" value="<?=$res['id']?>"> <?=$res['last_name'] . ' ' . $res['first_name'] . ' ' . $res['patronymic']?><br>
				</label>
				<?php
				}
				?>

            <input type="submit" name="back" value="Назад" style="margin-top: 3%; margin-left: -15%;">

				<input type="submit" name="del_car" value="Удалить">

				
			</form>

		</div>

		<!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>