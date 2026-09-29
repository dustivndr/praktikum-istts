<?php

require_once __DIR__ . '/connection.php';

$email = '';

if (isset($_POST['login'])) {
	$email = strtolower(trim($_POST['email']));
	$password = $_POST['password'];

	$getUser = $pdo->prepare(
		'SELECT 
        id, name, email, password 
        FROM users 
        WHERE email = :email 
        LIMIT 1'
	);
	$getUser->execute(['email' => $email]);
	$user = $getUser->fetch(PDO::FETCH_ASSOC);

	if (!$user || $user['password'] !== $password) {
		echo '<script>alert("Email atau password salah.");</script>';
	} else {
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['user_name'] = $user['name'];
		$_SESSION['user_email'] = $user['email'];

		header('Location: home.php');
		exit;
	}
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<main class="register-card">
		<h1>JihMail - Login</h1>

		<form method="post" action="login.php">
			<div class="field">
				<label for="email">Alamat Email</label>
				<input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
			</div>

			<div class="field">
				<label for="password">Password</label>
				<input type="password" id="password" name="password" required>
			</div>

			<button type="submit" name="login">Login</button>
		</form>

		<p class="login-link">Belum punya akun? <a href="register.php">Register</a></p>
	</main>
</body>
</html>
