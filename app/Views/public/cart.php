<section>
    <h2>Your Cart</h2>

    <?php if (empty($cartItems)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <?php foreach ($cartItems as $item): ?>
            <article>
                <h3><?= htmlspecialchars($item['product']['name']) ?></h3>

                <p>
                    Unit price:
                    €<?= number_format((float) $item['product']['price'], 2) ?>
                </p>

                <form method="post" action="/minicommerce-cms/public/cart/update">
                    <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                    <input
                        type="hidden"
                        name="product_id"
                        value="<?= (int) $item['product']['id'] ?>"
                    >

                    <label>
                        Quantity
<input
    class="cart-quantity"
    type="number"
    name="quantity"
    value="<?= (int) $item['quantity'] ?>"
    min="0"
>
                    </label>

                    <button type="submit">Update</button>
                </form>

                <form method="post" action="/minicommerce-cms/public/cart/remove">
                    <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                    <input
                        type="hidden"
                        name="product_id"
                        value="<?= (int) $item['product']['id'] ?>"
                    >

                    <button type="submit">Remove</button>
                </form>

                <p>
                    Line total:
                    €<?= number_format((float) $item['lineTotal'], 2) ?>
                </p>
            </article>
        <?php endforeach; ?>

        <h3>
            Total:
            €<?= number_format((float) $total, 2) ?>
        </h3>
    <?php endif; ?>
</section>