<?php

session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$port = 3306;
$dbname = 'db_gmail';
$charset = "utf8mb4";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [];
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("gagal connect: " . $e->getMessage());
}
