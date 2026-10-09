<?php
require_once __DIR__ . '/auth.php';
redirect_if_logged_in();

$error = '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);

if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if (!$user || $password !== $user['password']) {
            $error = 'Username tidak terdaftar atau password salah.';
        } else {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int) $user['id'];
            $_SESSION['username'] = $user['username'];
            if (isset($_POST['remember'])) {
                setcookie(session_name(), session_id(), time() + 86400, '/', '', false, true);
            }
            header('Location: index.php');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Sudoku Studio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="auth-page">
    <main class="auth-shell">
        <section class="auth-form-wrap">
            <div class="auth-form">
                <h2>Sudoku Game</h2>
                <?php if ($success): ?><div class="alert success"><?= e($success) ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert error"><?= e($error) ?></div><?php endif; ?>
                <form method="post" novalidate>
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" autocomplete="username" placeholder="Masukkan username" value="<?= e($_POST['username'] ?? '') ?>">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan password">
                    <label class="check-row"><input type="checkbox" name="remember" value="1"><span>Ingat saya selama 24 jam</span></label>
                    <button class="primary-btn full" type="submit">Login <span>→</span></button>
                </form>
                <p class="switch-auth">Belum punya akun? <a href="register.php">Daftar Akun Baru</a></p>
            </div>
        </section>
    </main>
</body>
</html>
