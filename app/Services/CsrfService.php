<?php

declare(strict_types=1);

namespace App\Services;

class CsrfService
{
    private const SESSION_KEY = 'csrf_token';

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(32));
        }
    }

    public function token(): string
    {
        return $_SESSION[self::SESSION_KEY];
    }

    public function validate(?string $token): bool
    {
        return is_string($token)
            && hash_equals($_SESSION[self::SESSION_KEY] ?? '', $token);
    }
}