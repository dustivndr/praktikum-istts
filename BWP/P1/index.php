<?php require_once __DIR__ . "/dataGames.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SteamKu</title>
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

                <a href="#" class="steam-logo">
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
                <button class="icon-button">&#128276;</button>

                <button class="account-button">
                    <span class="account-icon">&#128100;</span>
                    <span>tintin</span>
                    <span class="wallet">Rp 67.420</span>
                    <span class="arrow">&#9660;</span>
                </button>

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

    <section class="hero">

        <div class="hero-image"></div>

        <div class="hero-content">

            <h1>
                STEAMKU <span style="color: #f5d547;">MEGA</span><br>
                SALE FEST
            </h1>

            <div class="hero-tag">
                <span class="tag-icon">&#127991;</span>
                <span>DISKON, GAME BARU, DAN LAINNYA</span>
            </div>

        </div>

    </section>

    <main>

        <section class="featured-section">

            <div class="container-fluid">

                <h2 class="featured-title">Featured & Recommended</h2>

                <div id="featuredCarousel"
                    class="carousel slide"
                    data-bs-ride="carousel">

                    <div class="carousel-inner">

                        <?php foreach ($games as $index => $game): ?>

                            <?php
                            $hargaDiskon = $game["harga"] * (1 - $game["diskon"] / 100);
                            ?>

                            <div class="carousel-item <?= $index === array_key_first($games) ? 'active' : '' ?>">

                                <div class="row g-3">

                                    <div class="col-lg-8">

                                        <div class="featured-image-container">

                                            <img
                                                src="<?= $game["gambar"] ?>"
                                                class="featured-main-image">

                                            <div class="featured-image-info">
                                                <span class="game-genre"><?= $game["genre"] ?></span>
                                                <h3 class="game-title"><?= $game["judul"] ?></h3>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="featured-info">

                                            <h3 class="info-title"><?= $game["judul"] ?></h3>

                                            <div class="release-date">
                                                <span>&#128197;</span>
                                                <span>Rilis: <?= $game["rilis"] ?></span>
                                            </div>

                                            <div class="game-screenshots">

                                                <img src="<?= $game["gambar"] ?>" alt="">
                                                <img src="<?= $game["gambar"] ?>" alt="">
                                                <img src="<?= $game["gambar"] ?>" alt="">
                                                <img src="<?= $game["gambar"] ?>" alt="">

                                            </div>

                                            <p class="game-description">
                                                <?= $game["deskripsi"] ?>
                                            </p>

                                            <div class="game-price">

                                                <?php if ($game["diskon"] > 0): ?>

                                                    <span class="discount">
                                                        -<?= $game["diskon"] ?>%
                                                    </span>

                                                    <span class="original-price">
                                                        Rp <?= number_format($game["harga"], 0, ',', '.') ?>
                                                    </span>

                                                    <br>

                                                    <span class="discounted-price">
                                                        Rp <?= number_format($hargaDiskon, 0, ',', '.') ?>
                                                    </span>

                                                <?php elseif ($game["harga"] === 0): ?>

                                                    <span class="free-price">Gratis / Free to Play</span>

                                                <?php else: ?>

                                                    <span class="regular-price">Rp <?= number_format($game["harga"], 0, ',', '.') ?></span>

                                                <?php endif; ?>

                                            </div>

                                            <a href="./gamedetail.php" class="btn btn-detail">
                                                <span class="detail-icon">&#128065;</span>
                                                Lihat Detail
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                    <button
                        class="carousel-control-prev custom-carousel-button"
                        type="button"
                        data-bs-target="#featuredCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <button
                        class="carousel-control-next custom-carousel-button"
                        type="button"
                        data-bs-target="#featuredCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>

                    <div class="carousel-indicators">

                        <?php foreach ($games as $index => $game): ?>

                            <button
                                type="button"
                                data-bs-target="#featuredCarousel"
                                data-bs-slide-to="<?= $index - array_key_first($games) ?>"
                                class="<?= $index === array_key_first($games) ? 'active' : '' ?>"></button>

                        <?php endforeach; ?>

                    </div>

                </div>

            </div>

        </section>

        <section class="all-games-section">

            <div class="container-fluid">

                <div class="all-games-heading">
                    <h2 class="featured-title mb-0">&#128293; Semua Game</h2>
                    <span class="game-count"><?= count($games) ?> item</span>
                </div>

                <div class="row all-games-layout">

                    <style>
                        <?php foreach ($games as $game): ?>.all-games-layout:has(.card-game-link[data-game-id="<?= $game["id"] ?>"]:hover, .card-game-link[data-game-id="<?= $game["id"] ?>"]:focus) .game-preview[data-preview-id="<?= $game["id"] ?>"] {
                            display: block;
                        }
                        <?php endforeach; ?>
                    </style>

                    <div class="col-md-8">
                        <div class="game-list">
                            <?php foreach ($games as $game): ?>

                                <?php
                                $hargaDiskon = $game["harga"] * (1 - $game["diskon"] / 100);
                                ?>

                                <a href="gamedetail.php" class="card-game-link" data-game-id="<?= $game["id"] ?>">
                                    <article class="card-game">
                                        <img
                                            src="<?= $game["gambar"] ?>"
                                            class="card-game-image"
                                            alt="<?= $game["judul"] ?>">

                                        <div class="card-game-body">
                                            <h3 class="card-game-title"><?= $game["judul"] ?></h3>
                                            <p class="card-game-meta"><?= implode(', ', $game["tags"]) ?></p>
                                            <p class="card-game-release">Released: <?= $game["rilis"] ?></p>
                                        </div>

                                        <div class="card-game-price">
                                            <?php if ($game["diskon"] > 0): ?>
                                                <span class="card-discount">-<?= $game["diskon"] ?>%</span>
                                                <span class="card-original-price">Rp <?= number_format($game["harga"], 0, ',', '.') ?></span>
                                                <strong>Rp <?= number_format($hargaDiskon, 0, ',', '.') ?></strong>
                                            <?php elseif ($game["harga"] === 0): ?>
                                                <strong>Gratis / Free to Play</strong>
                                            <?php else: ?>
                                                <strong>Rp <?= number_format($game["harga"], 0, ',', '.') ?></strong>
                                            <?php endif; ?>
                                        </div>
                                    </article>
                                </a>

                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <?php foreach ($games as $index => $game): ?>
                            <?php $previewPrice = $game["harga"] * (1 - $game["diskon"] / 100); ?>

                            <article class="game-preview <?= $index === array_key_first($games) ? 'is-default' : '' ?>" data-preview-id="<?= $game["id"] ?>">
                                <img
                                    src="<?= $game["gambar"] ?>"
                                    class="preview-image"
                                    alt="<?= $game["judul"] ?>">

                                <h3 class="preview-title"><?= $game["judul"] ?></h3>
                                <p class="preview-subtitle">Overall User Reviews</p>
                                <p class="preview-rating"><?= $game["labelUlasan"] ?> (<?= number_format($game["jumlahUlasan"], 0, '.', '.') ?>)</p>

                                <div class="preview-tags">
                                    <?php foreach ($game["tags"] as $tag): ?><span><?= $tag ?></span><?php endforeach; ?>
                                </div>

                                <p class="preview-description"><?= $game["deskripsi"] ?></p>

                                <div class="preview-price">
                                    <?php if ($game["diskon"] > 0): ?>
                                        <span class="card-discount">-<?= $game["diskon"] ?>%</span>
                                        <span class="card-original-price">Rp <?= number_format($game["harga"], 0, ',', '.') ?></span>
                                        <strong>Rp <?= number_format($previewPrice, 0, ',', '.') ?></strong>
                                    <?php elseif ($game["harga"] === 0): ?>
                                        <strong>Gratis / Free to Play</strong>
                                    <?php else: ?>
                                        <strong>Rp <?= number_format($game["harga"], 0, ',', '.') ?></strong>
                                    <?php endif; ?>
                                </div>

                                <div class="preview-thumbnails">
                                    <?php for ($thumbnail = 0; $thumbnail < 2; $thumbnail++): ?>
                                        <img src="<?= $game["gambar"] ?>" alt="">
                                    <?php endfor; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>

        </section>

        <section>
            <?php include_once __DIR__ . "/dashboard-content.php" ?>
        </section>

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