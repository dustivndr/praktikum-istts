<?php

require_once __DIR__ . '/connection.php';

if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
	exit;
}

$getSentMail = $pdo->prepare(
	' SELECT e.id, e.subject, e.body, e.created_at,
	         GROUP_CONCAT(recipient.name ORDER BY recipient.name SEPARATOR ", ") AS recipient_names
	  FROM emails AS e
	  INNER JOIN email_recipients AS mail_recipient ON mail_recipient.email_id = e.id
	  INNER JOIN users AS recipient ON recipient.id = mail_recipient.recipient_id
	  WHERE e.sender_id = :sender_id
	    AND e.is_deleted = 0
	    AND mail_recipient.is_deleted = 0
	  GROUP BY e.id, e.subject, e.body, e.created_at
	  ORDER BY e.created_at DESC'
);
$getSentMail->execute(['sender_id' => $_SESSION['user_id']]);
$sentMail = $getSentMail->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>JihMail - Sent Mail</title>
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
		<nav class="mail-nav" aria-label="Mail navigation">
			<a class="compose-button" href="composeMail.php">&#9998; Compose</a>
			<a href="home.php">Inbox</a>
			<a class="active-nav" href="sentMailPage.php">Sent Mail</a>
			<a href="trashPage.php">Trash &#128465;</a>
		</nav>

		<section class="inbox-list" aria-label="Sent Mail">
			<?php if (!$sentMail): ?>
				<p class="empty-inbox">Belum ada email terkirim.</p>
			<?php else: ?>
				<?php foreach ($sentMail as $mail): ?>
					<article class="mail-row">
						<strong class="sender-name">To: <?= htmlspecialchars($mail['recipient_names']) ?></strong>
						<div class="mail-summary">
							<strong><?= htmlspecialchars($mail['subject']) ?></strong>
							<span> - <?= htmlspecialchars(strlen($mail['body']) > 80 ? substr($mail['body'], 0, 80) . '...' : $mail['body']) ?></span>
						</div>
						<time datetime="<?= htmlspecialchars($mail['created_at']) ?>"><?= date('M d', strtotime($mail['created_at'])) ?></time>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</section>
	</main>
</body>
</html>
