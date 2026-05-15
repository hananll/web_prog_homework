<section class="mb-5">
    <h2 class="mb-4"><i class="bi bi-envelope-fill me-2 text-danger"></i>Contact Us</h2>

    <?php if (isset($contactSuccess) && $contactSuccess): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            Your message has been sent successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($contactError) && $contactError): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?= htmlspecialchars($contactError) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-send-fill me-1"></i> Send a Message
                </div>
                <div class="card-body">
                    <form id="contactForm" action="contact" method="post" novalidate>

                        <div class="mb-3">
                            <label for="sender_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="sender_name" name="sender_name"
                                   placeholder="Your full name"
                                   value="<?= isset($_POST['sender_name']) ? htmlspecialchars($_POST['sender_name']) : '' ?>">
                            <div class="invalid-feedback" id="nameError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="sender_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="sender_email" name="sender_email"
                                   placeholder="your@email.com"
                                   value="<?= isset($_POST['sender_email']) ? htmlspecialchars($_POST['sender_email']) : '' ?>">
                            <div class="invalid-feedback" id="emailError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                   placeholder="Message subject"
                                   value="<?= isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '' ?>">
                            <div class="invalid-feedback" id="subjectError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="message_body" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message_body" name="message_body"
                                      rows="5" placeholder="Write your message here..."><?= isset($_POST['message_body']) ? htmlspecialchars($_POST['message_body']) : '' ?></textarea>
                            <div class="invalid-feedback" id="messageError"></div>
                        </div>

                        <button type="submit" name="send_contact" class="btn btn-danger">
                            <i class="bi bi-send me-1"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="bi bi-info-circle-fill me-1"></i> Contact Information
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class="bi bi-person-fill text-danger me-2"></i>
                            <strong>Manager:</strong> Traffic Portal Admin
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-envelope-fill text-danger me-2"></i>
                            <strong>Email:</strong> admin@trafficportal.hu
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-telephone-fill text-danger me-2"></i>
                            <strong>Phone:</strong> +36 1 234 5678
                        </li>
                        <li>
                            <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                            <strong>Address:</strong> Budapest, Hungary
                        </li>
                    </ul>
                </div>
            </div>

            <?php if (isset($_SESSION['login'])): ?>
                <div class="alert alert-info">
                    <i class="bi bi-person-check-fill me-1"></i>
                    Sending as: <strong><?= htmlspecialchars($_SESSION['fn'] . ' ' . $_SESSION['ln']) ?></strong>
                </div>
            <?php else: ?>
                <div class="alert alert-secondary">
                    <i class="bi bi-person-fill me-1"></i>
                    You are sending as a <strong>Guest</strong>.
                    <a href="login" class="alert-link">Login</a> to send with your name.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    let valid = true;

    function showError(fieldId, errorId, message) {
        document.getElementById(fieldId).classList.add('is-invalid');
        document.getElementById(errorId).textContent = message;
    }
    function clearError(fieldId) {
        document.getElementById(fieldId).classList.remove('is-invalid');
        document.getElementById(fieldId).classList.add('is-valid');
    }

    ['sender_name','sender_email','subject','message_body'].forEach(function(id) {
        document.getElementById(id).classList.remove('is-invalid','is-valid');
    });

    const name = document.getElementById('sender_name').value.trim();
    if (name.length < 2) {
        showError('sender_name', 'nameError', 'Full name must be at least 2 characters.');
        valid = false;
    } else {
        clearError('sender_name');
    }

    const email = document.getElementById('sender_email').value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showError('sender_email', 'emailError', 'Please enter a valid email address.');
        valid = false;
    } else {
        clearError('sender_email');
    }

    const subject = document.getElementById('subject').value.trim();
    if (subject.length < 3) {
        showError('subject', 'subjectError', 'Subject must be at least 3 characters.');
        valid = false;
    } else {
        clearError('subject');
    }

    const message = document.getElementById('message_body').value.trim();
    if (message.length < 10) {
        showError('message_body', 'messageError', 'Message must be at least 10 characters.');
        valid = false;
    } else {
        clearError('message_body');
    }

    if (!valid) {
        e.preventDefault();
    }
});
</script>