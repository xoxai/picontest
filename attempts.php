<?php session_start(); 
if (!isset($_SESSION['userid'])) {
	header('Refresh: 1; url=./');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Посылки</title>
	<link rel="stylesheet" type="text/css" href="./css/main.css">
</head>
<body>
	<div id="container">
		<?php 
			include_once('header.php'); 
			if (isset($_SESSION['userid'])) {
	 		$userid = $_SESSION['userid'];
		?>
		<div id="content">

			На этой странице перечислены все ваши попытки и баллы за каждую из них.

			<?php 
				$maxAttempts = 40;
				include_once('connection.php');
				if ($userid == 6) {
					$stmt = $pdo->query("SELECT * FROM attempts ORDER BY `timestamp` DESC");
					$maxAttempts *= 5;
				} else {
					$stmt = $pdo->query("SELECT * FROM attempts WHERE author_id = '$userid'");
				}

				echo "<table><thead><tr><td>Время посылки</td><td>№ попытки</td><td>ID попытки в контесте</td><td>ID команды</td><td>Результат попытки</td></tr></thead><tbody>";
				$attemptNum = 1;
				while ($row = $stmt->fetch()) {
					echo "<tr><td>".date('d.m.Y H:i:s' ,strtotime($row['timestamp']))."</td><td>".$attemptNum."</td><td>".$row['id']."</td><td>".$row['author_id']."</td><td>".$row['score']."</td></tr>";
					$attemptNum++;
				}
				echo "</tbody></table>";

				echo "<p>Истрачено попыток: <b>".($attemptNum-1)."</b></p><p>Осталось попыток: <b>".($maxAttempts - $attemptNum + 1)."</b></p>";

			?>
		</div>
	</div>	
	<?php
	} else {
		echo "Чтобы просматривать результаты попыток, вы должны пройти авторизацию!";
	}
	?>
</body>
</html>

