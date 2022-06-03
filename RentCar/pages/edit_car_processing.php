<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Аренда авто'; 
require_once "head.php";

// подключаемся к базе
include ("../data_processing/bd.php");
$id = $_GET['id'];
$result = mysqli_query($db, "SELECT * FROM all_cars WHERE id = '$id'") or die(mysqli_error($db));
$res = mysqli_fetch_assoc($result);

$price = $res['price_day'];
$prepayment = $res['prepayment'];
$insurance = $res['insurance'];
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>

        <div class="add">
			<h3>Измените данные автомобиля</h3>

			<form action="save_edit_car_processing.php?id=<?=$id?>" method="post">

				<div class="box1">
				<label>win-номер<br>
					<input type="text" name="win_number" value="<?=$res['win_number']?>">
				</label>
				<label>Модель<br>
					<input type="text" name="model" value="<?=$res["model"]?>">
				</label>
				<label>Бренд<br>
				<input type="text" list="brand" name="brandd" readonly value="<?=$res['brand']?>" autocomplete="off"/>
			   </label>

				<input type="submit" name="back" value="Назад" style="margin-top: 5%;">
				</div>


				<div class="box2">
				<label>Год выпуска<br>
					<input type="text" name="year_start" value="<?=$res['year_start']?>">
				</label>
				<label>Мощность двигателя<br>
					<input type="text" name="engine_power" value="<?=$res['engine_power']?>">
				</label>
				<label>Объем двигателя<br>
					<input type="text" name="engine_volume" value="<?=$res['engine_volume']?>">
				</label>
				<label>Расход топлива<br>
					<input type="text" name="fuel_consumption" value="<?=$res['fuel_consumption']?>">
				</label>
				</div>


				<div class="box3">
				<label>Количество мест<br>
					<input type="number" name="count_places" value="<?=$res['count_places']?>">
				</label>
				<label>Цвет<br>
					<input type="text" list="color" name="color" value="<?=$res['color']?>" autocomplete="off"/>
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
						<option name="Economy" value="Эконом" <?=$res['class']=="Эконом" ? 'selected' : ''?> >Эконом</option>
						<option name="Comfort" value="Комфорт" <?=$res['class']=="Комфорт" ? 'selected' : ''?> >Комфорт</option>
						<option name="Business" value="Бизнес" <?=$res['class']=="Бизнес" ? 'selected' : ''?> >Бизнес</option>
						<option name="SUVs" value="Внедорожники" <?=$res['class']=="Внедорожники" ? 'selected' : ''?> >Внедорожники</option>
						<option name="Minibus" value="Микроавтобус" <?=$res['class']=="Микроавтобус" ? 'selected' : ''?> >Микроавтобус</option>
					</select>
				</label>
				<label>Страховка<br>
					<p class="radio"> <input type="radio" name="insurance" value="1" <?=$insurance==1 ? 'checked' : ''?> > Есть </p>
					<p class="radio"> <input type="radio" name="insurance" value="0" <?=$insurance==0 ? 'checked' : ''?> > Нет </p>
				</label>
				</div>


				<div class="box4">
				<label>Цена за сутки<br>
					<input type="text" name="price_day" value="<?=$price?>" >
				</label>
				<label>Залог<br>
					<input type="text" name="prepayment" value="<?=$prepayment?>" >
				</label>
				<label>Загрузите фотографию
				<input type="file" name="photo" id="photo" multiple accept="image/*,image/jpeg">
				</label>

				<input type="submit" name="save_car" value="Сохранить">

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