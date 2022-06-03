<?php

# Если кнопка "Войти" нажата
if( isset( $_POST['entrance'] ) ){

	//заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
	if (isset($_POST['login'])) 
	{ 
		$login = $_POST['login']; 
		if ($login == '') { unset($login);} 
	}
	if (isset($_POST['password'])) 
	{
		$password=$_POST['password']; 
		if ($password =='') { unset($password);} 
	}
	//если пользователь не ввел логин или пароль, то выдаем ошибку
	if (empty($login) or empty($password)) {
		$mes = "Пожалуйста, введите все данные";
		require_once "main.php";
?>
	<script>document.getElementById("entrance").style.display = "block";
</script>
<?php
	}
	else{
		//если логин и пароль введены, то обрабатываем их		
		$login = stripslashes($login);
		$login = htmlspecialchars($login);
		$password = stripslashes($password);
		$password = htmlspecialchars($password);
		//удаляем лишние пробелы
		$login = trim($login);
		$password = trim($password);

		
		// подключаемся к базе
		include ("data_processing/bd.php");
		

		// проверка на существование пользователя с таким же логином
		//извлекаем из базы все данные о пользователе с введенным логином
		$result = mysqli_query($db, "SELECT * FROM authorization WHERE login='$login'") or die(mysqli_error($db));
		//получаем массив всех данных
		$myrow = mysqli_fetch_assoc($result);

		$result3 = mysqli_query($db, "SELECT count(id) as count_us FROM all_black where email='$login'") or die(mysqli_error($db));
		$r = mysqli_fetch_assoc($result3);
		
		if (empty($myrow['id']))
		{
			//если пользователя с введенным логином не существует
			$mes = "Извините, введённый вами login или пароль неверный.";
			require_once "main.php";
?>
	<script>document.getElementById("entrance").style.display = "block";</script>
<?php
		}
		elseif($r['count_us'] == 1){
			$mes = "Ваш аккаунт заблокирован.";
			require_once "main.php";
?>
<script>document.getElementById("entrance").style.display = "block";</script>
<?php
		}
		else {
			//если существует, то сверяем пароли
			if ($myrow['password']==$password) {
				// определяем имя вошедшего
				$user = mysqli_query($db, "SELECT * FROM user WHERE email='$login'") or die(mysqli_error($db));
				$myuser = mysqli_fetch_assoc($user);
				$user_name = $myuser['first_name'] . ' ' . $myuser['last_name'];
				setcookie("user_name", $user_name, time() + 43200, '/');
				setcookie("id_user", $myuser['id'], time() + 43200, '/');

				if($myrow['status']!="admin"){
					?>
				   <script> window.location.href = "main.php";</script>
				   <?php
				}
				else{
					?>
				   <script> window.location.href = "pages/admin.php";</script>
				   <?php
				}
				
			}
			else {
				//если пароли не сошлись
				$mes = "Извините, введённый вами login или пароль неверный.";
				require_once "main.php";
?>
	<script>document.getElementById("entrance").style.display = "block";</script>
<?php
			}
		}

	}
}

# Если кнопка "Регистрация" нажата
if( isset( $_POST['registration'] ) ){
?>
	<script>
		window.location.href = "pages/registration.php";
	</script>
<?php
}

?>

