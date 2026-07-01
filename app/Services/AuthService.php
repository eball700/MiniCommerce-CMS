<?php

declare(strict_types=1);

namespace App\Services;

use PDO;

class AuthService
{
    private const SESSION_KEY = 'admin_user_id';

    public function __construct(private PDO $pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function attempt(string $email, string $password): bool
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, password_hash FROM users WHERE email = :email AND role = :role LIMIT 1'
        );

        $stmt->execute([
            'email' => $email,
            'role' => 'admin',
        ]);

        $user = $stmt->fetch();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password_hash'])) {
            return false;
        }

        $_SESSION[self::SESSION_KEY] = (int) $user['id'];

        return true;
    }

    public function check(): bool
    {
        return isset($_SESSION[self::SESSION_KEY]);
    }

    public function logout(): void
    {
        unset($_SESSION[self::SESSION_KEY]);
    }
}