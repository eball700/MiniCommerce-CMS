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
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>
</body>
</html>