<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <img src="./istts-1.png" alt="logo e kampus tercinta" style="width:100px;height:auto;" class="mt-5 mx-auto d-block">
    <!-- ga nemu logo e sing putih -->

    <br />

    <div class="container defcon p-5 m-4 mx-auto" style="max-width: 30%;">


        <p class="yel" style="text-align: center;">PORTAL AKADEMIK</p>
        <h3 style="text-align: center;">LOGIN</h3>

        <?php if (isset($_COOKIE['ban_message'])): ?>

            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_COOKIE['ban_message']) ?>
            </div>

            <?php setcookie("ban_message", "", time() - 3600, "/"); ?>

        <?php endif; ?>

        <form method="POST" action="loginProcess.php">
            <div class="mb-3">
                <label class="form-label ">Email</label>
                <input type="email" class="form-control" name="emailLogin" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="passwordLogin" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-gold">Login</button>
            </div>
        </form>

        <?php if (isset($_COOKIE['error_message'])): ?>

            <br />
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_COOKIE['error_message']) ?>
            </div>

            <?php setcookie("error_message", "", time() - 3600, "/"); ?>

        <?php endif; ?>

        <br>

        <p style="text-align: right;"><b><a href="./register.php" class="yel">Register as a student</a></b></p>

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>

</body>

</html>