<?php
require_once 'data.php';

$authUser = json_decode($_COOKIE['auth_user'] ?? '', true);
if (($authUser['role'] ?? null) !== 'mahasiswa') {
    header('Location: login.php');
    exit;
}

$users = json_decode($_COOKIE['users'] ?? '[]', true) ?: [];
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dosen_wali_id'])) {
    $selectedLecturerId = (int) $_POST['dosen_wali_id'];
    $validLecturer = false;

    foreach ($users as $user) {
        if ((int) ($user['id'] ?? 0) === $selectedLecturerId && ($user['role'] ?? '') === 'dosen') {
            $validLecturer = true;
            break;
        }
    }

    if ($validLecturer) {
        foreach ($users as $index => $user) {
            if ((int) ($user['id'] ?? 0) === $studentId && ($user['role'] ?? '') === 'mahasiswa') {
                $users[$index]['dosen_wali_id'] = $selectedLecturerId;
                break;
            }
        }

        setcookie('users', json_encode($users), time() + (86400 * 30), '/');
        $_COOKIE['users'] = json_encode($users);
        header('Location: mhsHome.php');
        exit;
    }
}

$allLecturers = [];
foreach ($users as $user) {
    if (($user['role'] ?? '') === 'dosen') {
        $allLecturers[] = $user;
    }
}

$currentWaliId = (int) ($student['dosen_wali_id'] ?? 0);
$currentWali = null;
foreach ($allLecturers as $lecturer) {
    if ((int) ($lecturer['id'] ?? 0) === $currentWaliId) {
        $currentWali = $lecturer;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemilihan Dosen Wali</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleMain.css">
</head>

<body class="student-wali-body">

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
                <a href="mhsDW.php" class="student-nav-item active"><i class="fa-solid fa-user-tie"></i> Dosen Wali</a>
                <a href="mhsPMK.php" class="student-nav-item"><i class="fa-regular fa-rectangle-list"></i> Pilih Mata Kuliah</a>
                <a href="mhsJK.php" class="student-nav-item"><i class="fa-regular fa-calendar-days"></i> Jadwal Kuliah</a>
                <a href="logout.php" class="student-nav-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
            </nav>
        </aside>

        <main class="student-wali-main">
            <div class="student-wali-wrapper">
                <div class="student-wali-header">
                    <div>
                        <div class="student-wali-title"><i class="fa-solid fa-user-check"></i> Pemilihan Dosen Wali</div>
                        <div class="student-wali-subtitle">Pilih dosen pendamping akademik Anda untuk semester ini</div>
                    </div>
                    <a href="mhsHome.php" class="student-wali-back-btn"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
                </div>

                <?php if ($currentWali !== null): ?>
                    <div class="student-wali-success">
                        <i class="fa-solid fa-circle-check"></i> Dosen Wali berhasil dipilih!
                    </div>
                <?php endif; ?>

                <section class="student-wali-panel">

                    <div class="student-wali-section-title">
                        <i class="fa-solid fa-user-tie"></i>
                        Daftar Dosen Wali Tersedia
                    </div>
                    <div class="student-wali-subtitle-small">
                        Pilih dosen yang sesuai dengan kebutuhan akademik Anda.
                    </div>

                    <div class="student-wali-grid">

                        <?php foreach ($allLecturers as $lecturer): ?>
                            <?php $isActive = ((int) ($lecturer['id'] ?? 0) === $currentWaliId); ?>
                            <div class="student-wali-card <?= $isActive ? 'active' : '' ?>">

                                <div class="student-wali-card-head">
                                    <div class="student-wali-avatar"><i class="fa-solid fa-user"></i></div>
                                    <div class="student-wali-name"><?= htmlspecialchars($lecturer['nama'] ?? 'Nama Dosen') ?></div>
                                </div>

                                <div class="student-wali-detail">NID: <?= htmlspecialchars($lecturer['nid'] ?? '-') ?></div>
                                <div class="student-wali-detail">Email: <?= htmlspecialchars($lecturer['email'] ?? '-') ?></div>

                                <?php if ($isActive): ?>

                                    <button type="button" class="student-wali-button active-btn" disabled>
                                        <i class="fa-solid fa-check"></i> Dosen Wali Aktif
                                    </button>

                                <?php else: ?>

                                    <form method="POST" action="mhsDW.php">
                                        <input type="hidden" name="dosen_wali_id" value="<?= (int) ($lecturer['id'] ?? 0) ?>">
                                        <button type="submit" class="student-wali-button">
                                            Pilih Dosen Ini
                                        </button>
                                    </form>

                                <?php endif; ?>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </section>

            </div>

        </main>

    </div>

</body>

</html>