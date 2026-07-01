<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($siteName ?? 'MiniCommerce CMS') ?></title>
    <link rel="stylesheet" href="/minicommerce-cms/public/assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="site-brand">
        <span class="site-logo">MC</span>
        <div>
            <h1><?= htmlspecialchars($siteName ?? 'MiniCommerce CMS') ?></h1>
            <p>Simple custom CMS & commerce platform</p>
        </div>
    </div>

    <div class="site-nav-row">
        <nav>
            <a href="/minicommerce-cms/public">Home</a>

            <?php if (!empty($pages)): ?>
                <?php foreach ($pages as $page): ?>
                    <a href="/minicommerce-cms/public/page/<?= htmlspecialchars($page['slug']) ?>">
                        <?= htmlspecialchars($page['title']) ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

            <a href="/minicommerce-cms/public/products">Products</a>
        </nav>

        <a
            class="cart-icon-link"
            href="/minicommerce-cms/public/cart"
            aria-label="View cart"
            title="View cart"
        >
            🛒
        </a>
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
    <script src="/minicommerce-cms/public/assets/js/cart.js"></script>
</body>
</html>