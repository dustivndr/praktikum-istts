<?php
require_once __DIR__ . '/auth.php';
require_login();

if (isset($_GET['action']) && $_GET['action'] === 'leaderboard') {
    $stmt = $pdo->query('SELECT u.username, l.completion_time FROM leaderboard l JOIN users u ON u.id = l.user_id ORDER BY l.completion_time ASC, l.created_at ASC LIMIT 10');
    echo json_encode(['items' => $stmt->fetchAll()]);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'save_score' && isset($_POST['completion_time'])) {
    $time = (int) $_POST['completion_time'];
    if ($time < 1 || $time > 86400) {
        echo json_encode(['message' => 'Waktu permainan tidak valid.']);
        exit;
    }
    $stmt = $pdo->prepare('INSERT INTO leaderboard (user_id, completion_time) VALUES (?, ?)');
    $stmt->execute([$_SESSION['user_id'], $time]);
    echo json_encode(['message' => 'Skor berhasil disimpan.']);
    exit;
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sudoku Studio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="game-page">
    <header class="topbar"><a class="brand" href="index.php"><span class="brand-mark"><i class="fa-solid fa-table-cells"></i></span><span>Sudoku Game</span></a>
        <div class="top-actions"><span class="welcome"><i class="fa-solid fa-user"></i> &nbsp;<?= e($_SESSION['username']) ?></span><a class="logout-link" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></div>
    </header>
    <main class="game-layout">
        <section class="game-main">
            <div class="game-heading">
                <div>
                    <h1><i class="fa-solid fa-puzzle-piece"></i> Papan Sudoku 9x9</h1>
                    <p>Isi setiap baris, kolom, dan kotak 3x3 dengan angka 1 sampai 9.</p>
                </div>
                <div class="game-controls">
                    <button id="new-game" class="outline-btn"><i class="fa-solid fa-rotate"></i> &nbsp; Game Baru</button>
                    <div class="game-stats">
                        <div><span class="stat-label"><i class="fa-solid fa-xmark"></i> KESALAHAN </span><strong><span id="mistakes">0</span><small> / 3</small></strong></div>
                        <div><span class="stat-label"><i class="fa-regular fa-clock"></i> WAKTU </span><strong id="timer">00:00</strong></div>
                        <div><span class="stat-label">HINT TERSISA</span><strong id="hints-left">3</strong></div>
                    </div>
                </div>
            </div>
            <div class="board-wrap">
                <div id="sudoku-board" class="sudoku-board" aria-label="Papan Sudoku"></div>
            </div>
            <div class="tools"><button class="tool-btn" data-tool="pencil"><i class="fa-solid fa-pencil"></i> <span>Pensil</span></button><button class="tool-btn" data-tool="erase"><i class="fa-solid fa-eraser"></i> <span>Hapus</span></button><button class="tool-btn" data-tool="hint"><i class="fa-solid fa-lightbulb"></i> <span>Hint</span></button></div>
            <div id="number-pad" class="number-pad"></div>
        </section>
        <aside class="leaderboard">
            <div class="leader-head">
                <div>
                    <h2>Leaderboard</h2>
                </div><span class="trophy"><i class="fa-solid fa-trophy"></i></span>
            </div>
            <div class="leader-columns"><span>#</span><span>Pemain</span><span>Waktu</span></div>
            <div id="leaderboard-list" class="leader-list">
                <div class="loading">Memuat skor...</div>
            </div>
        </aside>
    </main>
    <div id="modal" class="modal" hidden>
        <div class="modal-card">
            <div id="modal-icon" class="modal-icon"><i class="fa-solid fa-star"></i></div>
            <h2 id="modal-title">Congratulations!</h2>
            <p id="modal-message">Kamu berhasil menyelesaikan puzzle.</p>
            <div class="modal-actions"><button id="modal-primary" class="primary-btn">Main lagi</button></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="app.js"></script>
</body>

</html>