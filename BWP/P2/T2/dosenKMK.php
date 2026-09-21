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
$weekdays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

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

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $courseCode = strtoupper(trim($_POST['kode'] ?? ''));
    $courseIndex = null;

    foreach ($matakuliah as $index => $course) {
        if (($course['kode'] ?? '') === $courseCode && (int) ($course['dosen_id'] ?? 0) === $lecturerId) {
            $courseIndex = $index;
            break;
        }
    }

    if ($action === 'delete_course') {
        if ($courseIndex !== null) {
            unset($matakuliah[$courseIndex]);
            $reindexedMatakuliah = [];
            foreach ($matakuliah as $course) {
                $reindexedMatakuliah[] = $course;
            }
            $matakuliah = $reindexedMatakuliah;
            setcookie('course_message', 'Mata kuliah berhasil dihapus.', time() + 10, '/');
        } else {
            setcookie('course_error', 'Mata kuliah tidak ditemukan.', time() + 10, '/');
        }
    } elseif ($action === 'add_course' || $action === 'update_course') {
        $name = trim($_POST['nama_mk'] ?? '');
        $credits = (int) ($_POST['sks'] ?? 0);
        $day = $_POST['hari'] ?? '';
        $time = trim($_POST['jam'] ?? '');
        $room = trim($_POST['ruangan'] ?? '');
        $errorMessage = '';

        if ($courseCode === '' || $name === '' || $time === '' || $room === '') {
            $errorMessage = 'Semua informasi mata kuliah harus diisi.';
        } elseif ($credits < 1 || $credits > 6) {
            $errorMessage = 'SKS harus berada di antara 1 dan 6.';
        } elseif (!in_array($day, $weekdays, true)) {
            $errorMessage = 'Hari kuliah tidak valid.';
        } else {
            foreach ($matakuliah as $index => $course) {
                if (($course['kode'] ?? '') === $courseCode && $index !== $courseIndex) {
                    $errorMessage = 'Kode mata kuliah sudah digunakan.';
                    break;
                }
            }
        }

        if ($errorMessage !== '') {
            setcookie('course_error', $errorMessage, time() + 10, '/');
        } elseif ($action === 'add_course') {
            $matakuliah[] = ['kode' => $courseCode, 'nama_mk' => $name, 'sks' => $credits, 'hari' => $day, 'jam' => $time, 'ruangan' => $room, 'dosen_id' => $lecturerId];
            setcookie('course_message', 'Mata kuliah berhasil ditambahkan.', time() + 10, '/');
        } elseif ($courseIndex !== null) {
            $matakuliah[$courseIndex] = ['kode' => $courseCode, 'nama_mk' => $name, 'sks' => $credits, 'hari' => $day, 'jam' => $time, 'ruangan' => $room, 'dosen_id' => $lecturerId];
            setcookie('course_message', 'Mata kuliah berhasil diperbarui.', time() + 10, '/');
        } else {
            setcookie('course_error', 'Mata kuliah tidak ditemukan.', time() + 10, '/');
        }
    }

    setcookie('matakuliah', json_encode($matakuliah), time() + (86400 * 30), '/');
    header('Location: dosenKMK.php');
    exit;
}

$courseMessage = $_COOKIE['course_message'] ?? null;
$courseError = $_COOKIE['course_error'] ?? null;
if ($courseMessage !== null) {
    setcookie('course_message', '', time() - 3600, '/');
}
if ($courseError !== null) {
    setcookie('course_error', '', time() - 3600, '/');
}

