<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Services\Database;

class HomeController extends Controller
{
    public function index(): void
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->query('SELECT setting_value FROM settings WHERE setting_key = "site_name"');
        $siteName = $stmt->fetchColumn();

        $this->view('public/home', [
            'siteName' => $siteName,
        ]);
    }
}