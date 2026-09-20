<?php
require_once 'data.php';

$authUser = json_decode($_COOKIE['auth_user'] ?? '', true);
if (($authUser['role'] ?? null) !== 'admin') {
    header('Location: login.php');
    exit;
}

$users = json_decode($_COOKIE['users'] ?? '[]', true) ?: [];
$matakuliah = json_decode($_COOKIE['matakuliah'] ?? '[]', true) ?: [];
$lecturers = array_values(array_filter($users, static fn($user) => ($user['role'] ?? '') === 'dosen' && (int) ($user['banned'] ?? 0) === 0));
$weekdays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add_course') {
    $kode = strtoupper(trim($_POST['kode'] ?? ''));
    $nama = trim($_POST['nama_mk'] ?? '');
    $sks = (int) ($_POST['sks'] ?? 0);
    $hari = $_POST['hari'] ?? '';
    $jam = trim($_POST['jam'] ?? '');
    $ruangan = trim($_POST['ruangan'] ?? '');
    $dosenId = (int) ($_POST['dosen_id'] ?? 0);
    $errorMessage = '';

    if ($kode === '' || $nama === '' || $jam === '' || $ruangan === '') {
        $errorMessage = 'Semua informasi mata kuliah harus diisi.';
    } elseif ($sks < 1 || $sks > 6) {
        $errorMessage = 'Jumlah SKS harus berada di antara 1 dan 6.';
    } elseif (!in_array($hari, $weekdays, true)) {
        $errorMessage = 'Hari kuliah tidak valid.';
    } elseif (count(array_filter($matakuliah, static fn($course) => strtoupper($course['kode'] ?? '') === $kode)) > 0) {
        $errorMessage = 'Kode mata kuliah sudah digunakan.';
    } elseif (count(array_filter($lecturers, static fn($lecturer) => (int) ($lecturer['id'] ?? 0) === $dosenId)) === 0) {
        $errorMessage = 'Dosen pengampu tidak valid.';
    }

    if ($errorMessage !== '') {
        setcookie('error_message', $errorMessage, time() + 10, '/');
    } else {
        $matakuliah[] = [
            'kode' => $kode,
            'nama_mk' => $nama,
            'sks' => $sks,
            'hari' => $hari,
            'jam' => $jam,
            'ruangan' => $ruangan,
            'dosen_id' => $dosenId,
        ];
        setcookie('matakuliah', json_encode($matakuliah), time() + (86400 * 30), '/');
        setcookie('success_message', 'Mata kuliah berhasil ditambahkan.', time() + 10, '/');
    }

    header('Location: adminTMK.php');
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
    <title>Dashboard Super Admin - Tambah Mata Kuliah</title>
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
                        <i class="fa-solid fa-gauge"></i> Control Panel</a>
                </li>
                <li>
                    <a href="adminTUB.php" class="nav-link">
                        <i class="fa-solid fa-user-plus"></i> Tambah User Baru</a>
                </li>
                <li>
                    <a href="adminTMK.php" class="nav-link active">
                        <i class="fa-solid fa-book-open"></i> Tambah Mata Kuliah</a>
                </li>
                <li>
                    <a href="logout.php" class="nav-link nav-logout">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
                </li>
            </ul>
        </aside>

        <main class="main-content">

            <div class="page-header">
                <div class="header-title-group">
                    <div class="header-icon"><i class="fa-solid fa-book-open"></i></div>
                    <div class="header-text">
                        <h1>Form <span>Tambah Mata Kuliah</span></h1>
                        <p>Tambahkan kurikulum baru dan tentukan jadwal serta dosen pengampunya</p>
                    </div>
                </div>
                <a href="adminP.php" class="btn btn-gold btn-sm"><i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Control Panel</a>
            </div>

            <?php if ($errorMessage !== null): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($errorMessage) ?>
                </div>
            <?php endif; ?>
            <?php if ($successMessage !== null): ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($successMessage) ?>
                </div>
            <?php endif; ?>

            <section class="add-user-panel">
                <h2 class="table-title mb-4"><i class="fa-solid fa-id-card"></i> Detail Informasi Mata Kuliah</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="add_course">
                    <div class="row g-3">
                        <div class="col-md-8"><label for="kode" class="form-label">Kode Mata Kuliah</label><input type="text" class="form-control" name="kode" id="kode" required placeholder="Contoh: MK004"></div>
                        <div class="col-md-4"><label for="sks" class="form-label">Jumlah SKS</label><input type="number" class="form-control" name="sks" id="sks" min="1" max="6" required placeholder="3"></div>
                    </div>
                    <div class="mt-3 mb-3"><label for="nama_mk" class="form-label">Nama Mata Kuliah</label><input type="text" class="form-control" name="nama_mk" id="nama_mk" required placeholder="Masukkan nama mata kuliah"></div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4"><label for="hari" class="form-label">Hari Kuliah</label><select class="form-select" name="hari" id="hari" required>
                                <option value="" selected disabled>Pilih hari</option><?php foreach ($weekdays as $weekday): ?><option value="<?= $weekday ?>"><?= $weekday ?></option><?php endforeach; ?>
                            </select></div>
                        <div class="col-md-4"><label for="jam" class="form-label">Jam Pertemuan</label><input type="text" class="form-control" name="jam" id="jam" required placeholder="08:00 - 10:30"></div>
                        <div class="col-md-4"><label for="ruangan" class="form-label">Ruangan Kelas</label><input type="text" class="form-control" name="ruangan" id="ruangan" required placeholder="Contoh: L-302"></div>
                    </div>
                    <div class="mb-4"><label for="dosen_id" class="form-label">Dosen Pengampu</label><select class="form-select" name="dosen_id" id="dosen_id" required>
                            <option value="" selected disabled>-- Pilih Dosen Pengampu --</option>
                            <?php foreach ($lecturers as $lecturer): ?>
                                <option value="<?= (int) $lecturer['id'] ?>">
                                    <?= htmlspecialchars(($lecturer['nid'] ?? '-') . ' - ' . ($lecturer['nama'] ?? '')) ?>
                                </option>
                            <?php endforeach; ?>
                        </select></div>
                    <button type="submit" class="btn btn-gold btn-sm"><i class="fa-solid fa-circle-check me-1">
                        </i> Simpan Mata Kuliah</button>
                    <a href="adminP.php" class="btn btn-outline-warning btn-sm ms-1">Batal</a>
                </form>
            </section>

        </main>

    </div>

</body>

</html>