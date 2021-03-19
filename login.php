<?php session_start();

header('Refresh: 1; url=./');

$username = $_POST['username'];
$password = $_POST['password'];

include_once('connection.php');

$stmt = $pdo->query("SELECT username,id,password FROM users WHERE username = '$username'");

while ($row = $stmt->fetch())
{
    if ($password == $row['password']) {
    	echo "Данные для авторизации введены верно!";
    	$_SESSION['userid'] = $row['id'];
    	// echo $row["password"];
    }
    else {
    	echo "Неверный логин или пароль!";
    }
    $existanceFlag = true;
}

// print_r($stmt);
if (!isset($existanceFlag)) echo "Такого пользователя не существует!";
 
echo "<br><br>Сейчас вы будете перенаправлены на главную страницу!";

?>