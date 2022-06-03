<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Акции'; 
require_once "head.php";
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>
		<style>
			menu a:nth-child(4) {
				color: #FFDA15;
			}
		</style>

      <div class="stockk">
			<h3>Акции</h3>
			<?php
			// подключаемся к базе
			include ("../data_processing/bd.php");
			$result = mysqli_query($db, "SELECT * FROM stock where title not like 'нет'") or die(mysqli_error($db));
			while($res = mysqli_fetch_array($result)){
			?>
			<p><?=$res['title'] . ' -' . $res['discount'] . '%'?></p>
			<?php
			}
			?>
		</div>

<!-- footer -->
		<?php
		require_once "footer.php";
		?>

   </div>

</body>
</html>