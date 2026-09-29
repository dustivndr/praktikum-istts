<?php

require_once __DIR__ . '/connection.php';

$name = '';
$email = '';

if (isset($_POST['register'])) {
	$name = trim($_POST['name']);
	$email = strtolower(trim($_POST['email']));
	$password = $_POST['password'];

	$checkUser = $pdo->prepare(
        'SELECT id 
        FROM users 
        WHERE email = :email 
        LIMIT 1'
        );
	$checkUser->execute(['email' => $email]);

	if ($checkUser->fetch()) {
		echo '<script>alert("Email tersebut sudah digunakan.");</script>';
	} else {
		$createUser = $pdo->prepare(
			'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)'
		);
		$createUser->execute([
			'name' => $name,
			'email' => $email,
			'password' => $password,
		]);

		header('Location: login.php');
		exit;
	}
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<main class="register-card">
		<h1>Gmail Clone - Register</h1>

		<form method="post" action="register.php" onsubmit="return checkPassword()">
			<div class="field">
				<label for="name">Nama Lengkap</label>
				<input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
			</div>

			<div class="field">
				<label for="email">Alamat Email</label>
				<input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="contoh@gmail.com" required>
			</div>

			<div class="field">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" required>
			</div>

			<div class="field">
				<label for="password_confirmation">Konfirmasi Password</label>
				<input type="password" id="password_confirmation" name="password_confirmation" required>
			</div>

			<button type="submit" name="register">Register</button>
		</form>

		<p class="login-link">Sudah punya akun? <a href="login.php">Login</a></p>
	</main>

	<script>
		function checkPassword() {
			const password = document.getElementById('password').value;
			const confirmation = document.getElementById('password_confirmation').value;

			if (password !== confirmation) {
				alert('Password dan konfirmasi password harus sama.');
				return false;
			}

			return true;
		}
	</script>
</body>
</html>
