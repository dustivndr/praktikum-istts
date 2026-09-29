<?php

require_once __DIR__ . '/connection.php';

if (isset($_GET['logout'])) {
	session_unset();
	session_destroy();
	header('Location: login.php');
	exit;
}

if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
	exit;
}

$getInbox = $pdo->prepare(
	' SELECT e.id, sender.name AS sender_name, e.subject, e.body, e.created_at
	  FROM email_recipients AS recipient
	  INNER JOIN emails AS e ON e.id = recipient.email_id
	  INNER JOIN users AS sender ON sender.id = e.sender_id
	  WHERE recipient.recipient_id = :recipient_id
	    AND recipient.is_deleted = 0
	    AND e.is_deleted = 0
	  ORDER BY e.created_at DESC'
);
$getInbox->execute(['recipient_id' => $_SESSION['user_id']]);
$inbox = $getInbox->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>JihMail - Inbox</title>
	<link rel="stylesheet" href="style.css?v=2">
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
		<nav class="mail-nav" aria-label="Mail navigation">
			<a class="compose-button" href="composeMail.php">&#9998; Compose</a>
			<a class="active-nav" href="home.php">Inbox</a>
			<a href="sentMailPage.php">Sent Mail</a>
			<a href="trashPage.php">Trash &#128465;</a>
		</nav>

		<section class="inbox-list" aria-label="Inbox">
			<?php if (!$inbox): ?>
				<p class="empty-inbox">Belum ada email masuk.</p>
			<?php else: ?>
				<?php foreach ($inbox as $mail): ?>
					<a class="mail-row" href="detailPage.php?id=<?= (int) $mail['id'] ?>">
						<strong class="sender-name"><?= htmlspecialchars($mail['sender_name']) ?></strong>
						<div class="mail-summary">
							<strong><?= htmlspecialchars($mail['subject']) ?></strong>
							<span> - <?= htmlspecialchars(strlen($mail['body']) > 80 ? substr($mail['body'], 0, 80) . '...' : $mail['body']) ?></span>
						</div>
						<time datetime="<?= htmlspecialchars($mail['created_at']) ?>"><?= date('M d', strtotime($mail['created_at'])) ?></time>
					</a>
				<?php endforeach; ?>
			<?php endif; ?>
		</section>
	</main>
</body>
</html>
