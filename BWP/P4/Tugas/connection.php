<?php

session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$port = 3306;
$dbname = 'sudoku_db';
$charset = "utf8mb4";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("gagal connect: " . $e->getMessage());
}
