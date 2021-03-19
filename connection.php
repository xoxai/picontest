<?php

const DB_USER = "root";
const DB_PASS = "";
const DB_NAME = "test";
const DB_HOST = "127.0.0.1";

$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
try {
	$pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
	exit('Database error.');
}

// print_r($pdo);

?>