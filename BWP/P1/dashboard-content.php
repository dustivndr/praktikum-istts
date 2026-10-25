<?php

$totalGames = count($games);

$totalNormal = 0;
$totalAfterDiscount = 0;

$discountedGames = 0;
$freeGames = 0;

$totalRating = 0;

$highestRatedGame = null;

$genreCounts = [];


foreach ($games as $game) {

    $harga = $game["harga"];
    $diskon = $game["diskon"];

    $totalNormal += $harga;

    $hargaDiskon = $harga - ($harga * $diskon / 100);

    $totalAfterDiscount += $hargaDiskon;

    if ($diskon > 0) {
        $discountedGames++;
    }

    if ($harga == 0) {
        $freeGames++;
    }

    $totalRating += $game["rating"];


    if (
        $highestRatedGame === null ||
        $game["rating"] > $highestRatedGame["rating"]
    ) {
        $highestRatedGame = $game;
    }

    $genre = $game["genre"];

    if (!isset($genreCounts[$genre])) {
        $genreCounts[$genre] = 0;
    }

    $genreCounts[$genre]++;
}

$averageRating = $totalGames > 0
    ? $totalRating / $totalGames
    : 0;

$totalSaving = $totalNormal - $totalAfterDiscount;

arsort($genreCounts);

?>

<section class="dashboard">

    <div class="dashboard-header">

        <h1>
            <span class="dashboard-icon">&#128200;</span>
            Dashboard Steamm
        </h1>

        <p>Ringkasan data seluruh game yang ada di Steam.</p>

    </div>

    <div class="row g-3 dashboard-stats">

        <div class="col-12 col-md-6 col-xl-3">

            <div class="dashboard-card stat-card">

                <div class="stat-icon icon-blue">&#127918;</div>

                <div class="stat-info">

                    <div class="stat-value">
                        <?= $totalGames ?>
                    </div>

                    <div class="stat-label">
                        Total Game
                    </div>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-6 col-xl-3">

            <div class="dashboard-card stat-card">

                <div class="stat-icon icon-green">&#127991;</div>

                <div class="stat-info">

                    <div class="stat-value">
                        <?= $discountedGames ?>
                    </div>

                    <div class="stat-label">
                        Sedang Diskon
                    </div>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-6 col-xl-3">

            <div class="dashboard-card stat-card">

                <div class="stat-icon icon-orange">&#127873;</div>

                <div class="stat-info">

                    <div class="stat-value">
                        <?= $freeGames ?>
                    </div>

                    <div class="stat-label">
                        Game Gratis
                    </div>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-6 col-xl-3">

            <div class="dashboard-card stat-card">

                <div class="stat-icon icon-yellow">&#9733;</div>

                <div class="stat-info">

                    <div class="stat-value">
                        <?= number_format($averageRating, 1) ?>
                    </div>

                    <div class="stat-label">
                        Rata-rata Rating
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row g-3 dashboard-middle">

        <div class="col-12 col-lg-6">

            <div class="dashboard-card catalog-card">

                <h2>
                    <span>&#128176;</span>
                    Nilai Katalog
                </h2>


                <div class="catalog-row">

                    <span>Total harga normal</span>

                    <strong>
                        Rp <?= number_format($totalNormal, 0, ',', '.') ?>
                    </strong>

                </div>


                <div class="catalog-row">

                    <span>Total setelah diskon</span>

                    <strong>
                        Rp <?= number_format($totalAfterDiscount, 0, ',', '.') ?>
                    </strong>

                </div>


                <hr>


                <div class="catalog-row saving">

                    <span>
                        Total penghematan
                    </span>

                    <strong>
                        Rp <?= number_format($totalSaving, 0, ',', '.') ?>
                    </strong>

                </div>

            </div>

        </div>

        <div class="col-12 col-lg-6">

            <div class="dashboard-card top-rated-card">

                <h2>
                    <span>&#128081;</span>
                    Rating Tertinggi
                </h2>


                <?php if ($highestRatedGame !== null): ?>

                    <div class="top-rated-game">

                        <img
                            src="<?= $highestRatedGame["gambar"] ?>"
                            alt="<?= $highestRatedGame["judul"] ?>">


                        <div class="top-rated-info">

                            <h3>
                                <?= $highestRatedGame["judul"] ?>
                            </h3>


                            <span class="top-rated-genre">
                                <?= $highestRatedGame["genre"] ?>
                            </span>


                            <div class="top-rated-rating">

                                <span>
                                    &#9733;
                                </span>

                                <?= number_format($highestRatedGame["rating"], 1) ?>

                                / 5.0

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

    <div class="dashboard-card genre-card">

        <h2>
            <span>&#128202;</span>
            Distribusi Genre
        </h2>


        <?php foreach ($genreCounts as $genre => $count): ?>

            <?php
            $percentage = $totalGames > 0
                ? ($count / $totalGames) * 100
                : 0;
            ?>

            <div class="genre-item">

                <div class="genre-header">

                    <span>
                        <?= $genre ?>
                    </span>

                    <span>
                        <?= $count ?> game
                        (<?= round($percentage) ?>%)
                    </span>

                </div>


                <div class="genre-progress">

                    <div
                        class="genre-progress-bar"
                        style="width: <?= $percentage ?>%;"></div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>