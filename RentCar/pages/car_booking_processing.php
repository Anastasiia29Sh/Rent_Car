<?php
session_start();
// подключаемся к базе
include ("../data_processing/bd.php");
$id_cl = $_COOKIE['id_user'];

$model = $_POST['modell'][0];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$payment = $_POST['payment'][0];


$result0 = mysqli_query($db, "SELECT * from all_cars where model like '$model' ") or die(mysqli_error($db));
$res0 = mysqli_fetch_array($result0);

$id_car = $res0['id'];


# Если кнопка "Забронировать" нажата
if( isset( $_POST['booking'] ) ){
	if($model=="" || $start_date==null || $end_date==null || $payment==null){
		$mes = "Пожалуйста, введите все данные";
		require_once "car_booking.php";
		?>
		<script>
			const el = document.getElementById('booking');
			el.scrollIntoView();
		</script>
		<?php
	}
	else{
		// свободна ли машина на эти даты?
		$result7 = mysqli_query($db, "SELECT is_free_car('$id_car', '$start_date', '$end_date') AS free ") or die(mysqli_error($db));
		$res7 = mysqli_fetch_array($result7);
		if($res7['free']==1){
			$mes = "Данная машина уже занята на эти даты";
		   require_once "car_booking.php";
			?>
		<script>
			const el = document.getElementById('booking');
			el.scrollIntoView();
		</script>
		<?php
		}
		else{
			if(!empty($_POST['services'])){
				$services = $_POST['services']; //массив
				foreach($services as $i){
					if($i=='driver'){
						if(!isset($_POST['driver'][0])){
							$mes = "Пожалуйста, выберите водителя";
		               require_once "car_booking.php";
							?>
		               <script>
			            const el = document.getElementById('booking');
			            el.scrollIntoView();
			            document.getElementById("driver").style.display = "block";
		               </script>
		               <?php
						}
						else{
							$driver = $_POST['driver'][0];
							// свободен ли водитель на эти даты?
							$result8 = mysqli_query($db, "SELECT is_free_drivers('$driver', '$start_date', '$end_date') AS free ") or die(mysqli_error($db));
							$res8 = mysqli_fetch_array($result8);
							if($res8['free']==1){
								$mes = "Выбранный Вами водитель уже занят на эти даты";
		                  require_once "car_booking.php";
								?>
		                  <script>
			               const el = document.getElementById('booking');
			               el.scrollIntoView();
			               document.getElementById("driver").style.display = "block";
		                  </script>
		                  <?php
							}
						}
					}
				}
			}

			$num_contract = mt_rand(100000,999999);
			$result9 = mysqli_query($db, "call add_contract('$id_car', '$num_contract', '$id_cl', '$payment')") or die(mysqli_error($db));

			if(!empty($_POST['services'])){
				$services = $_POST['services']; 
				foreach($services as $i){
					$i = ($i=='baby_chair') ? 'Детское кресло' : ($i=='animals' ? 'Животные' : ($i=='navigator' ? 'Навигатор' : ($i=='wedding' ? 'Свадьба' : 'Водитель')));
					$result10 = mysqli_query($db, "call add_services('$num_contract', '$i')") or die(mysqli_error($db));
				}
			}

			if(!isset($_POST['driver'][0])){
				$result11 = mysqli_query($db, "call add_rent('$num_contract', '$start_date', '$end_date', null)") or die(mysqli_error($db));
			}else{
				$driver = $_POST['driver'][0];
				$result11 = mysqli_query($db, "call add_rent('$num_contract', '$start_date', '$end_date', '$driver')") or die(mysqli_error($db));
			}
			
			
			$_SESSION["num_contract"] = $num_contract;
			
			$mes='';

			$result12 = mysqli_query($db, "select summa('$num_contract') as summ") or die(mysqli_error($db));
			$res12 = mysqli_fetch_array($result12);
			$prise_pay = $res12['summ'];

		   require_once "car_booking.php";
			?>
		   <script>
			const el = document.getElementById('booking');
			el.scrollIntoView();
			document.getElementById("driver").style.display = "block";
			document.getElementById("mes_price").style.display = "block";
		   </script>
		   <?php

		}
	}
}

