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

$taughtCourses = [];
foreach ($matakuliah as $course) {
	if ((int) ($course['dosen_id'] ?? 0) === $lecturerId) {
		$taughtCourses[] = $course;
	}
}

$waliStudents = [];
foreach ($users as $user) {
	if (($user['role'] ?? '') === 'mahasiswa' && (int) ($user['dosen_wali_id'] ?? 0) === $lecturerId) {
		$waliStudents[] = $user;
	}
}

$taughtCourseCodes = [];
foreach ($taughtCourses as $course) {
	$taughtCourseCodes[] = $course['kode'] ?? '';
}

$classStudents = [];
foreach ($users as $user) {
	if (($user['role'] ?? '') !== 'mahasiswa') {
		continue;
	}

	foreach ($user['krs'] ?? [] as $courseCode) {
		if (in_array($courseCode, $taughtCourseCodes, true)) {
			$classStudents[] = $user;
			break;
		}
	}
}
$lecturerName = $lecturer['nama'] ?? 'Dosen';
$dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$monthNames = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$today = new DateTimeImmutable();
$formattedDate = $dayNames[(int) $today->format('w')] . ', ' . $today->format('j') . ' ' . $monthNames[(int) $today->format('n')] . ' ' . $today->format('Y');
// ijin make itu yg di atas bole kan?
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard Dosen - <?= htmlspecialchars($lecturerName) ?></title>

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
				<li>
					<a href="dosenHome.php" class="nav-link active">
						<i class="fa-solid fa-house"></i> Beranda Dosen
					</a>
				</li>
				<li>
					<a href="dosenMW.php" class="nav-link">
						<i class="fa-solid fa-users"></i> Mahasiswa Wali
					</a>
				</li>
				<li>
					<a href="dosenKMK.php" class="nav-link">
						<i class="fa-regular fa-rectangle-list"></i> Kelola Mata Kuliah
					</a>
				</li>
				<li>
					<a href="logout.php" class="nav-link nav-logout">
						<i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
					</a>
				</li>
			</ul>
		</aside>

		<main class="main-content lecturer-content">
			<div class="page-header lecturer-welcome">
				<div class="header-title-group">
					<div class="header-icon"><i class="fa-solid fa-sun"></i></div>
					<div class="header-text">
						<h1>Selamat Datang, <span><?= htmlspecialchars($lecturerName) ?></span></h1>
						<p><?= htmlspecialchars($formattedDate) ?></p>
					</div>
				</div>
				<a href="logout.php" class="btn btn-gold btn-sm">
					<i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Logout
				</a>
			</div>

			<div class="row g-3 mb-3">
				<div class="col-12 col-md-4">
					<div class="stat-card lecturer-stat-card">
						<div class="stat-icon"><i class="fa-regular fa-rectangle-list"></i></div>
						<div class="stat-label">Kelas Yang Diajar</div>
						<h2 class="stat-value val-gold"><?= count($taughtCourses) ?> Kelas</h2>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="stat-card lecturer-stat-card">
						<div class="stat-icon"><i class="fa-solid fa-user-graduate"></i></div>
						<div class="stat-label">Mahasiswa Bimbingan Wali</div>
						<h2 class="stat-value val-cyan"><?= count($waliStudents) ?> Mahasiswa</h2>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="stat-card lecturer-stat-card">
						<div class="stat-icon"><i class="fa-solid fa-users"></i></div>
						<div class="stat-label">Total Mahasiswa Kelas</div>
						<h2 class="stat-value val-white"><?= count($classStudents) ?> Mahasiswa</h2>
					</div>
				</div>
			</div>

			<section id="mata-kuliah" class="table-panel lecturer-table-panel mb-3">
				<h2 class="table-title mb-3"><i class="fa-solid fa-book-open"></i> Daftar Mata Kuliah Yang Diampu</h2>
				<div class="table-responsive">
					<table class="table-dark-custom lecturer-table">
						<thead>
							<tr>
								<th>KODE MK</th>
								<th>MATA KULIAH</th>
								<th>SKS</th>
								<th>JADWAL / JAM</th>
								<th>RUANGAN</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($taughtCourses as $course): ?>
								<tr>
									<td><span class="badge-nid"><?= htmlspecialchars($course['kode'] ?? '-') ?></span></td>
									<td class="fw-bold"><?= htmlspecialchars($course['nama_mk'] ?? '-') ?></td>
									<td><?= htmlspecialchars((string) ($course['sks'] ?? '-')) ?> SKS</td>
									<td><?= htmlspecialchars(($course['hari'] ?? '-') . ', ' . ($course['jam'] ?? '-')) ?></td>
									<td><?= htmlspecialchars($course['ruangan'] ?? '-') ?></td>
								</tr>
							<?php endforeach; ?>
							<?php if ($taughtCourses === []): ?>
								<tr><td colspan="5" class="text-muted">Belum ada mata kuliah yang diampu.</td></tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</section>

			<section id="mahasiswa-wali" class="table-panel lecturer-table-panel">
				<h2 class="table-title mb-3"><i class="fa-solid fa-user-group"></i> Mahasiswa Wali Bimbingan</h2>
				<div class="table-responsive">
					<table class="table-dark-custom lecturer-table">
						<thead>
							<tr>
								<th>NIM</th>
								<th>NAMA MAHASISWA</th>
								<th>EMAIL</th>
								<th>IPK</th>
								<th>TOTAL SKS</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($waliStudents as $student): ?>
								<tr>
									<td><span class="badge-id"><?= htmlspecialchars($student['nim'] ?? '-') ?></span></td>
									<td><?= htmlspecialchars($student['nama'] ?? '-') ?></td>
									<td><?= htmlspecialchars($student['email'] ?? '-') ?></td>
									<td class="fw-bold"><?= htmlspecialchars($student['ipk'] ?? '-') ?></td>
									<td><?= htmlspecialchars((string) ($student['sks'] ?? '0')) ?> SKS</td>
								</tr>
							<?php endforeach; ?>
							<?php if ($waliStudents === []): ?>
								<tr><td colspan="5" class="text-muted">Belum ada mahasiswa wali bimbingan.</td></tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</section>
		</main>
	</div>
</body>

</html>
