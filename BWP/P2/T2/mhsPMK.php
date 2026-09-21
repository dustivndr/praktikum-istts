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

if (isset($_POST['course_code'])) {
    $selectedCourseCode = (string) $_POST['course_code'];
    $currentKrs = $student['krs'] ?? [];
    $updatedKrs = [];
    $alreadySelected = false;

    foreach ($currentKrs as $courseCode) {
        if ($courseCode === $selectedCourseCode) {
            $alreadySelected = true;
            continue;
        }

        $updatedKrs[] = $courseCode;
    }

    if (!$alreadySelected) {
        $updatedKrs[] = $selectedCourseCode;
    }

    foreach ($users as $index => $user) {
        if ((int) ($user['id'] ?? 0) === $studentId && ($user['role'] ?? '') === 'mahasiswa') {
            $users[$index]['krs'] = $updatedKrs;
            break;
        }
    }

    setcookie('users', json_encode($users), time() + (86400 * 30), '/');
    $_COOKIE['users'] = json_encode($users);
    $student['krs'] = $updatedKrs;
}

$selectedCodes = $student['krs'] ?? [];
$selectedTotalSks = 0;
foreach ($matakuliah as $course) {
    if (in_array((string) ($course['kode'] ?? ''), $selectedCodes, true)) {
        $selectedTotalSks += (int) ($course['sks'] ?? 0);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Mata Kuliah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleMain.css">
</head>

<body class="student-course-body">

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
                <a href="mhsPMK.php" class="student-nav-item active"><i class="fa-regular fa-rectangle-list"></i> Pilih Mata Kuliah</a>
                <a href="mhsJK.php" class="student-nav-item"><i class="fa-regular fa-calendar-days"></i> Jadwal Kuliah</a>
                <a href="logout.php" class="student-nav-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
            </nav>
        </aside>

        <main class="student-course-main">

            <div class="student-course-header">
                <div>
                    <div class="student-course-title"><i class="fa-regular fa-rectangle-list"></i> Rencana Studi / Pilih Mata Kuliah</div>
                    <div class="student-course-subtitle">Pilih mata kuliah yang ingin ditempuh pada semester ini</div>
                </div>
                <div class="student-course-total">
                    <i class="fa-regular fa-clipboard"></i> Total SKS: <?= htmlspecialchars((string) $selectedTotalSks) ?> / 24 SKS
                </div>
            </div>

            <section class="student-course-panel">
                <div class="student-course-panel-title">
                    <i class="fa-solid fa-book"></i>
                    Daftar Mata Kuliah Tersedia
                </div>

                <div class="table-responsive">
                    <table class="student-course-table">
                        <thead>
                            <tr>
                                <th>KODE MK</th>
                                <th>MATA KULIAH</th>
                                <th>SKS</th>
                                <th>JADWAL / JAM</th>
                                <th>RUANGAN</th>
                                <th>DOSEN PENGAMPU</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($matakuliah as $course): ?>
                                <?php
                                $courseCode = (string) ($course['kode'] ?? '');
                                $selected = in_array($courseCode, $selectedCodes, true);
                                $lecturer = null;
                                foreach ($users as $user) {
                                    if ((int) ($user['id'] ?? 0) === (int) ($course['dosen_id'] ?? 0) && ($user['role'] ?? '') === 'dosen') {
                                        $lecturer = $user;
                                        break;
                                    }
                                }
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($courseCode) ?></td>
                                    <td class="course-name"><?= htmlspecialchars((string) ($course['nama_mk'] ?? '-')) ?></td>
                                    <td><?= htmlspecialchars((string) ($course['sks'] ?? 0)) ?> SKS</td>
                                    <td><?= htmlspecialchars(($course['hari'] ?? '-') . ', ' . ($course['jam'] ?? '-')) ?></td>
                                    <td><?= htmlspecialchars($course['ruangan'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($lecturer['nama'] ?? 'Dosen belum ditentukan') ?></td>
                                    <td>
                                        <form method="POST" action="mhsPMK.php">
                                            <input type="hidden" name="course_code" value="<?= htmlspecialchars($courseCode) ?>">
                                            <button type="submit" class="student-course-btn <?= $selected ? 'selected' : '' ?>">
                                                <i class="fa-solid fa-check"></i> <?= $selected ? 'Diambil' : 'Ambil MK' ?>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

        </main>

    </div>

</body>

</html>