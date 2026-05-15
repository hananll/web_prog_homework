<?php
if (!isset($_SESSION['login'])) {
    header("Location: .");
    exit;
}

try {
    $dbh = getDB();
    $sql = "SELECT m.*, u.first_name, u.last_name
            FROM messages m
            LEFT JOIN users u ON m.user_id = u.id
            ORDER BY m.created_at DESC";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $messages = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $messages = [];
    $dbError = $e->getMessage();
}
?>

<section class="mb-5">
    <h2 class="mb-4"><i class="bi bi-inbox-fill me-2 text-danger"></i>Messages</h2>

    <?php if (isset($dbError)): ?>
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Database error: <?= htmlspecialchars($dbError) ?>
        </div>
    <?php elseif (empty($messages)): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle-fill me-2"></i>
            No messages yet.
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-table me-1"></i> All Messages</span>
                <span class="badge bg-danger"><?= count($messages) ?> message<?= count($messages) !== 1 ? 's' : '' ?></span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="bi bi-person-fill me-1"></i>Sender</th>
                                <th><i class="bi bi-envelope-fill me-1"></i>Email</th>
                                <th><i class="bi bi-chat-left-text-fill me-1"></i>Subject</th>
                                <th><i class="bi bi-text-left me-1"></i>Message</th>
                                <th><i class="bi bi-clock-fill me-1"></i>Sent At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $i => $msg): ?>
                                <?php
                                if ($msg['user_id'] === null) {
                                    $senderDisplay = 'Guest';
                                } else {
                                    $senderDisplay = htmlspecialchars($msg['first_name'] . ' ' . $msg['last_name']);
                                }
                                ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <?php if ($msg['user_id'] === null): ?>
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-person me-1"></i>Guest
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-success">
                                                <i class="bi bi-person-check me-1"></i><?= $senderDisplay ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($msg['sender_email']) ?></td>
                                    <td><?= htmlspecialchars($msg['subject']) ?></td>
                                    <td>
                                        <span data-bs-toggle="tooltip" title="<?= htmlspecialchars($msg['message_body']) ?>">
                                            <?= htmlspecialchars(mb_substr($msg['message_body'], 0, 60)) ?>
                                            <?= mb_strlen($msg['message_body']) > 60 ? '...' : '' ?>
                                        </span>
                                    </td>
                                    <td class="text-nowrap">
                                        <small><?= htmlspecialchars($msg['created_at']) ?></small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<script>
const tooltipEls = document.querySelectorAll('[data-bs-toggle="tooltip"]');
tooltipEls.forEach(el => new bootstrap.Tooltip(el));
</script>