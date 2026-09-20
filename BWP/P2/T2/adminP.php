<?php
require_once 'data.php';

$authUser = json_decode($_COOKIE['auth_user'] ?? '', true);
if (($authUser['role'] ?? null) !== 'admin') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Super Admin - Kelola Pengguna</title>

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
                    <a href="adminKP.php" class="nav-link active">
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

            <!-- stats -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                        <div class="stat-label">Total Pengguna</div>
                        <h2 class="stat-value val-gold">10</h2>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-address-card"></i></div>
                        <div class="stat-label">Total Dosen</div>
                        <h2 class="stat-value val-cyan">4</h2>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div class="stat-label">Total Mahasiswa</div>
                        <h2 class="stat-value val-green">5</h2>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-book"></i></div>
                        <div class="stat-label">Total Mata Kuliah</div>
                        <h2 class="stat-value val-white">3</h2>
                    </div>
                </div>
            </div>

            <div class="tab-navigation">
                <a href="adminP.php" class="tab-btn tab-active">
                    <i class="fa-solid fa-user-group"></i> Kelola Pengguna
                </a>
                <a href="adminKMK.php" class="tab-btn tab-inactive">
                    <i class="fa-regular fa-file-lines"></i> Kelola Mata Kuliah
                </a>
            </div>

            <div class="table-panel">
                <div class="table-header">
                    <h2 class="table-title">
                        <i class="fa-solid fa-users"></i> Daftar Pengguna Portal Akademik
                    </h2>
                    <button class="btn btn-gold btn-sm py-2 px-3" onclick="window.location.href='adminTUB.php'">
                        <i class="fa-solid fa-user-plus me-1"></i> Tambah User Baru
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table-dark-custom">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NID / NIM</th>
                                <th>NAMA LENGKAP</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>STATUS AKUN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $users = json_decode($_COOKIE['users'], true) ?: [];
                            usort($users, function ($firstUser, $secondUser) {
                                return (int) $firstUser['id'] <=> (int) $secondUser['id'];
                            });
                            // ijin make ini ^^^

                            foreach ($users as $user) {
                                $id = $user['id'];
                                $identityNumber = $user['nid'] ?? $user['nim'] ?? '-';
                                $name = $user['nama'] ?? '-';
                                $email = $user['email'] ?? '-';
                                $role = $user['role'];
                                $status = ((int) ($user['banned'] ?? 0) === 0) ? 'aktif' : 'banned';
                            ?>

                                <tr>
                                    <td><span class="badge-id">#<?= htmlspecialchars((string) $id) ?></span></td>
                                    <td><span class="badge-nid"><?= htmlspecialchars($identityNumber) ?></span></td>
                                    <td class="fw-bold"><?= htmlspecialchars($name) ?></td>
                                    <td><?= htmlspecialchars($email) ?></td>
                                    <td>
                                        <!-- ga ada di kriteria kalo ini bisa buat ngubah user jadi admin/dosen/mahasiswa -->
                                        <select class="form-select form-select-dark">
                                            <option <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
                                            <option <?= $role === 'dosen' ? 'selected' : '' ?>>Dosen</option>
                                            <option <?= $role === 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
                                        </select>
                                    </td>
                                    <td><span class="<?= $status === 'aktif' ? 'badge-status' : 'badge-status-ban' ?>"><?= htmlspecialchars($status) ?></span></td>
                                    <td>
                                        <button class="btn-action btn-edit" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <?php if ($role !== 'admin') {?>
                                        <button class="btn-action btn-ban"><i class="fa-solid fa-ban"></i> Ban</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
</body>

</html>