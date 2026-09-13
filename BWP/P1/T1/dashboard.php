<?php require_once __DIR__ . "/dataGames.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SteamKu</title>
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
                    <a href="./index.php">STORE</a>
                    <a href="#">LIBRARY</a>
                    <a href="#">COMMUNITY</a>
                    <a href="#" class="active">DASHBOARD</a>
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

    <main>
        <?php include_once __DIR__ . "/dashboard-content.php" ?>
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