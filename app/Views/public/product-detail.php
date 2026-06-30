<article>
    <h2><?= htmlspecialchars($product['name']) ?></h2>

    <p><?= htmlspecialchars($product['description']) ?></p>

    <p>
        Category:
        <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?>
    </p>

    <p>
        Price:
        €<?= number_format((float) $product['price'], 2) ?>
    </p>

    <form method="post" action="/minicommerce-cms/public/cart/add">
        <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">

        <label for="quantity">Quantity</label>
        <input
            type="number"
            id="quantity"
            name="quantity"
            value="1"
            min="1"
        >

        <button type="submit">Add to cart</button>
    </form>
</article>