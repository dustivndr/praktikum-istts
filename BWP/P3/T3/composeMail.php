<?php

require_once __DIR__ . '/connection.php';

if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
	exit;
}

$recipientsInput = '';
$subject = '';
$body = '';
$error = '';

if (isset($_POST['send'])) {
	$recipientsInput = trim($_POST['recipients']);
	$subject = trim($_POST['subject']);
	$body = trim($_POST['body']);
	$recipientEmails = explode(',', $recipientsInput);
	$recipientIds = [];

	foreach ($recipientEmails as $recipientEmail) {
		$recipientEmail = trim($recipientEmail);

		if ($recipientEmail === '') {
			continue;
		}

		$getRecipient = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
		$getRecipient->execute(['email' => strtolower($recipientEmail)]);
		$recipient = $getRecipient->fetch(PDO::FETCH_ASSOC);

		if (!$recipient) {
			$error = 'Email penerima tidak terdaftar: ' . $recipientEmail;
			break;
		}

		$recipientIds[] = $recipient['id'];
	}

	if (!$error && $recipientIds) {
		$pdo->beginTransaction();

		$createMail = $pdo->prepare(
			'INSERT INTO emails (sender_id, subject, body) VALUES (:sender_id, :subject, :body)'
		);
		$createMail->execute([
			'sender_id' => $_SESSION['user_id'],
			'subject' => $subject,
			'body' => $body,
		]);
		$mailId = $pdo->lastInsertId();

		$addRecipient = $pdo->prepare(
			'INSERT INTO email_recipients (email_id, recipient_id) VALUES (:email_id, :recipient_id)'
		);
		foreach ($recipientIds as $recipientId) {
			$addRecipient->execute([
				'email_id' => $mailId,
				'recipient_id' => $recipientId,
			]);
		}

		$pdo->commit();
		header('Location: home.php');
		exit;
	}
}

?><!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>JihMail - Compose</title>
	<link rel="stylesheet" href="style.css?v=5">
</head>
<body class="compose-page">
	<main class="compose-card">
		<div class="compose-heading">
			<h1>New Message</h1>
			<a href="home.php" aria-label="Close">&times;</a>
		</div>

		<?php if ($error): ?>
			<p class="compose-error"><?= htmlspecialchars($error) ?></p>
		<?php endif; ?>

		<form method="post" action="composeMail.php">
			<input type="text" name="recipients" value="<?= htmlspecialchars($recipientsInput) ?>" placeholder="To (pisahkan email dengan koma)" required>
			<input type="text" name="subject" value="<?= htmlspecialchars($subject) ?>" placeholder="Subject" required>
			<textarea name="body" placeholder="Tulis pesan..." required><?= htmlspecialchars($body) ?></textarea>

			<div class="compose-actions">
				<button type="submit" name="send">Send</button>
				<a href="home.php">Discard</a>
			</div>
		</form>
	</main>
</body>
</html>
