<?php
require_once 'data.php';

$authUser = json_decode($_COOKIE['auth_user'] ?? '', true);
if (($authUser['role'] ?? null) !== 'admin') {
    header('Location: login.php');
    exit;
}

$users = json_decode($_COOKIE['users'] ?? '[]', true) ?: [];
$matakuliah = json_decode($_COOKIE['matakuliah'] ?? '[]', true) ?: [];

if (isset($_POST['action']) && $_POST['action'] === 'delete_course') {
    $courseCode = trim($_POST['kode'] ?? '');
    $courseFound = false;

    foreach ($matakuliah as $index => $course) {
        if (($course['kode'] ?? '') === $courseCode) {
            unset($matakuliah[$index]);
            $courseFound = true;
            break;
        }
    }

    $matakuliah = array_values($matakuliah);
    $matakuliahCookie = json_encode($matakuliah);
    setcookie('matakuliah', $matakuliahCookie, time() + (86400 * 30), '/');
    $_COOKIE['matakuliah'] = $matakuliahCookie;
    setcookie(
        'course_message',
        $courseFound ? 'Mata kuliah berhasil dihapus.' : 'Mata kuliah tidak ditemukan.',
        time() + 10,
        '/'
    );

    header('Location: adminKMK.php');
    exit;
}

$courseMessage = $_COOKIE['course_message'] ?? null;
if ($courseMessage !== null) {
    setcookie('course_message', '', time() - 3600, '/');
}

$lecturers = [];
foreach ($users as $user) {
    if (isset($user['nid'])) {
        $lecturers[(int) ($user['id'] ?? 0)] = $user['nama'] ?? '-';
    }
}

$totalUsers = count($users);
$totalDosen = count(array_filter($users, static fn($user) => array_key_exists('nid', $user)));
$totalMahasiswa = count(array_filter($users, static fn($user) => array_key_exists('nim', $user)));
$totalMatakuliah = count($matakuliah);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin - Kelola Mata Kuliah</title>

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
                    <a href="adminP.php" class="nav-link active">
                        <i class="fa-solid fa-gauge"></i> Control Panel
                    </a>
                </li>
                <li>
                    <a href="adminTUB.php" class="nav-link">
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
                    <div class="header-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="header-text">
                        <h1>Dashboard <span>Super Admin</span></h1>
                        <p>Kelola pengguna, penetapan role, pembekuan akun, dan master mata kuliah</p>
                    </div>
                </div>
                <a href="logout.php" class="btn btn-gold">
                    <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout
                </a>
            </div>

            <?php if ($courseMessage !== null): ?>
                <div class="ban-alert" role="alert">
                    <i class="fa-solid fa-circle-info"></i>
                    <?= htmlspecialchars($courseMessage) ?>
                </div>
            <?php endif; ?>

            <div class="row row-cols-4 g-4 mb-4">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                        <div class="stat-label">Total Pengguna</div>
                        <h2 class="stat-value val-gold"><?= $totalUsers ?></h2>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-address-card"></i></div>
                        <div class="stat-label">Total Dosen</div>
                        <h2 class="stat-value val-cyan"><?= $totalDosen ?></h2>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div class="stat-label">Total Mahasiswa</div>
                        <h2 class="stat-value val-green"><?= $totalMahasiswa ?></h2>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-book"></i></div>
                        <div class="stat-label">Total Mata Kuliah</div>
                        <h2 class="stat-value val-white"><?= $totalMatakuliah ?></h2>
                    </div>
                </div>
            </div>

            <div class="tab-navigation">
                <a href="adminP.php" class="tab-btn tab-inactive">
                    <i class="fa-solid fa-user-group"></i> Kelola Pengguna
                </a>
                <a href="adminKMK.php" class="tab-btn tab-active">
                    <i class="fa-regular fa-file-lines"></i> Kelola Mata Kuliah
                </a>
            </div>

            <div class="table-panel">
                <div class="table-header">
                    <h2 class="table-title">
                        <i class="fa-solid fa-book"></i> Master Data Mata Kuliah
                    </h2>
                    <a href="adminTMK.php" class="btn btn-gold btn-sm py-2 px-3">
                        <i class="fa-solid fa-plus me-1"></i> Tambah MK Baru
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table-dark-custom">
                        <thead>
                            <tr>
                                <th>KODE MK</th>
                                <th>NAMA MATA KULIAH</th>
                                <th>SKS</th>
                                <th>JADWAL / JAM</th>
                                <th>RUANGAN</th>
                                <th>DOSEN PENGAMPU</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($matakuliah as $course): ?>
                                <tr>
                                    <td><span class="badge-nid"><?= htmlspecialchars($course['kode'] ?? '-') ?></span></td>
                                    <td class="fw-bold"><?= htmlspecialchars($course['nama_mk'] ?? '-') ?></td>
                                    <td><span class="badge-id"><?= htmlspecialchars((string) ($course['sks'] ?? '-')) ?> SKS</span></td>
                                    <td><?= htmlspecialchars(($course['hari'] ?? '-') . ', ' . ($course['jam'] ?? '-')) ?></td>
                                    <td><?= htmlspecialchars($course['ruangan'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($lecturers[(int) ($course['dosen_id'] ?? 0)] ?? '-') ?></td>
                                    <td>
                                        <form method="POST" onsubmit="return confirm('Hapus mata kuliah ini?');">
                                            <input type="hidden" name="action" value="delete_course">
                                            <input type="hidden" name="kode" value="<?= htmlspecialchars($course['kode'] ?? '', ENT_QUOTES) ?>">
                                            <button type="submit" class="btn-action btn-ban">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>