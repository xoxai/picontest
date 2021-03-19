<?php session_start();

header('Refresh: 1; url=./');

if (isset($_SESSION['userid'])) {
	unset($_SESSION['userid']);
}

session_destroy();

echo "Текущая сессия успешно завершена, сейчас вы будете перенаправлены на страницу входа.";

?>