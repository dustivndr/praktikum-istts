<?php
require_once __DIR__ . "/dataGames.php";

$game = $games[1];

$harga = $game["harga"];
$diskon = $game["diskon"];

$hargaDiskon = (int) round($harga - ($harga * $diskon / 100));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <header>
        <div class="top-bar">

            <div class="top-left">

                <a href="./index.php" class="steam-logo">
                    <img src="./steamicon.png" alt="Steam" style="height: 25px; width: auto;">
                </a>

                <nav class="main-nav">
                    <a href="#" class="active">STORE</a>
                    <a href="#">LIBRARY</a>
                    <a href="#">COMMUNITY</a>
                    <a href="./dashboard.php">DASHBOARD</a>
                </nav>

            </div>

            <div class="account-area">

                <button class="icon-button">&#128226;</button>

                <button class="account-button">
                    <span class="account-icon">&#128100;</span>
                    <span>tintin</span>
                    <span class="arrow">&#9660;</span>
                </button>

                <span class="wallet">Rp 67.420</span>

                <span class="arrow">&#9660;</span>

            </div>

        </div>

        <div class="sub-bar">

            <nav class="secondary-nav">

                <a href="#">
                    Browse
                    <span class="dropdown">&#9660;</span>
                </a>

                <a href="#">
                    Recommendations
                    <span class="dropdown">&#9660;</span>
                </a>

                <a href="#">
                    Categories
                    <span class="dropdown">&#9660;</span>
                </a>

                <a href="#">
                    Ways to Play
                    <span class="dropdown">&#9660;</span>
                </a>

                <a href="#">
                    Special Sections
                    <span class="dropdown">&#9660;</span>
                </a>

            </nav>


            <div class="right-controls">

                <div class="search-box">
                    <input type="text" placeholder="Search the store">
                    <button>&#128269;</button>
                </div>

                <a href="#" class="small-control">
                    <span>☆</span>
                    Wishlist
                    <b>3</b>
                </a>

                <a href="#" class="small-control">
                    <span>&#128722;</span>
                    Cart
                    <b>1</b>
                </a>

            </div>

        </div>
    </header>

    <main>
        <div class="game-detail-page">
            <a href="./index.php" class="detail-back-link">&#8592; Kembali ke Daftar Game</a>

            <section class="game-detail-panel">
                <div class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <img
                            src="<?= $game["gambar"] ?>"
                            class="game-detail-image"
                            alt="<?= $game["judul"] ?>">
                    </div>

                    <div class="col-md-7">
                        <span class="detail-genre"><?= $game["genre"] ?></span>
                        <h1 class="detail-title"><?= $game["judul"] ?></h1>
                        <p class="detail-description"><?= $game["deskripsi"] ?></p>

                        <div class="detail-facts">
                            <p><span>&#60;/&#62;</span> <strong>Developer:</strong> <?= $game["developer"] ?></p>
                            <p><span>&#128197;</span> <strong>Tanggal Rilis:</strong> <?= $game["rilis"] ?></p>
                            <p><span>&#11088;</span> <strong>Rating:</strong> <?= $game["rating"] ?> / 5.0</p>
                        </div>

                        <div class="detail-purchase">
                            <?php if ($diskon > 0): ?>
                                <span class="discount">-<?= $diskon ?>%</span>
                                <span class="original-price">Rp <?= number_format($harga, 0, ',', '.') ?></span>
                                <strong class="detail-discounted-price">Rp <?= number_format($hargaDiskon, 0, ',', '.') ?></strong>
                            <?php elseif ($harga === 0): ?>
                                <strong class="detail-discounted-price">Gratis / Free to Play</strong>
                            <?php else: ?>
                                <strong class="detail-discounted-price">Rp <?= number_format($harga, 0, ',', '.') ?></strong>
                            <?php endif; ?>

                            <button type="button" class="detail-cart-button">&#128722; Tambah ke Keranjang</button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="other-games-section">
                <h2 class="other-games-title">Game Lainnya</h2>

                <div class="row g-3">
                    <?php foreach ($games as $otherGame): ?>
                        <?php if ($otherGame["id"] === $game["id"]) continue; ?>

                        <div class="col-6 col-md-4 col-lg-3">
                            <article class="other-game-card">
                                <img
                                    src="<?= $otherGame["gambar"] ?>"
                                    alt="<?= $otherGame["judul"] ?>">
                                <h3><?= $otherGame["judul"] ?></h3>
                                <p><?= $otherGame["genre"] ?></p>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </main>

    <footer class="site-footer">
        &copy; 2026 oll right reserve &ndash; Dustin Ivander (225117159) - SteamKu
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>

</body>

</html>