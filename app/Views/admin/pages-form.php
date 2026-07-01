<section>
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (!empty($errors)): ?>
    <div style="color: red; margin-bottom: 15px;">
        <strong>Please fix the following errors:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <form method="post" action="<?= htmlspecialchars($action) ?>">
        <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
        <div>
            <label for="title">Title</label>
            <input
                type="text"
                id="title"
                name="title"
                value="<?= htmlspecialchars($page['title'] ?? '') ?>"
                required
            >
        </div>

        <div>
            <label for="slug">Slug</label>
            <input
                type="text"
                id="slug"
                name="slug"
                value="<?= htmlspecialchars($page['slug'] ?? '') ?>"
                required
            >
        </div>

        <div>
            <label for="content">Content</label>
            <textarea
                id="content"
                name="content"
                rows="8"
                required
            ><?= htmlspecialchars($page['content'] ?? '') ?></textarea>
        </div>

        <div>
            <label for="meta_title">Meta title</label>
            <input
                type="text"
                id="meta_title"
                name="meta_title"
                value="<?= htmlspecialchars($page['meta_title'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="meta_description">Meta description</label>
            <textarea
                id="meta_description"
                name="meta_description"
                rows="3"
            ><?= htmlspecialchars($page['meta_description'] ?? '') ?></textarea>
        </div>

        <div>
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="draft" <?= ($page['status'] ?? '') === 'draft' ? 'selected' : '' ?>>
                    Draft
                </option>
                <option value="published" <?= ($page['status'] ?? '') === 'published' ? 'selected' : '' ?>>
                    Published
                </option>
            </select>
        </div>

<div class="form-actions">
    <button type="submit">Save</button>
    <a class="btn-secondary" href="/minicommerce-cms/public/admin/pages">Cancel</a>
</div>
    </form>
</section>