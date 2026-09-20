<?php
require_once 'data.php';

$name = $_POST['name'];
$nim = $_POST['nim'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];

if (strlen($name) < 3) {

    setcookie(
        "error_message",
        "Nama harus memiliki minimal 3 karakter!",
        time() + 10,
        "/"
    );

    header("Location: register.php");
    exit;
}

if (strlen($nim) < 6) {

    setcookie(
        "error_message",
        "NIM harus memiliki minimal 6 karakter!",
        time() + 10,
        "/"
    );

    header("Location: register.php");
    exit;
}

if (strlen($password) < 6) {

    setcookie(
        "error_message",
        "Password harus memiliki minimal 6 karakter!",
        time() + 10,
        "/"
    );

    header("Location: register.php");
    exit;
}

if ($password !== $passwordConfirm) {

    setcookie(
        "error_message",
        "Password dan konfirmasi password tidak sama!",
        time() + 10,
        "/"
    );

    header("Location: register.php");
    exit;
}


$users = [];

if (isset($_COOKIE['users'])) {
    $users = json_decode($_COOKIE['users'], true);
}

foreach ($users as $user) {

    if ($user['email'] === $email) {

        setcookie(
            "error_message",
            "Email sudah ada yang pakai!",
            time() + 10,
            "/"
        );

        header("Location: register.php");
        exit;
    }

    if ($user['nim'] === $nim) {

        setcookie(
            "error_message",
            "NIM sudah ada yang pakai!",
            time() + 10,
            "/"
        );

        header("Location: register.php");
        exit;
    }
}

$lastdata = $_COOKIE['users'];
$id = strlen($lastdata) + 1;

$newUser = [
    'id' => $id,
    'nim' => $nim,
    'nama' => $name,
    'email' => $email,
    'password' => $password,
    'role' => 'mahasiswa',
    'banned' => 0,
    'dosen_wali_id' => null,
    'ipk' => '0.0',
    'sks' => 0,
    'poin' => 0,
    'krs' => []
];

$users[] = $newUser;

setcookie(
    "users",
    json_encode($users),
    time() + (86400 * 30),
    "/"
);

header("Location: login.php");
exit;