$myCourses = [];
foreach ($matakuliah as $course) {
    if ((int) ($course['dosen_id'] ?? 0) === $lecturerId) {
        $myCourses[] = $course;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Kuliah - <?= htmlspecialchars($lecturer['nama'] ?? 'Dosen') ?></title>
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
                <div class="lecturer-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="lecturer-profile-text">
                    <strong><?= htmlspecialchars(strtoupper($lecturer['nama'] ?? 'DOSEN')) ?></strong>
                    <span>NID: <?= htmlspecialchars($lecturer['nid'] ?? '-') ?></span>
                    <span>DOSEN PENGAJAR</span>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li>
                    <a href="dosenHome.php" class="nav-link">
                        <i class="fa-solid fa-house"></i> Beranda Dosen</a>
                </li>
                <li>
                    <a href="dosenMW.php" class="nav-link">
                        <i class="fa-solid fa-users"></i> Mahasiswa Wali</a>
                </li>
                <li>
                    <a href="dosenKMK.php" class="nav-link active">
                        <i class="fa-regular fa-rectangle-list"></i> Kelola Mata Kuliah</a>
                </li>
                <li>
                    <a href="logout.php" class="nav-link nav-logout">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
                </li>
            </ul>
        </aside>

        <main class="main-content lecturer-content">
            <div class="page-header lecturer-welcome">
                <div class="header-title-group">
                    <div class="header-icon"><i class="fa-regular fa-rectangle-list"></i></div>
                    <div class="header-text">
                        <h1>Kelola <span>Mata Kuliah</span></h1>
                        <p>Manajemen kurikulum dan jadwal perkuliahan yang Anda ampu</p>
                    </div>
                </div><a href="dosenHome.php" class="btn btn-gold btn-sm"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard</a>
            </div>
            <?php if ($courseMessage !== null): ?>
                <div class="alert alert-success" role="alert"><?= htmlspecialchars($courseMessage) ?>
                </div>
            <?php endif; ?>
            <?php if ($courseError !== null): ?>
                <div class="alert alert-danger" role="alert"><?= htmlspecialchars($courseError) ?>
                </div>
            <?php endif; ?>
            <div class="row g-3">
                <div class="col-12 col-lg-4">
                    <section class="add-user-panel lecturer-course-form">
                        <h2 class="table-title mb-4"><i class="fa-solid fa-circle-plus"></i> Tambah MK Baru</h2>
                        <form method="POST"><input type="hidden" name="action" value="add_course">
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode MK</label>
                                <input type="text" name="kode" id="kode" class="form-control" required placeholder="Contoh: MK005">
                            </div>
                            <div class="mb-3">
                                <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
                                <input type="text" name="nama_mk" id="nama_mk" class="form-control" required placeholder="Nama Mata Kuliah">
                            </div>
                            <div class="mb-3">
                                <label for="sks" class="form-label">SKS</label>
                                <input type="number" name="sks" id="sks" class="form-control" min="1" max="6" value="3" required>
                            </div>
                            <div class="mb-3">
                                <label for="hari" class="form-label">Hari</label>
                                <select name="hari" id="hari" class="form-select" required>
                                    <option value="" selected disabled>Pilih hari</option><?php foreach ($weekdays as $weekday): ?><option value="<?= $weekday ?>"><?= $weekday ?></option><?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jam" class="form-label">Jam Pertemuan</label>
                                <input type="text" name="jam" id="jam" class="form-control" required placeholder="08:00 - 10:30">
                            </div>
                            <div class="mb-4">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <input type="text" name="ruangan" id="ruangan" class="form-control" required placeholder="L-302">
                            </div>
                            <button type="submit" class="btn btn-gold w-100"><i class="fa-solid fa-circle-check me-1"></i> Tambah Mata Kuliah</button>
                        </form>
                    </section>
                </div>
                <div class="col-12 col-lg-8">
                    <section class="table-panel lecturer-table-panel">
                        <h2 class="table-title mb-3"><i class="fa-solid fa-list"></i> Daftar Mata Kuliah Diampu</h2>
                        <div class="table-responsive">
                            <table class="table-dark-custom lecturer-table">
                                <thead>
                                    <tr>
                                        <th>KODE</th>
                                        <th>MATA KULIAH</th>
                                        <th>SKS</th>
                                        <th>JADWAL</th>
                                        <th>RUANGAN</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($myCourses as $course): ?>
                                        <tr>
                                            <td><span class="badge-nid"><?= htmlspecialchars($course['kode'] ?? '-') ?></span></td>
                                            <td class="fw-bold"><?= htmlspecialchars($course['nama_mk'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars((string) ($course['sks'] ?? '-')) ?> SKS</td>
                                            <td><?= htmlspecialchars(($course['hari'] ?? '-') . ', ' . ($course['jam'] ?? '-')) ?></td>
                                            <td><?= htmlspecialchars($course['ruangan'] ?? '-') ?></td>
                                            <td>
                                                <button type="button"
                                                    class="btn-action btn-edit"
                                                    data-course="<?= htmlspecialchars(json_encode($course), ENT_QUOTES, 'UTF-8') ?>"
                                                    onclick="fillCourseForm(this.dataset.course)" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <form method="POST" class="d-inline"
                                                    onsubmit="
                                                    return confirm(&quot;Hapus mata kuliah ini?&quot;);"><input type="hidden" name="action" value="delete_course"><input type="hidden" name="kode" value="<?= htmlspecialchars($course['kode'] ?? '', ENT_QUOTES) ?>">
                                                    <button type="submit" class="btn-action btn-ban" title="Hapus">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?><?php if ($myCourses === []): ?><tr>
                                            <td colspan="6" class="text-muted">Belum ada mata kuliah yang diampu.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </main>

    </div>
    <script>
        function fillCourseForm(courseData) {
            const course = JSON.parse(courseData);
            document.querySelector('[name="action"]').value = 'update_course';
            document.getElementById('kode').value = course.kode || '';
            document.getElementById('kode').readOnly = true;
            document.getElementById('nama_mk').value = course.nama_mk || '';
            document.getElementById('sks').value = course.sks || '';
            document.getElementById('hari').value = course.hari || '';
            document.getElementById('jam').value = course.jam || '';
            document.getElementById('ruangan').value = course.ruangan || '';
            document.querySelector('.lecturer-course-form button[type="submit"]').innerHTML = '<i class="fa-solid fa-pen-to-square me-1"></i> Perbarui Mata Kuliah';
            document.querySelector('.lecturer-course-form').scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
</body>

</html>