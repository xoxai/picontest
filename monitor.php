<?php session_start(); 
if (!isset($_SESSION['userid'])) {
	header('Refresh: 1; url=./');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Монитор</title>
	<link rel="stylesheet" type="text/css" href="./css/main.css">
</head>
<body>
	<div id="container">
		<?php 
			include_once('header.php');
			if (isset($_SESSION['userid'])) { 
				include_once('connection.php');
				$userid = $_SESSION['userid'];
		?>
		<div id="content">
		<p>
			На этой странице размещена публичная таблица всех участников, обновляемая в режиме реального времени. 
		</p>
		<p>
			Данные в ней отсортированы по убыванию очков, полученных на момент просмотра таблицы. 
		</p>
		<p>
			В первой строке расположена команда с максимальным числом очков.
		</p>
		<p>
			<?php
				// получим все попытки и средствами PHP разберёмся с тем, что показывать на мониторе
				$stmt = $pdo->query("SELECT * FROM attempts");

				$allAttempts = array();

				while ($row = $stmt->fetch()) {
					$allAttempts[] = $row;
				}

				$authors = array();

				// получим уникальных авторов
				
				foreach ($allAttempts as $a) {
					$authors[] = $a["author_id"];
				}

				$authors = array_unique($authors);

				$scoreTable = array();

				foreach ($authors as $author) {
					$currentMax = 0;
					foreach($allAttempts as $attempt) {
						if ($attempt["author_id"] == $author && $attempt["score"] > $currentMax) {
							$currentMax = $attempt["score"];
							//echo $currentMax;
						}
					}
					$scoreTable[] = array("author_id" => $author, "score" => $currentMax);
					// echo $currentMax;
				}

				// По возрастанию:
				function cmp_function_desc($a, $b){
					return ($a['score'] < $b['score']);
				}
				
				// сортировать массив по значению ключа score, используя для сравнени функцию cmp_function_desc
				uasort($scoreTable, 'cmp_function_desc');

				// print_r($scoreTable);

				$place = 1;
				echo "<table><thead><tr><td>Текущее место в рейтинге</td><td>ID команды</td><td>Результат наилучшей попытки</td></tr></thead><tbody>";
				foreach($scoreTable as $tableRow) {
					echo "<tr><td>".$place."</td><td>".$tableRow["author_id"]."</td><td>".$tableRow["score"]."</td></tr>";
					$place++;
				}
				echo "</tbody></table>";

			?>
		</p>	
		</div>
		<?php
		} else {
			echo "Чтобы просматривать монитор соревнования, необходима авторизация!";
		}
		?>
	</div>	
</body>
</html>