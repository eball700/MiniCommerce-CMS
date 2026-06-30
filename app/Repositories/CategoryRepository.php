<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class CategoryRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT id, name, slug
             FROM categories
             ORDER BY name ASC'
        );

        return $stmt->fetchAll();
    }
}