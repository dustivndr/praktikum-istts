<?php
require_once 'data.php';

$authUser = json_decode($_COOKIE['auth_user'] ?? '', true);
if (($authUser['role'] ?? null) !== 'admin') {
    header('Location: login.php');
    exit;
}

$users = json_decode($_COOKIE['users'] ?? '[]', true) ?: [];
$matakuliah = json_decode($_COOKIE['matakuliah'] ?? '[]', true) ?: [];

$totalDosen = 0;
$totalMahasiswa = 0;
foreach ($users as $user) {
    if (array_key_exists('nid', $user)) {
        $totalDosen++;
    }
    if (array_key_exists('nim', $user)) {
        $totalMahasiswa++;
    }
}

$totalUsers = count($users);
$totalMatakuliah = count($matakuliah);

if (isset($_POST['action']) && $_POST['action'] === 'edit_user') {
    $userId = (int) ($_POST['user_id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $identity = trim($_POST['identity'] ?? '');
    $newPassword = $_POST['password'] ?? '';
    $errorMessage = '';
    $editedUserIndex = null;

    foreach ($users as $index => $user) {
        if ((int) ($user['id'] ?? 0) === $userId) {
            $editedUserIndex = $index;
            break;
        }
    }

    if ($editedUserIndex === null) {
        $errorMessage = 'Pengguna tidak ditemukan.';
    } elseif (strlen($name) < 3) {
        $errorMessage = 'Nama harus memiliki minimal 3 karakter.';
    } elseif (array_key_exists('nim', $users[$editedUserIndex]) && strlen($identity) < 6) {
        $errorMessage = 'NIM harus memiliki minimal 6 karakter.';
    } elseif ($newPassword !== '' && strlen($newPassword) < 6) {
        $errorMessage = 'Password baru harus memiliki minimal 6 karakter.';
    }

    if ($errorMessage === '') {
        foreach ($users as $index => $user) {
            if ($index !== $editedUserIndex && ($user['email'] ?? '') === $email) {
                $errorMessage = 'Email sudah digunakan oleh pengguna lain.';
                break;
            }

            if ($index !== $editedUserIndex && array_key_exists('nim', $users[$editedUserIndex])
                && ($user['nim'] ?? '') === $identity) {
                $errorMessage = 'NIM sudah digunakan oleh pengguna lain.';
                break;
            }
        }
    }

    if ($errorMessage !== '') {
        setcookie('error_message', $errorMessage, time() + 10, '/');
    } else {
        $users[$editedUserIndex]['nama'] = $name;
        $users[$editedUserIndex]['email'] = $email;
        $identityKey = array_key_exists('nim', $users[$editedUserIndex]) ? 'nim' : 'nid';
        $users[$editedUserIndex][$identityKey] = $identity;

        if ($newPassword !== '') {
            $users[$editedUserIndex]['password'] = $newPassword;
        }

        setcookie('users', json_encode($users), time() + (86400 * 30), '/');
        setcookie('success_message', 'Informasi pengguna berhasil diperbarui.', time() + 10, '/');
    }

    header('Location: adminP.php');
    exit;
}

if (isset($_POST['action']) && $_POST['action'] === 'toggle_ban') {
    $userId = (int) ($_POST['user_id'] ?? 0);
    $banMessage = 'Pengguna tidak ditemukan.';

    foreach ($users as &$user) {
        if ((int) ($user['id'] ?? 0) === $userId && ($user['role'] ?? '') !== 'admin') {
            $user['banned'] = ((int) ($user['banned'] ?? 0) === 0) ? 1 : 0;
            $banAction = $user['banned'] === 1 ? 'dibanned' : 'diunbanned';
            $banMessage = 'Akun ' . ($user['nama'] ?? 'pengguna') . ' berhasil ' . $banAction . '.';
            break;
        }
    }
    unset($user);

    setcookie('users', json_encode($users), time() + (86400 * 30), '/');
    setcookie('ban_message', $banMessage, time() + 10, '/');
    header('Location: adminP.php');
    exit;
}

$banMessage = $_COOKIE['ban_message'] ?? null;
if ($banMessage !== null) {
    setcookie('ban_message', '', time() - 3600, '/');
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

            <?php if ($banMessage !== null): ?>
                <div class="ban-alert" role="alert">
                    <i class="fa-solid fa-circle-info"></i>
                    <?= htmlspecialchars($banMessage) ?>
                </div>
            <?php endif; ?>

            <!-- stats -->
            <div class="row g-4 mb-4">
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
                            for ($firstIndex = 0; $firstIndex < count($users) - 1; $firstIndex++) {
                                for ($secondIndex = $firstIndex + 1; $secondIndex < count($users); $secondIndex++) {
                                    if ((int) $users[$firstIndex]['id'] > (int) $users[$secondIndex]['id']) {
                                        $temporaryUser = $users[$firstIndex];
                                        $users[$firstIndex] = $users[$secondIndex];
                                        $users[$secondIndex] = $temporaryUser;
                                    }
                                }
                            }

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
                                        <button
                                            type="button"
                                            class="btn-action btn-edit"
                                            title="Edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal"
                                            data-user-id="<?= htmlspecialchars((string) $id) ?>"
                                            data-user-name="<?= htmlspecialchars($name, ENT_QUOTES) ?>"
                                            data-user-email="<?= htmlspecialchars($email, ENT_QUOTES) ?>"
                                            data-user-identity="<?= htmlspecialchars($identityNumber === '-' ? '' : $identityNumber, ENT_QUOTES) ?>"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <?php if ($role !== 'admin') { ?>
                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="action" value="toggle_ban">
                                            <input type="hidden" name="user_id" value="<?= htmlspecialchars((string) $id) ?>">
                                            <button type="submit" class="btn-action <?= $status === 'aktif' ? 'btn-ban' : 'btn-unban' ?>">
                                                <i class="fa-solid fa-ban"></i> <?= $status === 'aktif' ? 'Ban' : 'Unban' ?>
                                            </button>
                                        </form>
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

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content edit-user-modal">
                <div class="modal-header">
                    <h2 class="modal-title" id="editUserModalLabel">Edit Informasi Pengguna</h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form method="POST" id="editUserForm">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit_user">
                        <input type="hidden" name="user_id" id="editUserId">

                        <div class="mb-3">
                            <label for="editUserName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control edit-user-input" name="name" id="editUserName" minlength="3" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control edit-user-input" name="email" id="editUserEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUserIdentity" class="form-label">NID / NIM</label>
                            <input type="text" class="form-control edit-user-input" name="identity" id="editUserIdentity" required>
                        </div>
                        <div class="mb-3">
                            <label for="editUserPassword" class="form-label">Password Baru (kosongi jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control edit-user-input" name="password" id="editUserPassword" minlength="6" placeholder="Password lama tetap dipakai">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gold">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($_COOKIE['error_message'])): ?>
        <div class="alert alert-danger edit-alert" role="alert">
            <?= htmlspecialchars($_COOKIE['error_message']) ?>
        </div>
        <?php setcookie('error_message', '', time() - 3600, '/'); ?>
    <?php endif; ?>

    <?php if (isset($_COOKIE['success_message'])): ?>
        <div class="alert alert-success edit-alert" role="alert">
            <?= htmlspecialchars($_COOKIE['success_message']) ?>
        </div>
        <?php setcookie('success_message', '', time() - 3600, '/'); ?>
    <?php endif; ?>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
    <script>
        const editUserModal = document.getElementById('editUserModal');

        editUserModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;

            document.getElementById('editUserId').value = button.dataset.userId;
            document.getElementById('editUserName').value = button.dataset.userName;
            document.getElementById('editUserEmail').value = button.dataset.userEmail;
            document.getElementById('editUserIdentity').value = button.dataset.userIdentity;
            document.getElementById('editUserPassword').value = '';
        });
    </script>
    <!-- kalo ngikut file soal itu pake popup, jadi perlu pake ini ^^ -->
</body>

</html>