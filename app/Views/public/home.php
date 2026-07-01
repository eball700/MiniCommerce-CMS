<section>
    <h2>Welcome to <?= htmlspecialchars($siteName) ?></h2>
    <p>This is a custom-built PHP MiniCommerce CMS.</p>
</section>

<section>
    <h2>Featured Products</h2>

    <?php if (empty($featuredProducts)): ?>
        <p>No featured products available.</p>
    <?php else: ?>
        <div class="product-grid">
            <?php foreach ($featuredProducts as $product): ?>
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