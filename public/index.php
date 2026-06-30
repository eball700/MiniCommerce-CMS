<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/Services/Database.php';

use App\Services\Database;

$pdo = Database::getConnection();

$stmt = $pdo->query('SELECT setting_value FROM settings WHERE setting_key = "site_name"');
$siteName = $stmt->fetchColumn();

echo $siteName;