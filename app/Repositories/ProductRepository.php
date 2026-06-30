<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class ProductRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getFeaturedProducts(int $limit = 3): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT p.*, c.name AS category_name
             FROM products p
             LEFT JOIN categories c ON c.id = p.category_id
             WHERE p.status = :status
             AND p.is_featured = 1
             ORDER BY p.created_at DESC
             LIMIT ' . (int) $limit
        );

        $stmt->execute([
            'status' => 'published',
        ]);

        return $stmt->fetchAll();
    }

    public function getPublishedProducts(?int $categoryId = null, string $sort = 'asc'): array
    {
        $allowedSort = strtolower($sort) === 'desc' ? 'DESC' : 'ASC';

        $sql = 'SELECT p.*, c.name AS category_name
                FROM products p
                LEFT JOIN categories c ON c.id = p.category_id
                WHERE p.status = :status';

        $params = [
            'status' => 'published',
        ];

        if ($categoryId !== null) {
            $sql .= ' AND p.category_id = :category_id';
            $params['category_id'] = $categoryId;
        }

        $sql .= ' ORDER BY p.price ' . $allowedSort;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function findPublishedBySlug(string $slug): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT p.*, c.name AS category_name
             FROM products p
             LEFT JOIN categories c ON c.id = p.category_id
             WHERE p.slug = :slug
             AND p.status = :status
             LIMIT 1'
        );

        $stmt->execute([
            'slug' => $slug,
            'status' => 'published',
        ]);

        $product = $stmt->fetch();

        return $product ?: null;
    }
}