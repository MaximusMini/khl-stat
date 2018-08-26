<?php

$active_link = $_GET['active_link'];

//$nav = <<<NAV
//<ul class="nav navbar-left">
//<li class="active"><a href="#">Главная</a></li>
//<li><a href="#">Отправка письма</a></li>
//<li><a href="#">Подделка адреса отправителя (подделка домена)</a></li>
//<li><a href="#">Подделка письма от имени почтового сервиса</a></li>
//</ul>
//NAV;

//echo $nav;



?>



<ul class="nav navbar-left">
	<li <?php if ($_GET['active_link'] == main) echo 'class="active"' ?>>
		<a href="/index.php">Главная</a></li>
	<li <?php if ($_GET['active_link'] == send_mail) echo 'class="active"' ?>>
		<a href="/fishing/send-mail.php">Отправка письма</a></li>
	<li>
		<a href="#">Подделка адреса отправителя (подделка домена)</a>
	</li>
	<li>
		<a href="#">Подделка письма от имени почтового сервиса</a>
	</li>
	<li>
		<a href="#">Кража cookies через XSS</a>
	</li>
	<li>
		<a href="#">Сложные сценарии</a>
	</li>
	<li>
		<a href="#">Использование API почтовых серверов</a>
	</li>
</ul>


