<?php
require_once 'data.php';

$authUser = json_decode($_COOKIE['auth_user'] ?? '', true);
if (($authUser['role'] ?? null) !== 'admin') {
	header('Location: login.php');
	exit;
}

$users = json_decode($_COOKIE['users'] ?? '[]', true) ?: [];

if (isset($_POST['action']) && $_POST['action'] === 'add_user') {
	$role = $_POST['role'] ?? '';
	$name = trim($_POST['name'] ?? '');
	$email = trim($_POST['email'] ?? '');
	$identity = trim($_POST['identity'] ?? '');
	$password = $_POST['password'] ?? '';
	$identityKey = $role === 'dosen' ? 'nid' : 'nim';
	$errorMessage = '';

	if (!in_array($role, ['mahasiswa', 'dosen'], true)) {
		$errorMessage = 'Role pengguna tidak valid.';
	} elseif ($email === '' || strpos($email, '@') === false || strpos($email, '.') === false) {
		$errorMessage = 'Email harus diisi dengan format yang valid.';
	}

	if ($errorMessage === '') {
		foreach ($users as $user) {
			if (($user['email'] ?? '') === $email) {
				$errorMessage = 'Email sudah digunakan oleh pengguna lain.';
				break;
			}

			if (($user[$identityKey] ?? '') === $identity) {
				$errorMessage = ($role === 'dosen' ? 'NID' : 'NIM') . ' sudah digunakan oleh pengguna lain.';
				break;
			}
		}
	}

	if ($errorMessage !== '') {
		setcookie('error_message', $errorMessage, time() + 10, '/');
	} else {
		$lastId = 0;
		foreach ($users as $user) {
			$lastId = max($lastId, (int) ($user['id'] ?? 0));
		}

		$newUser = [
			'id' => $lastId + 1,
			$identityKey => $identity,
			'nama' => $name,
			'email' => $email,
			'password' => $password,
			'role' => $role,
			'banned' => 0,
		];

		if ($role === 'mahasiswa') {
			$newUser += [
				'dosen_wali_id' => null,
				'ipk' => '0.0',
				'sks' => 0,
				'poin' => 0,
				'krs' => [],
			];
		}

		$users[] = $newUser;
		setcookie('users', json_encode($users), time() + (86400 * 30), '/');
		setcookie('success_message', 'Pengguna baru berhasil ditambahkan.', time() + 10, '/');
	}

	header('Location: adminTUB.php');
	exit;
}

$errorMessage = $_COOKIE['error_message'] ?? null;
$successMessage = $_COOKIE['success_message'] ?? null;
if ($errorMessage !== null) {
	setcookie('error_message', '', time() - 3600, '/');
}
if ($successMessage !== null) {
	setcookie('success_message', '', time() - 3600, '/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard Super Admin - Tambah Pengguna</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleMain.css">
</head>

<body>
	<div class="wrapper">
		<aside class="sidebar">
			<div class="sidebar-header">
				<i class="fa-solid fa-shield-halved"></i>
				<div class="sidebar-brand-text">
					<strong>SUPERADMIN</strong>
					<span class="sub">SUPER ADMIN</span>
					<span class="sub">AKSES KHUSUS</span>
				</div>
			</div>

			<ul class="sidebar-nav">
				<li>
					<a href="adminP.php" class="nav-link">
						<i class="fa-solid fa-gauge"></i> Control Panel
					</a>
				</li>
				<li>
					<a href="adminTUB.php" class="nav-link active">
						<i class="fa-solid fa-user-plus"></i> Tambah User Baru
					</a>
				</li>
				<li>
					<a href="adminTMK.php" class="nav-link">
						<i class="fa-solid fa-book-open"></i> Tambah Mata Kuliah
					</a>
				</li>
				<li>
					<a href="logout.php" class="nav-link nav-logout">
						<i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
					</a>
				</li>
			</ul>
		</aside>

		<main class="main-content">
			<div class="page-header">
				<div class="header-title-group">
					<div class="header-icon"><i class="fa-solid fa-user-plus"></i></div>
					<div class="header-text">
						<h1>Form <span>Tambah Pengguna Baru</span></h1>
						<p>Daftarkan akun Dosen atau Mahasiswa baru ke dalam sistem</p>
					</div>
				</div>
				<a href="adminP.php" class="btn btn-gold btn-sm">
					<i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Control Panel
				</a>
			</div>

			<?php if ($errorMessage !== null): ?>
				<div class="alert alert-danger" role="alert"><?= htmlspecialchars($errorMessage) ?></div>
			<?php endif; ?>
			<?php if ($successMessage !== null): ?>
				<div class="alert alert-success" role="alert"><?= htmlspecialchars($successMessage) ?></div>
			<?php endif; ?>

			<section class="add-user-panel">
				<h2 class="table-title mb-4"><i class="fa-solid fa-id-card"></i> Informasi Akun Baru</h2>
				<form method="POST">
					<input type="hidden" name="action" value="add_user">

					<div class="mb-3">
						<label for="role" class="form-label">Role Pengguna</label>
						<select class="form-select" name="role" id="role" required>
							<option value="mahasiswa">Mahasiswa</option>
							<option value="dosen">Dosen</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="name" class="form-label">Nama Lengkap</label>
						<input type="text" class="form-control" name="name" id="name" minlength="3" required placeholder="Masukkan nama lengkap pengguna">
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email ISTTS</label>
						<input type="email" class="form-control" name="email" id="email" required placeholder="contoh: nama@istts.ac.id">
					</div>
					<div class="mb-3">
						<label for="identity" class="form-label" id="identityLabel">NIM (Mahasiswa)</label>
						<input type="text" class="form-control" name="identity" id="identity" minlength="6" required placeholder="Masukkan Nomor Induk">
						<div class="form-note mt-1">Minimal 6 karakter</div>
					</div>
					<div class="mb-4">
						<label for="password" class="form-label">Password Akses</label>
						<input type="password" class="form-control" name="password" id="password" minlength="6" required placeholder="Masukkan password awal">
					</div>
					<button type="submit" class="btn btn-gold btn-sm">
						<i class="fa-solid fa-circle-check me-1"></i> Simpan Pengguna Baru
					</button>
					<a href="adminP.php" class="btn btn-outline-warning btn-sm ms-1">Batal</a>
				</form>
			</section>
		</main>
	</div>

	<script>
		const roleSelect = document.getElementById('role');
		const identityLabel = document.getElementById('identityLabel');
		const identityInput = document.getElementById('identity');

		roleSelect.addEventListener('change', () => {
			const isLecturer = roleSelect.value === 'dosen';
			identityLabel.textContent = isLecturer ? 'NID (Dosen)' : 'NIM (Mahasiswa)';
			identityInput.placeholder = isLecturer ? 'Masukkan Nomor Induk Dosen' : 'Masukkan Nomor Induk';
		});
	</script>
</body>

</html>
