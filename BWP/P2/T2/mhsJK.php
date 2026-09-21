<?php
require_once 'data.php';

$authUser = json_decode($_COOKIE['auth_user'] ?? '', true);
if (($authUser['role'] ?? null) !== 'mahasiswa') {
    header('Location: login.php');
    exit;
}

$users = json_decode($_COOKIE['users'] ?? '[]', true) ?: [];
$matakuliah = json_decode($_COOKIE['matakuliah'] ?? '[]', true) ?: [];

$studentId = (int) ($authUser['id'] ?? 0);
$student = null;
foreach ($users as $user) {
    if ((int) ($user['id'] ?? 0) === $studentId && ($user['role'] ?? '') === 'mahasiswa') {
        $student = $user;
        break;
    }
}

if ($student === null) {
    setcookie('auth_user', '', time() - 3600, '/');
    header('Location: login.php');
    exit;
}

$selectedCodes = $student['krs'] ?? [];
$scheduledCourses = [];
foreach ($matakuliah as $course) {
    if (in_array((string) ($course['kode'] ?? ''), $selectedCodes, true)) {
        $scheduledCourses[] = $course;
    }
}

$totalSks = 0;
foreach ($scheduledCourses as $course) {
    $totalSks += (int) ($course['sks'] ?? 0);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kuliah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleMain.css">
</head>

<body class="student-jadwal-body">

    <div class="student-shell">

        <aside class="student-sidebar">
            <div class="student-brand">
                <div class="student-brand-icon"><i class="fa-solid fa-user"></i></div>
                <div class="student-brand-text">
                    <strong><?= htmlspecialchars(strtoupper($student['nama'] ?? 'Mahasiswa')) ?></strong>
                    <span><?= htmlspecialchars($student['nim'] ?? 'NIM belum ada') ?></span>
                    <small>GASAL 2026/2027</small>
                </div>
            </div>

            <nav class="student-nav">
                <a href="mhsHome.php" class="student-nav-item"><i class="fa-solid fa-house"></i> Beranda</a>
                <a href="mhsDW.php" class="student-nav-item"><i class="fa-solid fa-user-tie"></i> Dosen Wali</a>
                <a href="mhsPMK.php" class="student-nav-item"><i class="fa-regular fa-rectangle-list"></i> Pilih Mata Kuliah</a>
                <a href="mhsJK.php" class="student-nav-item active"><i class="fa-regular fa-calendar-days"></i> Jadwal Kuliah</a>
                <a href="logout.php" class="student-nav-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
            </nav>
        </aside>

        <main class="student-jadwal-main">
            <div class="student-jadwal-header">
                <div>
                    <div class="student-jadwal-title"><i class="fa-regular fa-calendar-days"></i> Jadwal Kuliah Mingguan</div>
                    <div class="student-jadwal-subtitle">Daftar mata kuliah dan jadwal kelas yang aktif semester ini</div>
                </div>
                <div class="student-jadwal-total"><i class="fa-regular fa-clipboard"></i> Total SKS Aktif: <?= htmlspecialchars((string) $totalSks) ?> SKS</div>
            </div>

            <section class="student-jadwal-panel">
                <div class="student-jadwal-panel-title"><i class="fa-solid fa-clock"></i> Kelas Yang Ditempuh</div>

                <div class="table-responsive">

                    <table class="student-jadwal-table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam / Waktu</th>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Ruang</th>
                                <th>Dosen Pengampu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($scheduledCourses === []): ?>
                                <tr>
                                    <td colspan="7" class="student-jadwal-empty">Belum ada mata kuliah yang dipilih.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($scheduledCourses as $course): ?>
                                    <?php
                                        $courseLecturer = null;
                                        foreach ($users as $user) {
                                            if ((int) ($user['id'] ?? 0) === (int) ($course['dosen_id'] ?? 0) && ($user['role'] ?? '') === 'dosen') {
                                                $courseLecturer = $user;
                                                break;
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td class="day-pill"><?= htmlspecialchars((string) ($course['hari'] ?? '-')) ?></td>
                                        <td><?= htmlspecialchars(($course['jam'] ?? '-') ?: '-') ?></td>
                                        <td><?= htmlspecialchars((string) ($course['kode'] ?? '-')) ?></td>
                                        <td class="course-name"><?= htmlspecialchars((string) ($course['nama_mk'] ?? '-')) ?></td>
                                        <td><?= htmlspecialchars((string) ($course['sks'] ?? 0)) ?> SKS</td>
                                        <td><?= htmlspecialchars($course['ruangan'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($courseLecturer['nama'] ?? 'Dosen belum ditentukan') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>

            </section>

        </main>

    </div>

</body>
</html>
