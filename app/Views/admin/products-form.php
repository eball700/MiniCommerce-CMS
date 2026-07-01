<section>
    <h2><?= htmlspecialchars($title) ?></h2>

    <form method="post" action="<?= htmlspecialchars($action) ?>">
        <div>
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id">
                <option value="">Uncategorized</option>

                <?php foreach ($categories as $category): ?>
                    <option
                        value="<?= (int) $category['id'] ?>"
                        <?= (int) ($product['category_id'] ?? 0) === (int) $category['id'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="name">Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="<?= htmlspecialchars($product['name'] ?? '') ?>"
                required
            >
        </div>

        <div>
            <label for="slug">Slug</label>
            <input
                type="text"
                id="slug"
                name="slug"
                value="<?= htmlspecialchars($product['slug'] ?? '') ?>"
                required
            >
        </div>

        <div>
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                rows="6"
                required
            ><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
        </div>

        <div>
            <label for="price">Price</label>
            <input
                type="number"
                id="price"
                name="price"
                step="0.01"
                min="0"
                value="<?= htmlspecialchars((string) ($product['price'] ?? '')) ?>"
                required
            >
        </div>

        <div>
            <label for="image">Image path</label>
            <input
                type="text"
                id="image"
                name="image"
                value="<?= htmlspecialchars($product['image'] ?? '') ?>"
                placeholder="Optional image path"
            >
        </div>

        <div>
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="draft" <?= ($product['status'] ?? '') === 'draft' ? 'selected' : '' ?>>
                    Draft
                </option>
                <option value="published" <?= ($product['status'] ?? '') === 'published' ? 'selected' : '' ?>>
                    Published
                </option>
            </select>
        </div>

        <div>
            <label>
                <input
                    type="checkbox"
                    name="is_featured"
                    value="1"
                    <?= (int) ($product['is_featured'] ?? 0) === 1 ? 'checked' : '' ?>
                >
                Featured product
            </label>
        </div>

        <button type="submit">Save</button>
        <a href="/minicommerce-cms/public/admin/products">Cancel</a>
    </form>
</section>