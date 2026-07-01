<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class SettingRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function get(string $key, ?string $default = null): ?string
    {
        $stmt = $this->pdo->prepare(
            'SELECT setting_value FROM settings WHERE setting_key = :setting_key LIMIT 1'
        );

        $stmt->execute([
            'setting_key' => $key,
        ]);

        $value = $stmt->fetchColumn();

        return $value !== false ? (string) $value : $default;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT setting_key, setting_value FROM settings'
        );

        $settings = [];

        foreach ($stmt->fetchAll() as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        return $settings;
    }

    public function update(string $key, string $value): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE settings
             SET setting_value = :setting_value
             WHERE setting_key = :setting_key'
        );

        $stmt->execute([
            'setting_key' => $key,
            'setting_value' => $value,
        ]);
    }
}