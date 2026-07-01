<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAdminLoggedIn = isset($_SESSION['admin_user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - MiniCommerce CMS</title>
    <link rel="stylesheet" href="/minicommerce-cms/public/assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="site-brand">
        <span class="site-logo">MC</span>
        <div>
            <h1>MiniCommerce CMS Admin</h1>
            <p>Protected management area</p>
        </div>
    </div>

    <div class="site-nav-row">
        <nav>
            <?php if ($isAdminLoggedIn): ?>
                <a href="/minicommerce-cms/public/admin/dashboard">Dashboard</a>
                <a href="/minicommerce-cms/public/admin/logout">Logout</a>
            <?php endif; ?>

            <a href="/minicommerce-cms/public">View Site</a>
        </nav>
    </div>
</header>

    <main>
        <?= $content ?>
    </main>
    <footer class="site-footer">
    <p>
        &copy; <?= date('Y') ?> | MiniCommerce CMS
Built with PHP 8.2 • MySQL • MVC Architecture
    </p>
</footer>
    <script src="/minicommerce-cms/public/assets/js/admin.js"></script>
</body>
</html>