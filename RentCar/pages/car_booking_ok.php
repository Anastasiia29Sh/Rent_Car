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

      <div class="rent_ok">
			<h3>Бронирование прошло успешно</h3>
			
			<a href="../file_rent/<?=$filename?>" download=''>Договор</a>
		</div>

		<!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>