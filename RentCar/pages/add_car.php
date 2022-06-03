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

		<div class="add">
			<h3>Добавьте новый автомобиль</h3>

			<form action="add_car_processing.php" method="post" enctype="multipart/form-data">

				<div class="box1">
				<label>win-номер<br>
					<input type="text" name="win_number" value="<?=isset($win_number) ? $win_number : ''?>">
				</label>
				<label>Модель<br>
					<input type="text" name="model" value="<?=isset($model) ? $model : ''?>">
				</label>
				<label>Бренд<br>
				<input type="text" list="brand" name="brandd" value="<?=isset($brand) ? $brand : ''?>" autocomplete="off"/>
				<datalist id="brand">
					<?php
					// подключаемся к базе
					include ("../data_processing/bd.php");
					$result = mysqli_query($db, "SELECT * FROM brand ") or die(mysqli_error($db));
					//получаем массив всех данных
					while($res = mysqli_fetch_array($result)){
					?>
					<option value="<?=$res['title']?>" ><?=$res['title']?></option>
					<?php
					}
					?>
				</datalist>
			   </label>

				<input type="submit" name="back" value="Назад" style="margin-top: 5%;">
				</div>


				<div class="box2">
				<label>Год выпуска<br>
					<input type="text" name="year_start" value="<?=isset($year_start) ? $year_start : ''?>">
				</label>
				<label>Мощность двигателя<br>
					<input type="text" name="engine_power" value="<?=isset($engine_power) ? $engine_power : ''?>">
				</label>
				<label>Объем двигателя<br>
					<input type="text" name="engine_volume" value="<?=isset($engine_volume) ? $engine_volume : ''?>">
				</label>
				<label>Расход топлива<br>
					<input type="text" name="fuel_consumption" value="<?=isset($fuel_consumption) ? $fuel_consumption : ''?>">
				</label>
				</div>


				<div class="box3">
				<label>Количество мест<br>
					<input type="number" name="count_places" value="<?=isset($count_places) ? $count_places : ''?>">
				</label>
				<label>Цвет<br>
					<input type="text" list="color" name="color" value="<?=isset($color) ? $color : ''?>" autocomplete="off"/>
					<datalist id="color">
					<?php
					// подключаемся к базе
					include ("../data_processing/bd.php");
					$result = mysqli_query($db, "SELECT * FROM color ") or die(mysqli_error($db));
					//получаем массив всех данных
					while($res = mysqli_fetch_array($result)){
					?>
					<option value="<?=$res['title']?>" > <?=$res['title']?> </option>
					<?php
					}
					?>
				</datalist>
				</label>
				<label>Класс<br>
					<select name="class[]">
						<option name="Economy" value="Эконом" <?=!isset($class) || $class=="Эконом" ? 'selected' : ''?> >Эконом</option>
						<option name="Comfort" value="Комфорт" <?=isset($class) && $class=="Комфорт" ? 'selected' : ''?> >Комфорт</option>
						<option name="Business" value="Бизнес" <?=isset($class) && $class=="Бизнес" ? 'selected' : ''?> >Бизнес</option>
						<option name="SUVs" value="Внедорожники" <?=isset($class) && $class=="Внедорожники" ? 'selected' : ''?> >Внедорожники</option>
						<option name="Minibus" value="Микроавтобус" <?=isset($class) && $class=="Микроавтобус" ? 'selected' : ''?> >Микроавтобус</option>
					</select>
				</label>
				<label>Страховка<br>
					<p class="radio"> <input type="radio" name="insurance" value="1" <?=!isset($insurance) || $insurance=="1" ? 'checked' : ''?> > Есть </p>
					<p class="radio"> <input type="radio" name="insurance" value="0" <?=isset($insurance) && $insurance=="0" ? 'checked' : ''?> > Нет </p>
				</label>
				</div>


				<div class="box4">
				<label>Цена за сутки<br>
					<input type="text" name="price_day" value="<?=isset($price_day) ? $price_day : ''?>" >
				</label>
				<label>Залог<br>
					<input type="text" name="prepayment" value="<?=isset($prepayment) ? $prepayment : ''?>" >
				</label>
				<label>Загрузите фотографию
				<input type="file" name="photo" id="photo" multiple accept="image/*,image/jpeg">
				</label>

				<input type="submit" name="add_car" value="Добавить">

				</div>

			</form>
			<p style="text-align: center; margin-top: 2%; color: red;"><?=isset($mes) ? $mes : ""?></p>
		</div>

		<!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>