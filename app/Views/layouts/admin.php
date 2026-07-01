<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - MiniCommerce CMS</title>
</head>
<body>
    <header>
        <h1>MiniCommerce CMS Admin</h1>

        <nav>
            <a href="/minicommerce-cms/public/admin/dashboard">Dashboard</a>
            <a href="/minicommerce-cms/public/admin/logout">Logout</a>
            <a href="/minicommerce-cms/public">View Site</a>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>
</body>
</html>