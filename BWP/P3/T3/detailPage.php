<?php

require_once __DIR__ . '/connection.php';

if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
	exit;
}

$mailId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$getMail = $pdo->prepare(
	' SELECT e.subject, e.body, e.created_at, sender.name AS sender_name, sender.email AS sender_email
	  FROM email_recipients AS recipient
	  INNER JOIN emails AS e ON e.id = recipient.email_id
	  INNER JOIN users AS sender ON sender.id = e.sender_id
	  WHERE e.id = :email_id
	    AND recipient.recipient_id = :recipient_id
	    AND recipient.is_deleted = 0
	    AND e.is_deleted = 0
	  LIMIT 1'
);
$getMail->execute([
	'email_id' => $mailId,
	'recipient_id' => $_SESSION['user_id'],
]);
$mail = $getMail->fetch(PDO::FETCH_ASSOC);

if (!$mail) {
	header('Location: home.php');
	exit;
}

?><!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= htmlspecialchars($mail['subject']) ?> - JihMail</title>
	<link rel="stylesheet" href="style.css?v=3">
</head>
<body class="home-page">
	<header class="navbar">
		<a class="brand" href="home.php">JihMail</a>
		<div class="account-area">
			<span><?= htmlspecialchars($_SESSION['user_name']) ?></span>
			<a class="logout-button" href="home.php?logout=1">Logout</a>
		</div>
	</header>

	<main class="mailbox">
		<section class="mail-detail">
			<a class="back-link" href="home.php">&larr; Back to Inbox</a>
			<div class="detail-heading">
				<h1><?= htmlspecialchars($mail['subject']) ?></h1>
				<span class="inbox-label">Inbox</span>
			</div>

			<div class="sender-detail">
				<div class="sender-avatar"><?= htmlspecialchars(strtoupper(substr($mail['sender_name'], 0, 1))) ?></div>
				<div>
					<strong><?= htmlspecialchars($mail['sender_name']) ?></strong>
					<span>&lt;<?= htmlspecialchars($mail['sender_email']) ?>&gt;</span>
					<small>to me</small>
				</div>
				<time datetime="<?= htmlspecialchars($mail['created_at']) ?>"><?= date('H:i A (d M Y)', strtotime($mail['created_at'])) ?></time>
			</div>

			<div class="mail-body">
				<?= htmlspecialchars($mail['body']) ?>
			</div>
		</section>
	</main>
</body>
</html>
