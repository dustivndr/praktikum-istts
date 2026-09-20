<?php
require_once 'data.php';

$username = $_POST['emailLogin'];
$password = $_POST['passwordLogin'];

if (
    $username === "superAdmin@example.com" &&
    $password === "admin123"
) {
    setcookie(
        'auth_user',
        json_encode(['id' => 1, 'role' => 'admin']),
        time() + (86400 * 30),
        '/'
    );

    header("Location: adminP.php");
    exit;
}

if (!isset($_COOKIE['users'])) {

    setcookie(
        "error_message",
        "Belum ada user yang terdaftar!",
        time() + 10,
        "/"
    );

    header("Location: login.php");
    exit;
}


$users = json_decode($_COOKIE['users'], true);

$loginSuccessful = false;
$role = null;

foreach ($users as $user) {

    if (
        $user['email'] === $username &&
        $user['password'] === $password
    ) {
        $loginSuccessful = true;
        $role = $user['role'];
        break;
    }
}

$ban = $user['banned'];

if ($loginSuccessful) {

    if ($ban === 1) {
        setcookie(
        "error_message",
        "Akun anda telah dibanned oleh Super Admin! Silahkan hubungi Pihak Akademik.",
        time() + 10,
        "/"
        );
        header("Location: login.php");
        exit;
    }

    if ($role === 'dosen') {
        setcookie(
            'auth_user',
            json_encode(['id' => $user['id'], 'role' => $role]),
            time() + (86400 * 30),
            '/'
        );

        header("Location: dosenHome.php");
        exit;
    }

    if ($role === 'mahasiswa') {
        setcookie(
            'auth_user',
            json_encode(['id' => $user['id'], 'role' => $role]),
            time() + (86400 * 30),
            '/'
        );

        header("Location: mhs.php");
        exit;
    }

} else {

    setcookie(
        "error_message",
        "Email atau password salah!",
        time() + 10,
        "/"
    );

    header("Location: login.php");
    exit;
}