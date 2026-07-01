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

    public function getAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT *
             FROM pages
             ORDER BY created_at DESC'
        );

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT *
             FROM pages
             WHERE id = :id
             LIMIT 1'
        );

        $stmt->execute([
            'id' => $id,
        ]);

        $page = $stmt->fetch();

        return $page ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO pages
                (title, slug, content, meta_title, meta_description, status)
             VALUES
                (:title, :slug, :content, :meta_title, :meta_description, :status)'
        );

        $stmt->execute([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
            'status' => $data['status'],
        ]);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE pages
             SET title = :title,
                 slug = :slug,
                 content = :content,
                 meta_title = :meta_title,
                 meta_description = :meta_description,
                 status = :status
             WHERE id = :id'
        );

        $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
            'status' => $data['status'],
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM pages WHERE id = :id'
        );

        $stmt->execute([
            'id' => $id,
        ]);
    }
}