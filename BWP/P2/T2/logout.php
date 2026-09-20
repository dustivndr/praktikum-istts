<?php
setcookie('auth_user', '', time() - 3600, '/');

header('Location: login.php');
exit;