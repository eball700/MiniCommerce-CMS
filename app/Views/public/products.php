<section class="page-shell">
    <h2>Products</h2>

<form method="get" action="/minicommerce-cms/public/products">
    <label for="category">Category</label>
    <select name="category" id="category">
        <option value="">All categories</option>

        <?php foreach ($categories as $category): ?>
            <option
                value="<?= (int) $category['id'] ?>"
                <?= (int) ($selectedCategory ?? 0) === (int) $category['id'] ? 'selected' : '' ?>
            >
                <?= htmlspecialchars($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="sort">Sort by price</label>
    <select name="sort" id="sort">
        <option value="asc" <?= ($selectedSort ?? 'asc') === 'asc' ? 'selected' : '' ?>>
            Price ascending
        </option>
        <option value="desc" <?= ($selectedSort ?? 'asc') === 'desc' ? 'selected' : '' ?>>
            Price descending
        </option>
    </select>

    <button type="submit">Apply</button>
</form>

        <button type="submit">Apply</button>
    </form>

    <?php if (empty($products)): ?>
        <p>No products available.</p>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <article>
                    <?php if (!empty($product['image'])): ?>
                        <img
                            src="/minicommerce-cms/public/<?= htmlspecialchars($product['image']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>"
                            style="max-width: 100%; height: auto;"
                        >
                    <?php endif; ?>

                    <h3><?= htmlspecialchars($product['name']) ?></h3>

                    <p><?= htmlspecialchars($product['description']) ?></p>

                    <p>
                        Category:
                        <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?>
                    </p>

                    <p>
                        Price:
                        €<?= number_format((float) $product['price'], 2) ?>
                    </p>

                    <a href="/minicommerce-cms/public/product/<?= htmlspecialchars($product['slug']) ?>">
                        View product
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>