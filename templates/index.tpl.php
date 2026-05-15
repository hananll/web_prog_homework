<?php session_start(); ?>
<?php if (file_exists('./logicals/' . $find['file'] . '.php')) {
    include("./logicals/{$find['file']}.php");
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pagetitle['title']) ?><?= isset($pagetitle['motto']) ? ' | ' . htmlspecialchars($pagetitle['motto']) : '' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css" type="text/css">
    <?php if (file_exists('./styles/' . $find['file'] . '.css')) { ?>
        <link rel="stylesheet" href="./styles/<?= $find['file'] ?>.css" type="text/css">
    <?php } ?>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center gap-2" href=".">
                <img src="./images/<?= htmlspecialchars($header['imagesource']) ?>"
                     alt="<?= htmlspecialchars($header['imagealt']) ?>"
                     height="32">
                <span><?= htmlspecialchars($header['title']) ?></span>
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($pages as $url => $page): ?>
                        <?php
                        $showGuest   = !isset($_SESSION['login']) && $page['menun'][0];
                        $showLogged  =  isset($_SESSION['login']) && $page['menun'][1];
                        if ($showGuest || $showLogged):
                        ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($page == $find) ? 'active' : '' ?>"
                                   href="<?= ($url == '/') ? '.' : $url ?>">
                                    <?= htmlspecialchars($page['text']) ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

                <!-- Logged-in user info -->
                <?php if (isset($_SESSION['login'])): ?>
                    <span class="navbar-text text-warning">
                        <i class="bi bi-person-fill"></i>
                        Logged in: <strong><?= htmlspecialchars($_SESSION['fn'] . ' ' . $_SESSION['ln'] . ' (' . $_SESSION['login'] . ')') ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <?php include("./templates/pages/{$find['file']}.tpl.php"); ?>
    </main>

    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container text-center">
            <?php if (isset($footer['copyright'])): ?>
                <span>&copy; <?= htmlspecialchars($footer['copyright']) ?></span>
            <?php endif; ?>
            <?php if (isset($footer['firm'])): ?>
                <span class="ms-2"><?= htmlspecialchars($footer['firm']) ?></span>
            <?php endif; ?>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>