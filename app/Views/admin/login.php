<section class="login-card">
    <span class="hero-badge">Admin Area</span>

    <h2>Admin Login</h2>
    <p class="login-subtitle">Sign in to manage pages, products and website settings.</p>

    <?php if (!empty($error)): ?>
        <div class="error-box">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="/minicommerce-cms/public/admin/login">
        <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Login</button>
    </form>
</section>