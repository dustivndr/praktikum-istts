<?php
require_once 'data.php';

$authUser = json_decode($_COOKIE['auth_user'] ?? '', true);
if (($authUser['role'] ?? null) !== 'dosen') {
	header('Location: login.php');
	exit;
}

$users = json_decode($_COOKIE['users'] ?? '[]', true) ?: [];
$matakuliah = json_decode($_COOKIE['matakuliah'] ?? '[]', true) ?: [];
$lecturerId = (int) ($authUser['id'] ?? 0);
$lecturer = null;

foreach ($users as $user) {
	if ((int) ($user['id'] ?? 0) === $lecturerId && ($user['role'] ?? '') === 'dosen') {
		$lecturer = $user;
		break;
	}
}

if ($lecturer === null) {
	setcookie('auth_user', '', time() - 3600, '/');
	header('Location: login.php');
	exit;
}

$waliStudents = [];
foreach ($users as $user) {
	if (($user['role'] ?? '') === 'mahasiswa' && (int) ($user['dosen_wali_id'] ?? 0) === $lecturerId) {
		$waliStudents[] = $user;
	}
}

$lecturerName = $lecturer['nama'] ?? 'Dosen';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mahasiswa Wali - <?= htmlspecialchars($lecturerName) ?></title>

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
		<aside class="sidebar lecturer-sidebar">
			<div class="lecturer-profile">
				<div class="lecturer-avatar"><i class="fa-solid fa-user"></i></div>
				<div class="lecturer-profile-text">
					<strong><?= htmlspecialchars(strtoupper($lecturerName)) ?></strong>
					<span>NID: <?= htmlspecialchars($lecturer['nid'] ?? '-') ?></span>
					<span>DOSEN PENGAJAR</span>
				</div>
			</div>

			<ul class="sidebar-nav">
				<li><a href="dosenHome.php" class="nav-link"><i class="fa-solid fa-house"></i> Beranda Dosen</a></li>
				<li><a href="dosenMW.php" class="nav-link active"><i class="fa-solid fa-users"></i> Mahasiswa Wali</a></li>
				<li><a href="dosenKMK.php" class="nav-link"><i class="fa-regular fa-rectangle-list"></i> Kelola Mata Kuliah</a></li>
				<li><a href="logout.php" class="nav-link nav-logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a></li>
			</ul>
		</aside>

		<main class="main-content lecturer-content">
			<div class="page-header lecturer-welcome">
				<div class="header-title-group">
					<div class="header-icon"><i class="fa-solid fa-users"></i></div>
					<div class="header-text">
						<h1>Bimbingan <span>Mahasiswa Wali</span></h1>
						<p>Daftar mahasiswa bimbingan akademik Anda semester ini</p>
					</div>
				</div>
				<div class="lecturer-count-badge"><i class="fa-solid fa-user-plus me-1"></i> Total: <?= count($waliStudents) ?> Mahasiswa</div>
			</div>

			<section class="table-panel lecturer-table-panel">
				<h2 class="table-title mb-3"><i class="fa-regular fa-rectangle-list"></i> Daftar Mahasiswa Bimbingan Akademik</h2>

				<?php if ($waliStudents === []): ?>
					<div class="empty-state">Belum ada mahasiswa yang ditetapkan sebagai mahasiswa wali Anda.</div>
				<?php endif; ?>

				<?php foreach ($waliStudents as $student): ?>
					<article class="wali-student-card">
						<div class="wali-student-header">
							<div class="wali-student-identity">
								<div class="wali-student-avatar"><i class="fa-solid fa-graduation-cap"></i></div>
								<div>
									<h3><?= htmlspecialchars($student['nama'] ?? '-') ?></h3>
									<p>NIM: <?= htmlspecialchars($student['nim'] ?? '-') ?></p>
								</div>
							</div>
							<div class="wali-student-summary">
								<span>IPK: <strong><?= htmlspecialchars($student['ipk'] ?? '-') ?></strong></span>
								<span>SKS Diambil: <strong><?= htmlspecialchars((string) ($student['sks'] ?? '0')) ?> SKS</strong></span>
							</div>
						</div>

						<div class="wali-krs-box">
							<strong><i class="fa-regular fa-rectangle-list me-1"></i> Mata Kuliah Yang Diambil (KRS):</strong>
							<div class="wali-krs-list">
								<?php if (empty($student['krs'])): ?>
									<span class="text-muted">Belum mengambil mata kuliah.</span>
								<?php else: ?>
									<?php foreach ($student['krs'] as $courseCode): ?>
										<?php
										$courseName = $courseCode;
										$courseCredits = '-';
										foreach ($matakuliah as $course) {
											if (($course['kode'] ?? '') === $courseCode) {
												$courseName = $course['nama_mk'] ?? $courseCode;
												$courseCredits = $course['sks'] ?? '-';
												break;
											}
										}
										?>
										<span class="wali-course-badge"><?= htmlspecialchars($courseName) ?> (<?= htmlspecialchars((string) $courseCredits) ?> SKS)</span>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</section>
		</main>
	</div>
</body>

</html>
