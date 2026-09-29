<?php require_once('conn.php');?>

<?php 
// Collect totals used by the statistics dashboard.
$stmt = $conn->prepare("SELECT COUNT(*) FROM characters");
$stmt->execute(); 
$total_characters = $stmt->fetchColumn();

$stmt2 = $conn->prepare("SELECT COUNT(*) FROM wands");
$stmt2->execute();
$total_wands = $stmt2->fetchColumn();

$stmt3 = $conn->prepare("SELECT COUNT(*)
FROM characters c
LEFT JOIN wands w ON c.id = w.character_id
WHERE w.character_id IS NULL");
$stmt3->execute();
$characters_without_wand = $stmt3->fetchColumn();

$stmt4 = $conn->prepare("SELECT COUNT(*) 
FROM characters c
JOIN houses h ON c.house_id = h.id
WHERE c.house_id = 1;");
$stmt4->execute();
$total_gryffindor = $stmt4->fetchColumn();

$stmt5 = $conn->prepare("SELECT COUNT(*) 
FROM characters c
JOIN houses h ON c.house_id = h.id
WHERE c.house_id = 2;");
$stmt5->execute();
$total_slytherin = $stmt5->fetchColumn();

$stmt6 = $conn->prepare("SELECT COUNT(*) 
FROM characters c
JOIN houses h ON c.house_id = h.id
WHERE c.house_id = 3;");
$stmt6->execute();
$total_ravenclaw = $stmt6->fetchColumn();

$stmt7 = $conn->prepare("SELECT COUNT(*) 
FROM characters c
JOIN houses h ON c.house_id = h.id
WHERE c.house_id = 4;");
$stmt7->execute();
$total_hufflepuff = $stmt7->fetchColumn();

$stmt8 = $conn->prepare("SELECT COUNT(*) FROM wands 
WHERE core = 'Phoenix feather'");
$stmt8->execute();
$total_phoenix_feather = $stmt8->fetchColumn();

$stmt9 = $conn->prepare("SELECT COUNT(*) FROM wands 
WHERE core = 'Dragon heartstring'");
$stmt9->execute();
$total_dragon_heartstring = $stmt9->fetchColumn();

$stmt10 = $conn->prepare("SELECT COUNT(*) FROM wands 
WHERE core = 'Unicorn hair'");
$stmt10->execute();
$total_unicorn_hair = $stmt10->fetchColumn();

$stmt11 = $conn->prepare("SELECT COUNT(*) FROM wands 
WHERE core = 'Unknown' OR core NOT IN ('Phoenix feather', 'Dragon heartstring', 'Unicorn hair');");
$stmt11->execute();
$total_unknown_core = $stmt11->fetchColumn();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database Statistics & Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        background-color: #f8f9fc;
        font-family: "Inter", sans-serif;
      }
      .container {
        max-width: 1000px;
      }
      .btn-back {
        background-color: #e9f0ff;
        color: #0d6efd;
        font-weight: 500;
        border: none;
        border-radius: 10px;
        padding: 8px 16px;
        transition: 0.2s;
      }
      .btn-back:hover {
        background-color: #dce6ff;
        color: #0a58ca;
      }

      .house-ravenclaw {
        background-color: #c8d4ffff; /* soft blue-lavender */
      }

      .house-gryffindor {
        background-color: #ffe4e4; /* soft red-pink */
      }

      .house-hufflepuff {
        background-color: #fff9e3; /* gentle yellow */
      }

      .house-slytherin {
        background-color: #e6fae9; /* minty green */
      }
      .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      }
      .list-group-item {
        border: none;
        padding: 10px 0;
        font-size: 15px;
      }
      .stat-title {
        font-weight: 600;
        color: #495057;
        margin-bottom: 10px;
      }
      .wand-box {
        border-radius: 15px;
        padding: 20px;
        height: 120px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #333;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      }
      .wand-box h6 {
        font-weight: 600;
      }
      .wand-box p {
        margin-bottom: 8px;
        font-size: 13px;
        opacity: 0.8;
      }
      .wand-box .badge {
        background-color: rgba(0,0,0,0.15);
      }
      .unicorn { background-color: rgba(200, 185, 220, 0.3); }
      .phoenix { background-color: rgba(255, 145, 0, 0.3); }
      .dragon { background-color: rgba(255, 132, 132, 0.3); }
      .unknown { background-color: rgba(169, 182, 255, 0.3); }

      .section-title {
        font-weight: 600;
        color: #555;
        margin-top: 10px;
      }

      .search-bar input {
        border-radius: 10px;
        border: 1px solid #dcdcdc;
        padding: 10px 15px;
      }
      .search-bar button {
        border-radius: 10px;
        margin-left: 10px;
      }

    </style>
  </head>

  <?php
  // function buat kembali ke index
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['btnBack'])){
      header('location: index.php');
    }
  }

  $results = [];
  $search = $_GET['search'] ?? '';

  // Search characters by name, house, or role when a query is provided.
  if ($search != '') {
    $stmt = $conn->prepare("
      SELECT 
        c.name AS character_name, 
        h.name AS house_name, 
        c.role, 
        w.wood, 
        w.core, 
        w.length
      FROM characters c
      LEFT JOIN houses h ON c.house_id = h.id
      LEFT JOIN wands w ON c.id = w.character_id
      WHERE 
        c.name LIKE CONCAT('%', ?, '%') 
        OR h.name LIKE CONCAT('%', ?, '%') 
        OR c.role LIKE CONCAT('%', ?, '%')
      ORDER BY c.name ASC
    ");
    $stmt->execute([$search, $search, $search]); // execute query search untuk name, house, or role
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetch data sebagai array asosiatif
  }
  ?>

  <body class="p-4">

    <div class="container">

      <!-- Back Button -->
      <form method="POST">
        <button type="submit" class="btn btn-primary" name="btnBack">&larr; Back to Characters</button>
      </form>
      

      <!-- Title -->
      <h4 class="text-center fw-bold mb-4">Database Statistics & Search</h4>

      <!-- Search Bar -->
      <div class="card p-3 mb-4">
        <form method="GET" class="d-flex search-bar">
          <input type="text" class="form-control" name="search" placeholder="Search by name, house, or role..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
          <button class="btn btn-primary" type="submit" name="btnSearch">Search</button>
        </form>
      </div>

      <?php if ($search != ''): ?>
        <div class="card p-3 mt-3">
          <h6>Search Results (<?= count($results) ?> found)</h6>
          <?php if (count($results) > 0): ?>
            <table class="table align-middle mt-2">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>House</th>
                  <th>Role</th>
                  <th>Wand</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($results as $row): ?>
                  <tr>
                    <td><?= htmlspecialchars($row['character_name']) ?></td>
                    <td>
                      <?php if ($row['house_name']): ?>
                        <span class="badge house-<?= strtolower($row['house_name']) ?>">
                          <?= htmlspecialchars($row['house_name']) ?>
                        </span>
                      <?php else: ?>
                        <span class="text-muted">–</span>
                      <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['role'] ?? '-') ?></td>
                    <td>
                      <?php if ($row['wood']): ?>
                        <b><?= htmlspecialchars($row['wood']) ?></b>
                        <span class="badge 
                          <?= stripos($row['core'], 'phoenix') !== false ? 'bg-warning text-dark' : 
                            (stripos($row['core'], 'dragon') !== false ? 'bg-danger' : 
                            (stripos($row['core'], 'unicorn') !== false ? 'bg-secondary' : 'bg-info')) ?>">
                          <?= htmlspecialchars($row['core']) ?>
                        </span>
                        <?= htmlspecialchars($row['length']) ?>"
                      <?php else: ?>
                        <span class="text-muted">No wand</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
            <p class="text-muted mt-2 mb-0">No characters found matching “<?= htmlspecialchars($search) ?>”.</p>
          <?php endif; ?>
        </div>
      <?php endif; ?>


      <!-- General & House Stats -->
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <div class="card p-3">
            <h6 class="stat-title">General Statistics</h6>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between" style="background-color: rgba(0, 187, 255, 0.1);">
                <span style="margin-left: 5px;">Total Characters:</span>
                <span class="fw-bold text-primary" style="margin-right: 5px;"><?= $total_characters ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between" style="background-color: rgba(0, 255, 106, 0.1);">
                <span style="margin-left: 5px;">Characters with Wands:</span>
                <span class="fw-bold text-success" style="margin-right: 5px;"><?= $total_wands ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between" style="background-color: rgba(153, 0, 255, 0.1);">
                <span style="margin-left: 5px;">Characters without Wands:</span>
                <span class="fw-bold text-danger" style="margin-right: 5px;"><?= $characters_without_wand ?></span>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card p-3">
            <h6 class="stat-title">Characters per House</h6>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between house-ravenclaw">
              <span style="margin-left: 5px;">Ravenclaw</span>
              <span class="fw-bold text-primary" style="margin-right: 5px;"><?= $total_ravenclaw ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between house-gryffindor">
                <span style="margin-left: 5px;">Gryffindor</span>
                <span class="fw-bold text-danger" style="margin-right: 5px;"><?= $total_gryffindor ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between house-hufflepuff">
                <span style="margin-left: 5px;">Hufflepuff</span>
                <span class="fw-bold text-warning" style="margin-right: 5px;"><?= $total_hufflepuff ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between house-slytherin">
                <span style="margin-left: 5px;">Slytherin</span>
                <span class="fw-bold text-success" style="margin-right: 5px;"><?= $total_slytherin ?></span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Wand Core Section -->
      <h6 class="section-title mb-3">Wand Core Distribution</h6>

      <div class="row g-3">
        <div class="col-md-3">
          <div class="wand-box unicorn text-center">
            <h6>Unicorn Hair</h6>
            <p>🦄 Pure & Consistent</p>
            <span class="badge"><?= $total_unicorn_hair ?> wands</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wand-box phoenix text-center">
            <h6>Phoenix Feather</h6>
            <p>🔥 Rare & Powerful</p>
            <span class="badge"><?= $total_phoenix_feather ?> wands</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wand-box dragon text-center">
            <h6>Dragon Heartstring</h6>
            <p>🐲 Strong & Loyal</p>
            <span class="badge"><?= $total_dragon_heartstring ?> wands</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="wand-box unknown text-center">
            <h6>Unknown</h6>
            <p>❓ Mysterious</p>
            <span class="badge"><?= $total_unknown_core ?> wands</span>
          </div>
        </div>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>