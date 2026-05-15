<?php
if (isset($_POST['send_contact'])) {
    $sender_name  = trim($_POST['sender_name']  ?? '');
    $sender_email = trim($_POST['sender_email'] ?? '');
    $subject      = trim($_POST['subject']      ?? '');
    $message_body = trim($_POST['message_body'] ?? '');

    $errors = [];

    if (strlen($sender_name) < 2) {
        $errors[] = 'Full name must be at least 2 characters.';
    }

    if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (strlen($subject) < 3) {
        $errors[] = 'Subject must be at least 3 characters.';
    }

    if (strlen($message_body) < 10) {
        $errors[] = 'Message must be at least 10 characters.';
    }

    if (!empty($errors)) {
        $contactError = implode(' ', $errors);
    } else {
        try {
            $dbh = getDB();

            $user_id = null;
            if (isset($_SESSION['login'])) {
                $sth = $dbh->prepare("SELECT id FROM users WHERE user_name = :username");
                $sth->execute([':username' => $_SESSION['login']]);
                $row = $sth->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $user_id = $row['id'];
                }
            }

            $sql = "INSERT INTO messages (sender_name, sender_email, subject, message_body, user_id)
                    VALUES (:sender_name, :sender_email, :subject, :message_body, :user_id)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ':sender_name'  => $sender_name,
                ':sender_email' => $sender_email,
                ':subject'      => $subject,
                ':message_body' => $message_body,
                ':user_id'      => $user_id
            ]);

            if ($stmt->rowCount()) {
                $contactSuccess = true;
                $_POST = [];
            } else {
                $contactError = 'Failed to send message. Please try again.';
            }

        } catch (PDOException $e) {
            $contactError = 'Database error: ' . $e->getMessage();
        }
    }
}
?>