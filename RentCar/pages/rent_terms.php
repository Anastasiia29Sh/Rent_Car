<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php
$title = 'Условия аренды'; 
require_once "head.php";
?>

<body>
	<div class="main">
	<!-- header -->
		<?php
		require_once "header_menu.php";
		?>
		<style>
			menu a:nth-child(5) {
				color: #FFDA15;
			}
		</style>

		<div class="terms">
			<h3>Условия аренды</h3>

			<a class="term_name1">Требования к арендатозу и перечень докуметов</a>
			<div class="term_text1">
				<ol>
					<li>Паспорт РФ</li>
					<li>Водительское удостоверение</li>
					<li>Возраст не младше 21 года</li>
					<li>Стаж вождения не менее 2 лет</li>
				</ol>
			</div>
			
			<a class="term_name2">Рассмотрение заявки службой безопасности</a>
			<div class="term_text2">
				<p>Каждая поступившая заявка на прокат автомобилей в Санкт-Петербурге может быть принята только после рассмотрения документов потенциального арендатора службой безопасности нашей компании. Для этого необходимо предоставление фотографий главного разворота паспорта, страницы с регистрацией (номер и серия документа не важна и может быть закрыта на фотографии) и водительского удостоверения арендатора и дополнительного водителя. Их можно предоставить на электронную почту, либо через приложения WhatsApp, Viber на номер телефона указанный на сайте 8 (912) 909-15-25. Рассмотрение заявки составляет 15 минут.</p>
				<br>
				<p>Договор аренды транспортного средства заключается индивидуально с каждым клиентом по итогам предварительных переговоров и после предоставления клиентом всех необходимых документов. Принятие брони, предоплаты, подача автомобиля клиенту, а также заключение договора в офисе компании происходит ТОЛЬКО после проверки документов клиента службой безопасности. Наша компания оставляет за собой право отказа в заключении договора аренды без объяснения причин.</p>
			</div>
			
			<a class="term_name3">Способы оплаты</a>
			<div class="term_text3">
				<ul>
					<li>наличными в офисе компании</li>
					<li>переводом на карту Сбербанка №4277 0000 0000 2133 (Ирина Владимировна И.), также указанная карта привязана к номеру телефона +79219991525</li>
				</ul>
			</div>
			
			<a class="term_name4">Как забронировать автомобиль</a>
			<div class="term_text4">
				<p>Предварительно заказать автомобиль (забронировать) возможно, согласовав наличие интересующей Вас марки авто и даты аренды с нашим сотрудником по телефону. Бронь считается принятой только после проверки арендатора службой безопасности компании и внесения предоплаты в размере одной тысячи рублей наличными в офисе или на банковскую карту (с указание фамилии, марки авто и даты бронирования). В случае неявки арендатора до 20.00 выбранного дня для получения автомобиля, бронь снимается, предоплата арендатору не возвращается.</p>
			</div>
			
			<a class="term_name5">Выдача автомобилей</a>
			<div class="term_text5">
				<p>Выдача автомобилей арендаторам производится ежедневно с 9.00 до 20.00 по адресу: СПб, ул.Котиков, д.15, корп.3. При выдаче авто клиенту, кроме договора аренды, подписывается акт приема-передачи автомобиля. Акт приема-передачи заполняется сотрудником проката при совместном с арендатором осмотре автомобиля. Арендатор вправе, также, сделать фото-видео фиксацию внешнего состояния автомобиля при его получении. Автомобили выдаются с полным баком топлива, в чистом виде, укомплектованные щеткой для снега, аптечкой, огнетушителем, знаком аварийной остановки, запасным колесом, домкратом, ключом для снятия колес.
				</p>
			</div>
			
			<a class="term_name6">Возврат автомобилей</a>
			<div class="term_text6">
				<p>Возврат автомобилей осуществляется в пункте проката по адресу: Санкт-Петербург, СПб, ул.Котиков, д.15, корп.3. При сдаче авто в пункте проката арендатору сразу возвращается основная часть залога, 2000 руб. из залога удерживается на 21 день на оплату возможных штрафов ГИБДД. При отсутствии штрафов, оставшаяся часть залога в размере 2000 руб. возвращается арендатору в офисе пункта проката или банковским переводом на карту. При наличие штрафов их сумма удерживается из залога, при этом копии постановлений об административных правонарушениях и чеки об оплате штрафов могут быть направлены арендатору в электронном виде для сведения.</p>
				<br>
				<p>Автомобиль возвращается арендатором в автопрокат, если иное предварительно не согласовано с нашим менеджером. При сдаче автомобиль должен быть заправлен до полного бака (АИ-95) на любой близлежащей АЗС, с предоставлением последнего чека с заправки. Осмотр автомобиля на наличие повреждений производится сотрудником прокатной компании ТОЛЬКО после мойки ТС (мойка расположена в здании проката). Мойка автомобиля оплачивается арендатором в размере 350 руб. – 390 руб.</p>
			</div>
			
			<a class="term_name7">Возврат залога</a>
			<div class="term_text7">
				<p>Прокат авто в нашей компании предполагает определенную схему возвращения залога за автомобиль. Вернув авто, арендатор получает всю сумму залоговых средств за исключением 2 000 рублей. Эти деньги, мы оставляем у себя на три недели для того, чтобы оплатить из них штрафы ГИБДД, если такие были выписаны за время аренды автомобиля. Когда этот срок заканчивается, арендатор получает свои деньги – в наличном виде или перечислением на карту банка. Если были выписаны штрафы во время аренды авто, они вычитаются из залога, а копии постановлений передаются арендатору по электронной почте.</p>
			</div>

		</div>


     <!-- footer -->
		<?php
		require_once "footer.php";
		?>

   </div>


	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="../js/term_animation.js"></script>

</body>
</html>