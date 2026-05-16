<section class="mb-5">
    <h2 class="mb-4"><i class="bi bi-images me-2 text-danger"></i>Image Gallery</h2>

    <?php if (isset($uploadSuccess) && $uploadSuccess): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>
            Image uploaded successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($uploadError) && $uploadError): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?= htmlspecialchars($uploadError) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['login'])): ?>
        <div class="card mb-4">
            <div class="card-header">
                <i class="bi bi-cloud-upload-fill me-1"></i> Upload New Image
            </div>
            <div class="card-body">
                <form action="images" method="post" enctype="multipart/form-data" id="uploadForm">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-8">
                            <label for="image_file" class="form-label">Select Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="image_file" name="image_file"
                                   accept="image/jpeg,image/png,image/gif,image/webp">
                            <div class="form-text">Allowed formats: JPG, PNG, GIF, WEBP. Max size: 2MB.</div>
                            <div class="invalid-feedback" id="fileError"></div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" name="upload_image" class="btn btn-danger w-100">
                                <i class="bi bi-upload me-1"></i> Upload
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-secondary mb-4">
            <i class="bi bi-lock-fill me-2"></i>
            <a href="login" class="alert-link">Login</a> to upload images.
        </div>
    <?php endif; ?>

    <!-- GALLERY GRID -->
    <?php
    try {
        $dbh = getDB();
        $sth = $dbh->query("SELECT * FROM image_uploads ORDER BY uploaded_at DESC");
        $galleryImages = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $galleryImages = [];
    }
    ?>

    <?php if (empty($galleryImages)): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle-fill me-2"></i>
            No images uploaded yet. Be the first to upload!
        </div>
    <?php else: ?>
        <div class="row g-3">
            <?php foreach ($galleryImages as $img): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100">
                        <a href="./images/gallery/<?= htmlspecialchars($img['file_name']) ?>"
                           target="_blank">
                            <img src="./images/gallery/<?= htmlspecialchars($img['file_name']) ?>"
                                 class="gallery-img card-img-top"
                                 alt="<?= htmlspecialchars($img['file_name']) ?>">
                        </a>
                        <div class="card-body p-2">
                            <small class="text-muted d-block">
                                <i class="bi bi-person-fill me-1"></i><?= htmlspecialchars($img['uploaded_by']) ?>
                            </small>
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i><?= htmlspecialchars(date('Y-m-d', strtotime($img['uploaded_at']))) ?>
                            </small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<script>
document.getElementById('uploadForm')?.addEventListener('submit', function(e) {
    const fileInput = document.getElementById('image_file');
    const fileError = document.getElementById('fileError');
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    const maxSize = 2 * 1024 * 1024; // 2MB

    fileInput.classList.remove('is-invalid', 'is-valid');

    if (!fileInput.files || fileInput.files.length === 0) {
        fileInput.classList.add('is-invalid');
        fileError.textContent = 'Please select a file to upload.';
        e.preventDefault();
        return;
    }

    const file = fileInput.files[0];

    if (!allowedTypes.includes(file.type)) {
        fileInput.classList.add('is-invalid');
        fileError.textContent = 'Only JPG, PNG, GIF, and WEBP files are allowed.';
        e.preventDefault();
        return;
    }

    if (file.size > maxSize) {
        fileInput.classList.add('is-invalid');
        fileError.textContent = 'File size must not exceed 2MB.';
        e.preventDefault();
        return;
    }

    fileInput.classList.add('is-valid');
});
</script>