<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthService;
use App\Services\Database;

class AdminAuthController extends Controller
{
    public function showLogin(): void
    {
        $this->view('admin/login', [
            'error' => null,
        ], 'admin');
    }

    public function login(): void
    {
        $this->verifyCsrf();
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $authService = new AuthService(Database::getConnection());

        if (!$authService->attempt($email, $password)) {
            $this->view('admin/login', [
                'error' => 'Invalid email or password.',
            ], 'admin');
            return;
        }

        $this->redirect('/minicommerce-cms/public/admin/dashboard');
    }

    public function logout(): void
    {
        $authService = new AuthService(Database::getConnection());
        $authService->logout();

        $this->redirect('/minicommerce-cms/public/admin/login');
    }
}