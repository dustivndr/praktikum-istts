<?php
require_once __DIR__ . '/auth.php';
redirect_if_logged_in();

$errors = [];
if (isset($_POST['username'], $_POST['password'], $_POST['confirm_password'])) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($username === '' || $password === '' || $confirm === '') $errors[] = 'Semua field wajib diisi.';
    if ($password !== '' && strlen($password) < 6) $errors[] = 'Password minimal 6 karakter.';
    if ($password !== '' && $password !== $confirm) $errors[] = 'Password dan confirm password harus sama.';
    if (!$errors) {
        $check = $pdo->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
        $check->execute([$username]);
        if ($check->fetch()) {
            $errors[] = 'Username sudah digunakan, silakan pilih username lain.';
        } else {
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $stmt->execute([$username, $password]);
            $_SESSION['success'] = 'Registrasi berhasil. Silakan masuk untuk mulai bermain.';
            header('Location: login.php');
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
    <title>Daftar - Sudoku Studio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="auth-page">

    <main class="auth-shell">
        <section class="auth-form-wrap">
            <div class="auth-form">
                <h2 style="text-align: center;">Register User</h2>
                <?php if ($errors): ?><div class="alert error">
                        <ul><?php foreach ($errors as $item): ?><li><?= e($item) ?></li><?php endforeach; ?></ul>
                    </div><?php endif; ?>
                <form method="post" novalidate>
                    <label for="username">Username</label><input id="username" name="username" type="text" autocomplete="username" placeholder="Pilih username" value="<?= e($_POST['username'] ?? '') ?>">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" placeholder="Minimal 6 karakter">
                    <label for="confirm_password">Confirm password</label><input id="confirm_password" name="confirm_password" type="password" autocomplete="new-password" placeholder="Ulangi password">
                    <br/><br/>
                    <button class="primary-btn full" type="submit" style="background:#28a745">Daftar Sekarang <span>→</span></button>
                </form>
                <p class="switch-auth">Sudah punya akun? <a href="login.php" style="color:#0d6efd">Login di sini</a></p>
            </div>
        </section>

    </main>

</body>

</html>