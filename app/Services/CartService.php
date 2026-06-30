<?php

declare(strict_types=1);

namespace App\Services;

class CartService
{
    private const SESSION_KEY = 'cart';

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = [];
        }
    }

    public function add(int $productId, int $quantity = 1): void
    {
        if ($quantity < 1) {
            $quantity = 1;
        }

        if (isset($_SESSION[self::SESSION_KEY][$productId])) {
            $_SESSION[self::SESSION_KEY][$productId] += $quantity;
            return;
        }

        $_SESSION[self::SESSION_KEY][$productId] = $quantity;
    }

    public function update(int $productId, int $quantity): void
    {
        if ($quantity <= 0) {
            $this->remove($productId);
            return;
        }

        $_SESSION[self::SESSION_KEY][$productId] = $quantity;
    }

    public function remove(int $productId): void
    {
        unset($_SESSION[self::SESSION_KEY][$productId]);
    }

    public function clear(): void
    {
        $_SESSION[self::SESSION_KEY] = [];
    }

    public function getItems(): array
    {
        return $_SESSION[self::SESSION_KEY];
    }
}