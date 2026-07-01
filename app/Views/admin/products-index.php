<section>
    <h2>Manage Products</h2>

    <p>
        <a href="/minicommerce-cms/public/admin/products/create">Create new product</a>
    </p>

    <?php if (empty($products)): ?>
        <p>No products available.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['slug']) ?></td>
                        <td><?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?></td>
                        <td>€<?= number_format((float) $product['price'], 2) ?></td>
                        <td><?= htmlspecialchars($product['status']) ?></td>
                        <td><?= (int) $product['is_featured'] === 1 ? 'Yes' : 'No' ?></td>
                        <td>
                            <a href="/minicommerce-cms/public/admin/products/edit/<?= (int) $product['id'] ?>">
                                Edit
                            </a>

                            <form
                                method="post"
                                action="/minicommerce-cms/public/admin/products/delete/<?= (int) $product['id'] ?>"
                                style="display:inline"
                                onsubmit="return confirm('Are you sure you want to delete this product?');"
                            >
                            <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>