<?php session_start();

error_reporting(0);

// db connection
include_once('connection.php');

// max attempts
$maxAttempts = 40;
$solution_filename = $_FILES['solution_file']['tmp_name'];
$solution = file($solution_filename);
// echo $solution_filename;
// print_r($_FILES);

// смотрим, авторизован ли пользователь
if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];
	// смотрим, не превышено ли максимальное число попыток
	//$pdo->query("SELECT id FROM attempts WHERE author_id = '$userid'");

$sql = "SELECT COUNT(*) FROM attempts WHERE author_id = '$userid'";
if ($res = $pdo->query($sql)) {

    /* Определим количество строк, подходящих под условия выражения SELECT */
    if ($res->fetchColumn() < $maxAttempts) {
    	// echo "Current attempts counter: " . $res->fetchColumn();
    	// если число подходящих строк меньше $maxAttempts, 
    	// то даём сделать попытку и записываем её результат в бдшку!

	if (isset($solution)) {
		$sol = $solution;

		// divide into lines
        $strings = $sol;
		// $strings = explode("\n", $sol);

		// добавить файл с правильными решениями
		include_once('./answers.php');
		$trueSexArr = array();
		// $trueAgeArr = array();
		// add true answers
		foreach ($answers as $user) {
			$userValue = explode(",", $user);
            if (isset($userValue[1])) {
                $trueSexArr[] = rtrim($userValue[1]);
            }
            // print_r($userValue[1]);
			// $trueAgeArr[] = $userValue[2];
		}

		//print_r($trueSexArr);

		//$trueSexArr = array(1,0,0,1,0);
		//$trueAgeArr = array(18,19,25,35,28);
		$userSexArr = array();
		// $userAgeArr = array();

		if (count($strings) != count($trueSexArr)) {
			header('Refresh: 5; url=./');
			echo "Попытка не зачитана. Проверьте правильность вводимых данных и число строк в посылке!";
            echo "<br>В вашем файле строк: " . count($strings) . "<br>" . "А должно быть: " . count($trueSexArr);;
			exit();
		}

		for ($i=0; $i<count($strings); $i++) {
			// for each string extract values for sex and age
			$currentString = explode(",", $strings[$i]);
            if (isset($currentString[1])) {
               $userSexArr[] = rtrim($currentString[1]); 
            }
			// $userAgeArr[] = $currentString[2];
			//echo $currentString[1];
		}

		function getAccuracyPercentage($trueArr, $userArr) {
			$s = 0;
			for ($i=1; $i<count($trueArr); $i++) {
				if ($trueArr[$i] == $userArr[$i]) {
                    if ($userArr[$i] != ' ' && $userArr[$i] != '') {
                        $s++;
                    }
				}
			}
            // round output!
            // echo count($trueArr) . " " . count($userArr);
			return $s/10000;
		}

		$score = getAccuracyPercentage($trueSexArr, $userSexArr);

		$pdo->query("INSERT INTO attempts (author_id, score) VALUES ('$userid', '$score')");
		header('Refresh: 1; url=./');
		echo "Попытка успешно сохранена.<br>Очки за текущую попытку: <b>" . $score. "</b>";

	} else {
		header('Refresh: 1; url=./');
		echo "Что-то пошло не так...";
	}

        /* Выполняем реальный SELECT и работаем с его результатами */
        
        //$sql = "SELECT id FROM attempts WHERE author_id = '$userid'";
        //foreach ($pdo->query($sql) as $row) {
        //    print "attempt id: " .  $row['id'] . "\n";
        //}
    }
    /* Результатов нет -- делаем что-то другое */
    else {
    	header('Refresh: 1; url=./');
        echo "Превышено максимальное число посылок. За результат будет зачтена попытка с наилучшим результатом проверки.";
    }
}

} else {
	header('Refresh: 1; url=./');
	echo "Авторизуйтесь, чтобы иметь возможность посылать решения на проверку!";
}

?>