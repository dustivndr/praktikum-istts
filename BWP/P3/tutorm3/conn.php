<?php
/*  Session start di sini biar ga usah session start setiap kali mau pake session 
(ga perlu di end session_start() karena di php itu otomatis end session ketika script selesai dijalankan) **/
session_start(); 

// Database connection settings.
$host = "localhost";
$db = "bestmovie";
$user = "root";
$pass = "";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ini buat menampilkan error jika koneksi gagal
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // ini buat menampilkan data dalam bentuk array asosiatif
];

try {
    // untuk membuat koneksi ke database menggunakan PDO (ini harus ada ya gaes)
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass, $opt);
} catch (PDOException $e) {

    die("Koneksi gagal: " . $e->getMessage());
}

function alert($message)
{
    // fungsi alert untuk menampilkan pesan
    echo "<script> alert('$message');</script>";
}

function alertAndRedirect($message, $url)
{
    // fungsi alert dan redirect ke halaman lain
    echo "<script> alert('$message'); window.location = '$url';</script>";
}
