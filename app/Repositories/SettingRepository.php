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
}