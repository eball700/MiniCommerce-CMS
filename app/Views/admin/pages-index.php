<section>
    <h2>Manage Pages</h2>

    <p>
        <a href="/minicommerce-cms/public/admin/pages/create">Create new page</a>
    </p>

    <?php if (empty($pages)): ?>
        <p>No pages available.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($pages as $page): ?>
                    <tr>
                        <td><?= htmlspecialchars($page['title']) ?></td>
                        <td><?= htmlspecialchars($page['slug']) ?></td>
                        <td><?= htmlspecialchars($page['status']) ?></td>
                        <td><?= htmlspecialchars($page['created_at']) ?></td>
                        <td>
                            <a href="/minicommerce-cms/public/admin/pages/edit/<?= (int) $page['id'] ?>">
                                Edit
                            </a>

                            <form
                                method="post"
                                action="/minicommerce-cms/public/admin/pages/delete/<?= (int) $page['id'] ?>"
                                style="display:inline"
                                onsubmit="return confirm('Are you sure you want to delete this page?');"
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