# Если кнопка "Отмена" нажата
if( isset( $_POST['cancel'] ) ){
	$num_contract = isset($_SESSION["num_contract"]) ? $_SESSION["num_contract"] : '';
	$result13 = mysqli_query($db, "CALL delete_rent('$num_contract') ") or die(mysqli_error($db));

	unset($_SESSION["num_contract"]);

	require_once "car_booking.php";
	?>
 	<script>
	const el = document.getElementById('booking');
	el.scrollIntoView();
	document.getElementById("driver").style.display = "block";
	document.getElementById("mes_price").style.display = "none";
	</script> 
	<?php
}

# Если кнопка "OK" нажата
if( isset( $_POST['ok'] ) ){
	// создать файл,отправить почту
	$num_c = $_SESSION["num_contract"];
	$result14 = mysqli_query($db, "select * from all_rent where num_contract='$num_c'") or die(mysqli_error($db));
	$res14 = mysqli_fetch_array($result14);

	$result15 = mysqli_query($db, "select summa('$num_c') as summ") or die(mysqli_error($db));
	$res15 = mysqli_fetch_array($result15);

	$dir = '../file_rent/';
	$filename = 'Договор_' . $res14['num_contract'] . '.txt';
	$text = 'Договор на аренду автомобиля №' . $res14['num_contract'] . PHP_EOL; 
	$text2 = 'г. Санкт-Петербург, ' . $res14['data_contract'] . PHP_EOL;
	$text3 = 'Арендодатель: ООО "RentCar"' . PHP_EOL;
	$text4 = 'Арендатор: ' . $res14['last_name'] . ' ' . $res14['first_name'] . ' ' . $res14['patronymic'] . PHP_EOL;
	$text5 = 'Автомобиль: ' . $res14['model'] . PHP_EOL;
	$text6 = 'Дата начала аренды: ' . $res14['date_start'] . PHP_EOL;
	$text7 = 'Дата окончания аренды: ' . $res14['date_end'] . PHP_EOL;
	$text8 = 'Сумма: ' . $res15['summ'] . PHP_EOL;

   // Открываем файл, флаг W означает - файл открыт на запись
   $f_hdl = fopen($dir.$filename, 'w');
   // Записываем в файл $text
   fwrite($f_hdl, $text);
	fwrite($f_hdl, $text2);
	fwrite($f_hdl, $text3);
	fwrite($f_hdl, $text4);
	fwrite($f_hdl, $text5);
	fwrite($f_hdl, $text6);
	fwrite($f_hdl, $text7);
	fwrite($f_hdl, $text8);

 	// Закрывает открытый файл
   fclose($f_hdl);
	
   // unset($_SESSION["num_contract"]);

		// ПОЧТА
include '../phpmailer/PHPMailer.php';
include '../phpmailer/SMTP.php';
include '../phpmailer/Exception.php';


$t_d = $res14['data_contract'];
$fio = $res14['last_name'] . ' ' . $res14['first_name'] . ' ' . $res14['patronymic'];
$m = $res14['model'];
$d_s = $res14['date_start'];
$d_e = $res14['date_end'];
$s = $res15['summ'];
$email = $res14['email'];

$message = "<h3>Аренда автомобиля</h3><br>
<p>г. Санкт-Петербург, $t_d</p>
<p>Арендодатель: ООО 'RentCar'</p>
<p>Арендатор: $fio</p>
<p>Автомобиль: $m</p>
<p>Дата начала аренды: $d_s</p>
<p>Дата окончания аренды: $d_e</p>
<p>Сумма: $s</p>";

$to = "<$email>";
$title = "Аренда автомобиля";

$headers  = "Content-type: text/html; charset=windows-1251 \r\n";
$headers .= "From: От кого письмо <from@example.com>\r\n";
$headers .= "Reply-To: reply-to@example.com\r\n";

$mail = new PHPMailer\PHPMailer\PHPMailer();
//$mail = new PHPMailer();
 try {
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth = true;
    $mail->Debugoutput = function ($str, $level) {
       $GLOBALS['status'][] = $str;
    };

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'ansharko29@gmail.com';
    $mail->Password = 'ehvlsorhotdnolmh';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('ansharko29@gmail.com', 'ООО RentCar');

    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = "$message";

    if ($mail->send()) $result = "success";
       else $result = "error";
    }
catch (Exception $e) {
   $result = "error1";
   $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

	require_once "car_booking_ok.php";
}


?>