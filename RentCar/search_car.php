<?php

$poisk = 1;
// подключаемся к базе
include ("data_processing/bd.php");

$result = mysqli_query($db, "SELECT min(price_day) as min_price FROM all_cars  ") or die(mysqli_error($db));
$min = mysqli_fetch_assoc($result);


if(isset( $_POST['Economy'])) {$class = "Эконом"; $cl_id = "Ec";}
elseif(isset( $_POST['Comfort'])) {$class = 'Комфорт'; $cl_id = "Com";}
elseif(isset( $_POST['Business'])) {$class = 'Бизнес'; $cl_id = "Bus";}
elseif(isset( $_POST['Minibus'])) {$class = 'Микроавтобус'; $cl_id = "Mini";}
elseif(isset( $_POST['SUVs'])) {$class = 'Внедорожники'; $cl_id = "SUV";}
elseif(isset($_POST['all_class']) && $_POST['all_class'] == 'all_class') $class = 'all';

$brandd = $_POST['brandd'][0];
$set_price = $_POST['price'];

// если ничего не указано
if($_POST['brandd'][0] == 'all_brand' && (!isset($class) || $class == 'all') && (!isset($_POST['price']) || $set_price==$min['min_price'] ) ){
	$result1 = mysqli_query($db, "select * from all_cars where status!='delete'") or die(mysqli_error($db));
}
// если в форме указан только бренд
elseif($brandd != 'all_brand' && (!isset($class) || $class == 'all') && $set_price==$min['min_price']){
	$result1 = mysqli_query($db, "SELECT * FROM all_cars WHERE brand = '$brandd' and status != 'delete'") or die(mysqli_error($db));
}
// если в форме указан только класс
elseif($brandd == 'all_brand' && (isset($class) && $class != 'all') && $set_price==$min['min_price']){
	$result1 = mysqli_query($db, "SELECT * FROM all_cars WHERE class = '$class' and status != 'delete'") or die(mysqli_error($db));
}
// если в форме указана только цена
elseif($brandd == 'all_brand' && (!isset($class) || $class == 'all') && $set_price!=$min['min_price']){
	$result1 = mysqli_query($db, "SELECT * FROM all_cars WHERE price_day >= '$set_price' and status != 'delete'") or die(mysqli_error($db));
}
// если в форме указан бренд и класс
elseif($brandd != 'all_brand' && (isset($class) && $class != 'all') && $set_price==$min['min_price']){
	$result1 = mysqli_query($db, "SELECT * FROM all_cars WHERE brand = '$brandd' AND class = '$class' and status != 'delete'") or die(mysqli_error($db));
}
// если в форме указан бренд и цена
elseif($brandd != 'all_brand' && (!isset($class) || $class == 'all') && $set_price!=$min['min_price']){
	$result1 = mysqli_query($db, "SELECT * FROM all_cars WHERE brand = '$brandd' AND price_day >= '$set_price' and status != 'delete'") or die(mysqli_error($db));
}
// если в форме указан класс и цена
elseif($brandd == 'all_brand' && (isset($class) && $class != 'all') && $set_price!=$min['min_price']){
	$result1 = mysqli_query($db, "SELECT * FROM all_cars WHERE class = '$class' AND price_day >= '$set_price' and status != 'delete'") or die(mysqli_error($db));
}
// если в форме указан бренд,  класс и цена
elseif($brandd != 'all_brand' && (isset($class) && $class != 'all') && $set_price!=$min['min_price']){
	$result1 = mysqli_query($db, "SELECT * FROM all_cars WHERE class = '$class' AND brand = '$brandd' AND price_day >= '$set_price' and status != 'delete'") or die(mysqli_error($db));
}

require_once "main.php";

?>

<script>document.getElementById("<?=$cl_id?>").style.border = "1px solid #ff3700";</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('#container_cards').offset().top
    }, 'slow');
});
</script>