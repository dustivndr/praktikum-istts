<?php require_once('conn.php'); ?>
<?php 
// $_SERVER['REQUEST_METHOD'] menampung method HTTP yang dikirim browser, misalnya 'GET' atau 'POST'.
// GET biasanya dipakai untuk mengambil data dari URL/query string
// sedangkan POST dipakai untuk mengirim data form secara lebih aman/lebih banyak, seperti saat menambah data atau mengirim form. 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset($_POST['btn-add'])){
    $nama = $_POST['nama'];
    $role = $_POST['role'];
    $school = $_POST['school'];
    $wand_wood = $_POST['wand-wood'];
    $wand_core = $_POST['wand-core'];
    $wand_length = $_POST['wand-length'];
    $success = true;

    if ($role != "Student" && $role != "Teacher"){
      $success = false;
      $_SESSION['flash_error'] = "Role hanya boleh 'Teacher' atau 'Stundent'!";
    }

    if ($wand_length < 4){
      $success = false;
      $_SESSION['flash_error'] = "Wand length minimal 4 ke atas!";
    }

    if ($school <= 0 || $school > 4){
      $success = false;
      $_SESSION['flash_error'] = "Silahkan pilih school terlebih dahulu!";
    }

    // Insert new character and wand into the database if validation passes.
    if ($success){
      try{
        $stmt = $conn->prepare("INSERT INTO characters (name, house_id, role) VALUES(:name, :house_id, :role)");
        $stmt -> bindParam(':name', $nama);
        $stmt -> bindParam(':house_id', $school, PDO::PARAM_INT);
        $stmt -> bindParam(':role', $role);

        if ($stmt -> execute()){
          // alert("Sukses measukan ke database (tabel: characters)");
        }

        $char_id = $conn->lastInsertId();
        $stmt2 = $conn->prepare("INSERT INTO wands (character_id, wood, core, length) VALUES(:cid, :wood, :core, :length)");
        $stmt2->bindParam(':cid', $char_id);
        $stmt2->bindParam(':wood', $wand_wood);
        $stmt2->bindParam(':core', $wand_core);
        $stmt2->bindParam(':length', $wand_length);

        if ($stmt2 -> execute()){
          // alert("Sukses memasukan ke database (tabel: wands)");
        }
      }catch(PDOException $e){
        var_dump($e->getMessage());
      }
    }
  }

  // function isset() digunakan untuk mengecek
  // apakah suatu variabel atau elemen form sudah ada dan tidak null, misalnya isset($_POST['btn-add']) untuk
  // memastikan tombol submit telah dikirim.
  if (isset($_POST['btn-view'])){
    header("location: statistic.php");
    exit();
  }

  
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' ){
  if (isset($_GET['id'])){
    $id = $_GET['id'];
    // Delete the dependent wand before deleting its character.
    try{
      $stmt4 = $conn->prepare("DELETE FROM wands WHERE character_id = :cid");
      $stmt4->bindParam(':cid', $id, PDO::PARAM_INT); // PDO::PARAM_INT memastikan $id di bind sebagai integer
      $stmt4->execute();

      $stmt5 = $conn->prepare("DELETE FROM characters WHERE id = :cid");
      $stmt5->bindParam(':cid', $id, PDO::PARAM_INT);
      if ($stmt5->execute()){
        $_SESSION['flash_error'] = "Sukses menghapus data!";
        header("location: index.php");
        exit();
      }
    }catch(PDOException $e){
      var_dump($e->getMessage());
    }
  }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Harry Potter Characters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #f8f9fa;
      }
      h1 {
        background: linear-gradient(to right, orange, red, purple);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
      }
      hr {
        border: none;
        border-top: 3px solid #ff6699;
        width: 90%;
        margin: 10px auto;
      }
      .card {
        max-width: 900px;
        margin: auto;
        margin-top: 20px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
      }
      .btn-add {
        background-color: #0d6efd;
        color: white;
      }
      .btn-add:hover {
        background-color: #0b5ed7;
      }
      .btn-stats {
        background-color: #28a745;
        color: white;
      }
      .btn-stats:hover {
        background-color: #218838;
      }
    </style>
  </head>
  <body>

    <div class="container">
      <h1>Harry Potter Characters</h1>
      <hr>

      <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-success" role="alert">
          <?= $_SESSION['flash_error'] ?>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
      <?php endif; ?>

      <div class="card">
        <h4 class="mb-3">Add New Character</h4>
        <form method="POST">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="nama" placeholder="Enter name" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">House</label>
              <select class="form-select" name="school" required>
                <option value="0">Select House</option>
                <option value="1">Gryffindor</option>
                <option value="2">Slytherin</option>
                <option value="3">Hufflepuff</option>
                <option value="4">Ravenclaw</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Role</label>
              <input type="text" class="form-control" name="role" placeholder="e.g. Teacher, Student" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Wand Wood</label>
              <input type="text" class="form-control" name="wand-wood" placeholder="e.g. Yggdrasil" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Wand Core</label>
              <input type="text" class="form-control" name="wand-core" placeholder="e.g. Phoenix Feather" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Wand Length</label>
              <input type="number" class="form-control" name="wand-length" placeholder="e.g. 12" required>
            </div>
          </div>

          <div class="mt-4">
              <button type="submit" class="btn btn-add" name="btn-add">Add Character</button>
          </div>
        </form>
      </div>

      <div class="text-center mt-4">
        <form method="POST">
          <button class="btn btn-stats" name="btn-view">View Statistics & Search</button>
        </form>
      </div>
      
      <!-- tabel char list -->
      <hr class="mt-5">
      <h3 class="text-center mb-3">Characters List</h3>

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>NAME</th>
              <th>HOUSE</th>
              <th>ROLE</th>
              <th>WAND</th>
              <th>ACTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $stmt3 = $conn->prepare("SELECT c.id, c.name, c.role, h.name AS house, w.wood, w.core, w.length 
                                      FROM characters c 
                                      JOIN houses h ON c.house_id = h.id 
                                      JOIN wands w ON c.id = w.character_id 
                                      ORDER BY c.name");
              $stmt3->execute();
              $rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);

              foreach ($rows as $row): 
                // Choose a badge color based on the wand core.
                $core = strtolower($row['core']);
                $coreColor = '#6c757d'; // default gray
                if ($core === 'phoenix feather') {
                  $coreColor = '#ff6b00'; // orange
                } elseif ($core === 'unicorn horn') {
                  $coreColor = '#9400ff'; // purple
                } elseif ($core === 'dragon heartstring') {
                  $coreColor = '#ff0000'; // red
                } elseif ($core === 'unknown') {
                  $coreColor = '#4b00ff'; // blue
                }
            ?>
              <tr>
                <td><strong><?= htmlspecialchars($row['name']) ?></strong></td>
                <td>
                  <span class="badge text-dark" 
                        style="background-color:
                        <?php 
                          switch($row['house']) {
                            case 'Gryffindor': echo '#ffcccc'; break;
                            case 'Slytherin': echo '#ccffcc'; break;
                            case 'Hufflepuff': echo '#fff5cc'; break;
                            case 'Ravenclaw': echo '#cce5ff'; break;
                            default: echo '#e2e3e5';
                          }
                        ?>">
                        <?= htmlspecialchars($row['house']) ?>
                  </span>
                </td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td>
                  <div><strong><?= htmlspecialchars($row['wood']) ?></strong></div>
                  <div>
                  <span class="badge text-light" style="background-color: <?= $coreColor ?>;">
                    <?= htmlspecialchars($row['core']) ?>
                  </span>
                    <?= htmlspecialchars($row['length']) ?>°
                  </div>
                </td>
                <td>
                  <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                  <form method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this character?')">
                      Delete
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>












































https://www.instagram.com/reel/DbTdZ_kqeSd/?stkn=MW0xMXJ3M2pubnpyeg==