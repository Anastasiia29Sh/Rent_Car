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
if($res['src_img'] == null) $src_img = "i.webp";
else $src_img = $res['src_img'];
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>

		<div class="cars">
			<h3><?=$res["model"]?></h3>
			<div class="img_price">
				<div>
				<img src="../img/car/<?=$src_img?>" alt="">
				</div>
				<table>
					<tr>
						<td>1-2 суток</td>
						<td><?=$res['price_day']?> &#8381</td>
					</tr>
					<tr>
						<td>3-6 суток</td>
						<td><?=(int)$res['price_day']*90/100?> &#8381</td>
					</tr>
					<tr>
						<td>7-14 суток</td>
						<td><?=(int)$res['price_day']*80/100?> &#8381</td>
					</tr>
					<tr>
						<td>15-30 суток</td>
						<td><?=(int)$res['price_day']*70/100?> &#8381</td>
					</tr>
					<tr>
						<td>Более 30 суток</td>
						<td><?=(int)$res['price_day']*60/100?> &#8381</td>
					</tr>
					<tr>
						<td>Выходные дни <br>(пт 18:00 - пн 12:00)</td>
						<td><?=(int)$res['price_day']*115*2/100?> &#8381</td>
					</tr>
					<tr>
						<td>Залог</td>
						<td><?=$res['prepayment']?> &#8381</td>
					</tr>
				</table>
			</div>
			<p>Характеристики</p>
			<div class="characteristics">
				<ul>
					<li>Год выпуска: <?=$res['year_start']?></li>
					<li>Мощность двигателя: <?=$res['engine_power']?></li>
					<li>Объем двигателя: <?=$res['engine_volume']?></li>
					<li>Расход топлива: <?=$res['fuel_consumption']?></li>
				</ul>
				<ul>
					<li>Страховка: <?=$res['insurance'] == 1 ? "есть" : "нет";?></li>
					<li>Количество мест: <?=$res['count_places']?></li>
					<li>Цвет: <?=$res['color']?></li>
				</ul>
			</div>
		</div>


		<div class="rent_car" id="booking">
			<h3>Бронь</h3>
			<form action="car_booking_processing.php?id=<?=$id?>" method="post">

				   <select name="modell[]">
						<?php
						$result4 = mysqli_query($db, "SELECT * FROM model ") or die(mysqli_error($db));
						while($res4 = mysqli_fetch_array($result4)){
						?>
						<option <?=$res["model"]==$res4['title'] ? 'selected' : ''?> value="<?=$res4['title']?>"  ><?=$res4['title']?>
						</option>
						<?php
						}
						?>
					</select>

				<div class="time_rent">
					<div class="t1">
					<label> <i> Начало аренды: </i><br>
						<input type="date" name="start_date" value="<?=isset($start_date) ? $start_date : ''?>">
					</label>
					</div>
					<div>
					<label> <i> Конец аренды:</i><br>
						<input type="date" name="end_date" value="<?=isset($end_date) ? $end_date : ''?>">
					</label>
					</div>
				</div>

				<div class="serv1">
				<div class="b1">
				<i> Услуги:</i><br>
					<label><input type="checkbox" name="services[]" value="baby_chair"  >Детское кресло<br></label>
					<label><input type="checkbox" name="services[]" value="animals">Животные<br></label>
					<label><input type="checkbox" name="services[]" value="navigator">Навигатор<br></label>
					<label><input type="checkbox" name="services[]" value="wedding">Свадьба<br></label>
					<label><input type="checkbox" name="services[]" value="driver" onclick="viewDiv()">Водитель</label>
				</div>
				<div class="b2">
				<i> Оплата:</i><br>
					<label><input type="radio" name="payment[]" value="Безналичные" <?=!isset($payment) || $payment=='Безналичные' ? 'checked' : ''?> >Безналичные<br></label>
					<label><input type="radio" name="payment[]" value="Наличные" <?=isset($payment) && $payment=='Наличные' ? 'checked' : ''?>  >Наличные</label>
				</div>
				</div>
				

				<div class="b3" id="driver">
				<i> Водители: </i><br>
				<?php
				   $result5 = mysqli_query($db, "SELECT * FROM all_drivers where status_dr!='delete'") or die(mysqli_error($db));
					while($res5 = mysqli_fetch_array($result5)){
						$year = $res5['date_birth'];
						$result6 = mysqli_query($db, "SELECT user_year('$year') AS user_year") or die(mysqli_error($db));
						$res6 = mysqli_fetch_assoc($result6);
						$id_dr=$res5['id'];
					?>
					<label><input type="radio" name="driver[]" value="<?=$id_dr?>">
					<?=$res5['last_name'] . ' ' . $res5['first_name'] . ': возраст - ' . $res6['user_year'] . ', вод. стаж - ' . $res5['experience'] . ', цена/сутки - ' . $res5['price_day']?><br></label>
					<?php
					}
					?>
				</div>

				<script>
					let count=1;
			   function viewDiv(){
					if(count%2!=0)
					document.getElementById("driver").style.display = "block";
					else
					document.getElementById("driver").style.display = "none";
					count++;
			   };
		      </script>

				
				<input type="submit" name="booking" value="Забронировать">

				<div class="mes_price" id="mes_price">
					<p style="text-align: center; font-size: 1.2em; margin-top:5%">Итого к оплате <?=isset($prise_pay) ? $prise_pay : ''?> </p>
					<input type="submit" name="cancel" value="Отмена" style="margin-left: 28%">
				   <input type="submit" name="ok" value="ОК">
				</div>


			</form>

			<p style="text-align: center; color: red;"><?=isset($mes) ? $mes : ''?></p>
			
		</div>


		<?php
		if(!isset($_COOKIE['user_name'])){
			?>
			<script>
				document.getElementById("booking").style.display = "none";
			</script>
			<p style="text-align: center;">
				Перед бронированием автомобиля войдите в свой аккаунт или загеристрируйтесь.
			</p>
			<?php
		}
		?>


 <!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>