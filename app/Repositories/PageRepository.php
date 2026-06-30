<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class PageRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getPublishedPages(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, title, slug, meta_title, meta_description
             FROM pages
             WHERE status = :status
             ORDER BY title ASC'
        );

        $stmt->execute([
            'status' => 'published',
        ]);

        return $stmt->fetchAll();
    }

    public function findPublishedBySlug(string $slug): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT *
             FROM pages
             WHERE slug = :slug
             AND status = :status
             LIMIT 1'
        );

        $stmt->execute([
            'slug' => $slug,
            'status' => 'published',
        ]);

        $page = $stmt->fetch();

        return $page ?: null;
    }
}