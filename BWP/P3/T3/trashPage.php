<?php

require_once __DIR__ . '/connection.php';

if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
	exit;
}

$userId = $_SESSION['user_id'];

if (isset($_GET['delete'])) {
	$mailId = (int) $_GET['delete'];
	$findMail = $pdo->prepare(
		' SELECT e.id
		  FROM emails AS e
		  LEFT JOIN email_recipients AS recipient
		    ON recipient.email_id = e.id AND recipient.recipient_id = :recipient_id
		  WHERE e.id = :email_id
		    AND ((e.sender_id = :sender_id AND e.is_deleted = 1)
		      OR (recipient.recipient_id IS NOT NULL AND recipient.is_deleted = 1))
		  LIMIT 1'
	);
	$findMail->execute([
		'recipient_id' => $userId,
		'email_id' => $mailId,
		'sender_id' => $userId,
	]);

	if ($findMail->fetch()) {
		$pdo->prepare('DELETE FROM email_recipients WHERE email_id = :email_id')
			->execute(['email_id' => $mailId]);
		$pdo->prepare('DELETE FROM emails WHERE id = :email_id')
			->execute(['email_id' => $mailId]);
	}

	header('Location: trashPage.php');
	exit;
}

if (isset($_GET['delete_all'])) {
	$findTrash = $pdo->prepare(
		' SELECT DISTINCT e.id
		  FROM emails AS e
		  LEFT JOIN email_recipients AS recipient
		    ON recipient.email_id = e.id AND recipient.recipient_id = :recipient_id
		  WHERE (e.sender_id = :sender_id AND e.is_deleted = 1)
		     OR (recipient.recipient_id IS NOT NULL AND recipient.is_deleted = 1)'
	);
	$findTrash->execute([
		'recipient_id' => $userId,
		'sender_id' => $userId,
	]);
	$trashIds = $findTrash->fetchAll(PDO::FETCH_COLUMN);

	foreach ($trashIds as $mailId) {
		$pdo->prepare('DELETE FROM email_recipients WHERE email_id = :email_id')
			->execute(['email_id' => $mailId]);
		$pdo->prepare('DELETE FROM emails WHERE id = :email_id')
			->execute(['email_id' => $mailId]);
	}

	header('Location: trashPage.php');
	exit;
}

$getTrash = $pdo->prepare(
	' SELECT DISTINCT e.id,
	         CASE WHEN e.sender_id = :sender_id THEN "Me" ELSE sender.name END AS sender_name,
	         e.subject, e.body, e.created_at
	  FROM emails AS e
	  INNER JOIN users AS sender ON sender.id = e.sender_id
	  LEFT JOIN email_recipients AS recipient
	    ON recipient.email_id = e.id AND recipient.recipient_id = :recipient_id
	  WHERE (e.sender_id = :owner_id AND e.is_deleted = 1)
	     OR (recipient.recipient_id IS NOT NULL AND recipient.is_deleted = 1)
	  ORDER BY e.created_at DESC'
);
$getTrash->execute([
	'sender_id' => $userId,
	'recipient_id' => $userId,
	'owner_id' => $userId,
]);
$trash = $getTrash->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>JihMail - Trash</title>
	<link rel="stylesheet" href="style.css?v=4">
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
			<a href="sentMailPage.php">Sent Mail</a>
			<a class="active-nav" href="trashPage.php">Trash &#128465;</a>
			<?php if ($trash): ?>
				<a class="delete-all-button" href="trashPage.php?delete_all=1" onclick="return confirm('Hapus semua email secara permanen?')">&#128465; Delete All Permanently</a>
			<?php endif; ?>
		</nav>

		<section class="inbox-list" aria-label="Trash">
			<?php if (!$trash): ?>
				<p class="empty-inbox">Trash kosong.</p>
			<?php else: ?>
				<?php foreach ($trash as $mail): ?>
					<article class="mail-row">
						<strong class="sender-name"><?= htmlspecialchars($mail['sender_name']) ?></strong>
						<div class="mail-summary">
							<strong><?= htmlspecialchars($mail['subject']) ?></strong>
							<span> - <?= htmlspecialchars(mb_strlen($mail['body']) > 80 ? mb_substr($mail['body'], 0, 80) . '...' : $mail['body']) ?></span>
						</div>
						<div class="trash-row-actions">
							<time datetime="<?= htmlspecialchars($mail['created_at']) ?>"><?= date('M d', strtotime($mail['created_at'])) ?></time>
							<a class="permanent-delete" href="trashPage.php?delete=<?= (int) $mail['id'] ?>" title="Delete permanently" onclick="return confirm('Hapus email ini secara permanen?')">&#128465;</a>
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</section>
	</main>
</body>
</html>
