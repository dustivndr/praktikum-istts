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

$lecturer = null;
if (!empty($student['dosen_wali_id'])) {
    foreach ($users as $user) {
        if ((int) ($user['id'] ?? 0) === (int) $student['dosen_wali_id'] && ($user['role'] ?? '') === 'dosen') {
            $lecturer = $user;
            break;
        }
    }
}

$selectedCourseCodes = $student['krs'] ?? [];
$studentCourses = [];
$totalSks = 0;
foreach ($matakuliah as $course) {
    if (in_array($course['kode'] ?? '', $selectedCourseCodes, true)) {
        $studentCourses[] = $course;
        $totalSks += (int) ($course['sks'] ?? 0);
    }
}

$dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$monthNames = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$today = new DateTimeImmutable();
$formattedDate = $dayNames[(int) $today->format('w')] . ', ' . $today->format('j') . ' ' . $monthNames[(int) $today->format('n')] . ' ' . $today->format('Y');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleMain.css">
</head>
<body class="student-body">
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
                <a href="mhsHome.php" class="student-nav-item active"><i class="fa-solid fa-house"></i> Beranda</a>
                <a href="mhsDW.php" class="student-nav-item"><i class="fa-solid fa-user-tie"></i> Dosen Wali</a>
                <a href="mhsPMK.php" class="student-nav-item"><i class="fa-regular fa-rectangle-list"></i> Pilih Mata Kuliah</a>
                <a href="mhsJK.php" class="student-nav-item"><i class="fa-regular fa-calendar-days"></i> Jadwal Kuliah</a>
                <a href="logout.php" class="student-nav-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
            </nav>
        </aside>

        <main class="student-main">
            <header class="student-topbar">
                <div class="student-welcome">
                    <div class="welcome-icon"><i class="fa-solid fa-bell"></i></div>
                    <div>
                        <h1>Selamat malam, <span><?= htmlspecialchars($student['nama'] ?? 'Mahasiswa') ?></span></h1>
                        <p><?= htmlspecialchars($formattedDate) ?></p>
                    </div>
                </div>
                <button class="student-settings-btn">Pengaturan</button>
            </header>

            <section class="student-banner">
                <div class="student-banner-text"><i class="fa-solid fa-bullhorn"></i> Bantu Evaluasi Layanan Akademik</div>
                <button class="student-banner-btn">Lihat Panduan</button>
            </section>

            <div class="student-grid row g-3">
                <div class="col-12 col-md-4">
                    <div class="student-stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="stat-label">IPK Kumulatif</div>
                        <h2 class="stat-value val-gold"><?= htmlspecialchars((string) ($student['ipk'] ?? '0.00')) ?></h2>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="student-stat-card">
                        <div class="stat-icon"><i class="fa-regular fa-rectangle-list"></i></div>
                        <div class="stat-label">Total SKS Semester Ini</div>
                        <h2 class="stat-value val-cyan"><?= htmlspecialchars((string) $totalSks) ?> SKS</h2>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="student-stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-award"></i></div>
                        <div class="stat-label">Poin Kemahasiswaan</div>
                        <h2 class="stat-value val-white"><?= htmlspecialchars((string) ($student['poin'] ?? 0)) ?> Poin</h2>
                    </div>
                </div>
            </div>

            <section class="student-panel">
                <div class="student-panel-header">
                    <div class="student-panel-title"><i class="fa-solid fa-user-tie"></i> Status Dosen Wali</div>
                    <a href="mhsDW.php" class="student-action-btn">Pilih Dosen Wali</a>
                </div>

                <div class="student-status-box">
                    <div class="student-status-label">Dosen Wali</div>
                    <div class="student-status-name"><?= htmlspecialchars($lecturer['nama'] ?? 'Belum ditentukan') ?></div>
                    <div class="student-status-meta"><?= htmlspecialchars($lecturer['nid'] ?? 'NID tidak tersedia') ?></div>
                </div>
            </section>

            <section class="student-panel">
                <div class="student-panel-header">
                    <div class="student-panel-title"><i class="fa-solid fa-book-open"></i> Mata Kuliah yang Diambil</div>
                </div>

                <div class="table-responsive">
                    <table class="student-table">
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Jam</th>
                                <th>Ruang</th>
                                <th>Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($studentCourses === []): ?>
                                <tr>
                                    <td colspan="5" class="student-empty">Belum ada mata kuliah yang dipilih.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($studentCourses as $course): ?>
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
                                        <td><?= htmlspecialchars($course['nama_mk'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars((string) ($course['sks'] ?? 0)) ?></td>
                                        <td><?= htmlspecialchars(($course['jam'] ?? '-') ?: '-') ?></td>
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
