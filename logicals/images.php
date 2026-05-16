<?php
if (isset($_POST['upload_image'])) {

    if (!isset($_SESSION['login'])) {
        header("Location: .");
        exit;
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxSize      = 2 * 1024 * 1024; // 2MB
    $uploadDir    = './images/gallery/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (!isset($_FILES['image_file']) || $_FILES['image_file']['error'] !== UPLOAD_ERR_OK) {
        $uploadError = 'No file uploaded or upload error occurred.';
    } else {
        $file     = $_FILES['image_file'];
        $fileType = mime_content_type($file['tmp_name']); // use mime from server, not browser
        $fileSize = $file['size'];
        $fileExt  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($fileType, $allowedTypes)) {
            $uploadError = 'Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.';
        } elseif ($fileSize > $maxSize) {
            $uploadError = 'File size exceeds the 2MB limit.';
        } else {
            $uniqueName = uniqid('img_', true) . '.' . $fileExt;
            $destination = $uploadDir . $uniqueName;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                try {
                    $dbh = getDB();
                    $sql = "INSERT INTO image_uploads (file_name, uploaded_by) VALUES (:file_name, :uploaded_by)";
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute([
                        ':file_name'   => $uniqueName,
                        ':uploaded_by' => $_SESSION['login']
                    ]);

                    if ($stmt->rowCount()) {
                        $uploadSuccess = true;
                    } else {
                        $uploadError = 'File uploaded but could not be saved to database.';
                    }
                } catch (PDOException $e) {
                    $uploadError = 'Database error: ' . $e->getMessage();
                }
            } else {
                $uploadError = 'Failed to move uploaded file. Check folder permissions.';
            }
        }
    }
}
?>