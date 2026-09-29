<?php require_once('conn.php'); ?>
<?php 
// cek apakah id ada atau tidak
if (!isset($_GET['id'])) {
  header('Location: index.php');
  exit();
}

$id = $_GET['id']; // Fetch data

$stmt = $conn->prepare("
  SELECT c.id, c.name, c.role, c.house_id, w.wood, w.core, w.length 
  FROM characters c
  JOIN wands w ON c.id = w.character_id
  WHERE c.id = :id
");
$stmt->bindParam(':id', $id);
$stmt->execute();
$character = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$character) {
  $_SESSION['flash_error'] = 'ERROR: Character not found.';  
  header('Location: index.php');
  exit();
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // maskan data ke variabel
  $name = $_POST['name'];
  $house_id = $_POST['house_id'];
  $role = $_POST['role'];
  $wood = $_POST['wood'];
  $core = $_POST['core'];
  $length = $_POST['length'];
  $success = true;

  if ($role != "Student" && $role != "Teacher"){
      $success = false;
      $_SESSION['flash_error'] = "Role hanya boleh 'Teacher' atau 'Stundent'!";
  }

  if ($length < 4){
      $success = false;
      $_SESSION['flash_error'] = "Wand length minimal 4 ke atas!";
  }

  if ($success){
    // query update
    $stmt = $conn->prepare("UPDATE characters SET name = :name, house_id = :house_id, role = :role WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':house_id', $house_id);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE wands SET wood = :wood, core = :core, length = :length WHERE character_id = :id");
    $stmt->bindParam(':wood', $wood);
    $stmt->bindParam(':core', $core);
    $stmt->bindParam(':length', $length);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $_SESSION['flash_success'] = 'Character updated successfully.';
    header('Location: index.php');
    exit();
  }
  
  header("location: edit.php?id=$id");
  exit();
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Character</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f3f4f6;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 10px;
      max-width: 600px;
      margin: auto;
    }
    .btn-back {
      background-color: #6366f1;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      padding: 6px 12px;
      font-weight: 500;
      display: inline-block;
      margin-bottom: 20px;
    }
    .btn-back:hover {
      background-color: #4f46e5;
      color: white;
    }
    h3 {
      font-weight: 600;
      margin-bottom: 20px;
    }
    .section-title {
      font-weight: 600;
      margin-top: 25px;
      margin-bottom: 8px;
    }
    .btn-primary {
      background-color: #2563eb;
      border: none;
    }
    .btn-primary:hover {
      background-color: #1d4ed8;
    }
    .btn-secondary {
      background-color: #6b7280;
      border: none;
    }
    .btn-secondary:hover {
      background-color: #4b5563;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-success" role="alert">
          <?= $_SESSION['flash_error'] ?>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
  <?php endif; ?>

  <a href="index.php" class="btn-back">← Back to Characters</a>

  <div class="card p-4 shadow-sm bg-white">
    <h3>Edit Character</h3>
    <form method="POST">
      <input type="hidden" name="id" value="<?= $character['id'] ?>">

      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($character['name']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">House</label>
        <select class="form-select" name="house_id" required>
          <option value="1" <?= $character['house_id']==1 ? 'selected' : '' ?>>Gryffindor</option>
          <option value="2" <?= $character['house_id']==2 ? 'selected' : '' ?>>Slytherin</option>
          <option value="3" <?= $character['house_id']==3 ? 'selected' : '' ?>>Hufflepuff</option>
          <option value="4" <?= $character['house_id']==4 ? 'selected' : '' ?>>Ravenclaw</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Role</label>
        <input type="text" class="form-control" name="role" value="<?= htmlspecialchars($character['role']) ?>" required>
      </div>

      <div class="section-title">Wand Information</div>

      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Wood</label>
          <input type="text" class="form-control" name="wood" value="<?= htmlspecialchars($character['wood']) ?>" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Core</label>
          <input type="text" class="form-control" name="core" value="<?= htmlspecialchars($character['core']) ?>" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Length (inches)</label>
          <input type="text" class="form-control" name="length" value="<?= htmlspecialchars($character['length']) ?>" required>
        </div>
      </div>

      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Update Character</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
