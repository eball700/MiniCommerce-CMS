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

    public function findPublishedById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT p.*, c.name AS category_name
             FROM products p
             LEFT JOIN categories c ON c.id = p.category_id
             WHERE p.id = :id
             AND p.status = :status
             LIMIT 1'
        );

        $stmt->execute([
            'id' => $id,
            'status' => 'published',
        ]);

        $product = $stmt->fetch();

        return $product ?: null;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT p.*, c.name AS category_name
             FROM products p
             LEFT JOIN categories c ON c.id = p.category_id
             ORDER BY p.created_at DESC'
        );

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT *
             FROM products
             WHERE id = :id
             LIMIT 1'
        );

        $stmt->execute([
            'id' => $id,
        ]);

        $product = $stmt->fetch();

        return $product ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO products
                (category_id, name, slug, description, price, image, status, is_featured)
             VALUES
                (:category_id, :name, :slug, :description, :price, :image, :status, :is_featured)'
        );

        $stmt->execute([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $data['image'],
            'status' => $data['status'],
            'is_featured' => $data['is_featured'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE products
             SET category_id = :category_id,
                 name = :name,
                 slug = :slug,
                 description = :description,
                 price = :price,
                 image = :image,
                 status = :status,
                 is_featured = :is_featured
             WHERE id = :id'
        );

        $stmt->execute([
            'id' => $id,
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $data['image'],
            'status' => $data['status'],
            'is_featured' => $data['is_featured'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM products WHERE id = :id'
        );

        $stmt->execute([
            'id' => $id,
        ]);
    }
}