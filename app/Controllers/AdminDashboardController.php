<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthService;
use App\Services\Database;

class AdminDashboardController extends Controller
{
    public function index(): void
    {
        $authService = new AuthService(Database::getConnection());

        if (!$authService->check()) {
            $this->redirect('/minicommerce-cms/public/admin/login');
        }

        $this->view('admin/dashboard', [], 'admin');
    }
}