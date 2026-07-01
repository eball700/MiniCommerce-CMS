<section>
    <h2>Website Settings</h2>

    <form method="post" action="/minicommerce-cms/public/admin/settings/update">
        <div>
            <label for="site_name">Website name</label>
            <input
                type="text"
                id="site_name"
                name="site_name"
                value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>"
                required
            >
        </div>

        <div>
            <label for="contact_email">Contact email</label>
            <input
                type="email"
                id="contact_email"
                name="contact_email"
                value="<?= htmlspecialchars($settings['contact_email'] ?? '') ?>"
                required
            >
        </div>

        <button type="submit">Save settings</button>
    </form>
</section>