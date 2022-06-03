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

      <div class="edit_car">
			<h3>Редактирование</h3>
			<table>
				<tr>
					<th>Водитель</th>
				</tr>

				<?php
				// подключаемся к базе
				include ("../data_processing/bd.php");
				$sql = "SELECT * FROM all_drivers where status_dr!='delete'";
				$result = $conn->query($sql);
				while($res = $result->fetch()){
				?>
				<tr>
					<td><?=$res['last_name'] . ' ' . $res['first_name'] . ' ' . $res['patronymic']?></td>
					<td><a href="edit_driver_processing.php?id=<?=$res['id']?>">Изменить</a></td>
				</tr>
				<?php
				}
				?>
			</table>

			<a href="admin.php" class="back">Назад</a>

		</div>

		<!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>