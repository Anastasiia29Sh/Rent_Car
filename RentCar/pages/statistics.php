<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Аренда авто'; 
require_once "head.php";

$r = 8;
$year = isset($_POST['year'][0]) ? $_POST['year'][0] : date('Y');
$start_year = 2021;

// подключаемся к базе
include ("../data_processing/bd.php");
//Имена месяцев
$MonthsNames = array(null, 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
$ResultArray = array_fill(1, 12, 0);

$QueryResult = mysqli_query($db, "SELECT MONTH(u.time) AS Value, COUNT(*) AS Total FROM user u WHERE YEAR(u.time)='$year' GROUP BY Value ") or die(mysqli_error($db));
//Копим всё в массив
while($Row = mysqli_fetch_assoc($QueryResult))
  $ResultArray[$Row['Value']]=$Row['Total'];

?>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		var data = google.visualization.arrayToDataTable([
         ['Месяц', 'Кол-во зарегистрированных пользователей', { role: 'style' }],
         ['Jan', <?=$ResultArray[1]?>, '#b87333'],  
         ['Feb', <?=$ResultArray[2]?>, '#b87333'],
         ['Mar', <?=$ResultArray[3]?>, '#b87333'],
         ['Apr', <?=$ResultArray[4]?>, '#b87333'],
         ['May', <?=$ResultArray[5]?>, '#b87333'],
         ['Jun', <?=$ResultArray[6]?>, '#b87333'],
         ['Jul', <?=$ResultArray[7]?>, '#b87333'],
         ['Aug', <?=$ResultArray[8]?>, '#b87333'],
         ['Sep', <?=$ResultArray[9]?>, '#b87333'],
         ['Oct', <?=$ResultArray[10]?>, '#b87333'],
         ['Nov', <?=$ResultArray[11]?>, '#b87333'],
         ['Dec', <?=$ResultArray[12]?>, '#b87333'],
      ]);

		  var options = {
          chart: {
            title: 'Число зарегистрированных пользователей за <?=$year?> год',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>
    
    <div class="stat_graf">
      <h3>Статистика - число зарегистрированных пользователей за год</h3>
      <form action="statistics.php" method="post">
        <!-- <p>Выберите год</p> -->
        <select name="year[]" onchange="if (this.selectedIndex) this.form.submit ()">
								<option value="<?=$start_year?>" <?=$year==$start_year ? 'selected' : ''?> onclick='this.form.submit()' ><?=$start_year?></option>
                <?php
                while($start_year!=date('Y')){
                  $start_year++;
                ?>
                <option value="<?=$start_year?>" <?=$year==$start_year ? 'selected' : ''?> onclick='this.form.submit()' ><?=$start_year?></option>
                <?php
                }
                ?>
        </select>
      </form>
      

      <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
    </div>
		


 <!-- footer -->
		<?php
		require_once "footer.php";
		?>
   </div>
</body>
</html>