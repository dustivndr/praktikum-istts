<?php
  require 'data.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TUTORRR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="title navbar-brand ps-lg-4" href="#">Pokemon Page</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto pe-lg-4">
            <li class="nav-item">
              <a class="title-nav nav-link active" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="title-nav nav-link active" href="#">Pokemon List</a>
            </li>
            <li class="nav-item">
              <a class="title-nav nav-link active" href="#">About</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="header d-flex align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-9 text-center">
            <div class="header-box d-flex align-items-center">
              <img src="./logoPokemon.png" alt="Pokemon Logo" class="pokemon-logo me-4">

              <div>
                <h1 class="header-title">Welcome to the Pokemon Page!</h1>
                <p class="header-subtitle">Explore various Pokemon and their details.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content container mb-4">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($pokemon as $p) : ?>
        <div class="col">
          <div class="card h-100">
            <img src="<?= $p['gambar'] ?>" class="card-img-top" alt="...">
            <div class="card-body p-4">
              <h5 class="card-title mb-2"><?= $p['nama'] ?></h5>
              
              <!-- element e pokemon  -->
              <div class="element-types">
                <?php 
                  $elements = explode('/', $p['element']); // explode buat mecahin element e dimasukin ke array, ex: "Fire/Flying" -> ["Fire","Flying"]
                  $firstElement = trim($elements[0]); // trim buat buangin spasi ex: " Fire" -> "Fire" sama ngambil elemen pertama buat warna badge e
                  $elementClass = 'type-' . strtolower($firstElement); // toLower buat kecilin semua huruf, trus ditambain type- buat di cssnya nanti
                  echo "<span class='type-badge {$elementClass}'>" . $p['element'] . "</span>";
                ?>
              </div>

              <!-- Skills Section -->
              <div class="pokemon-skills">
                <div class="skill-title">Skills:</div>
                <div class="skill-list">
                  <?php if(isset($p['skill']) && is_array($p['skill'])): ?>
                    <?php for ($i=0; $i < 2; $i++): ?>
                      <span class="skill-item"><?= $p['skill'][$i] ?? '' ?></span>
                    <?php endfor; ?>
                  <?php endif; ?>
                </div>
              </div>

              <p class="card-text small mt-2"><?= substr($p['deskripsi'], 0, 80) ?>...</p> 
            </div>
          </div>
        </div>
        <?php endforeach; ?>
    </div>

    <footer class="footer mt-5 py-4 border-top">
      <div class="container d-flex flex-wrap justify-content-between align-items-center">
        <p class="mb-0">© 2025 Pokemon Page</p>

        <a href="#" class="d-flex align-items-center mb-0 text-decoration-none">
          <img src="./logoPokemon.png" alt="Logo" width="40" height="32" class="me-2">
        </a>

        <ul class="nav">
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pokemon List</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>
      </div>
    </footer>


</body>
</html>