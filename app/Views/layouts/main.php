<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($siteName ?? 'MiniCommerce CMS') ?></title>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($siteName ?? 'MiniCommerce CMS') ?></h1>

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
            <a href="/minicommerce-cms/public/cart">Cart</a>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>
</body>
</html>