<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Help</title>
	<link rel="stylesheet" type="text/css" href="./css/main.css">
</head>
<body>
	<div id="container">

		<?php include_once('header.php'); ?>

		<div id ="content">
			<h2>Что такое Политех.Контест?</h2>
			<p>Политех.Контест &ndash; это контест-система для приёма решения при организации олимпиад, конкурсов и других видов активностей по программированию и информационным технологиям, где необходима автоматическая проверка решений.</p>
			<h2>Что здесь есть?</h2>
			<p>
				Основные разделы контест-системы &ndash; это:
				<ul>
					<li><b>Задачи</b> &ndash; это основной раздел системы, здесь расположено условие задачи, к которой вам предоставлен доступ для отправки ваших решений, а также интерфейс для отправки &ndash; поле ввода и кнопка "отправить". Для отправки решения на проверку необходимо в правильном формате заполнить поле для ввода решения и нажать кнопку "отправить". Так ваше решение будет оценено в автоматическом режиме. Если формат ответа не был соблюдён, об этом вы получите сообщение от системы, при этом результат попытки засчитан не будет, число попыток не уменьшится.
					<li><b>Посылки</b> &ndash; раздел, где отображаются все совершённые вами посылки решений на проверку, ответы тестирующей системы (полученные вами баллы), а также информация о числе израсходованных и оставшихся посылок (попыток решения).</li>
					<li><b>Монитор</b> &ndash; публичная таблица, в которой в порядке убывания числа полученных за данный контест баллов располагаются команды-участники. Каждой команде присваивается предварительное место на текущиий момент времени. Периодически переходя на страницу монитора можно оценить результаты других участников по полученным от тестирующей системы баллам.</li>
					<li><b>Справка</b> &ndash; раздел, в котором вы сейчас находитесь. Здесь расположена краткая справка по работе с системой и описание её разделов.</li>
					<li><b>Выход</b> &ndash; кнопка, позволяющая выйти из тестирующей системы. При этом данные текущей сессии стираются и для просмотра становятся недоступными все вышеперечисленные разделы. Для того, чтобы они вновь стали доступны, необходимо произвести авторизацию (ввести свой логин и пароль, предоставленные для вашей команды организаторами соревнования).</li>
				</ul>
			</p>
		</div>

	</div>
</body>
</html>