<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\SettingRepository;
use App\Services\AuthService;
use App\Services\Database;

class AdminSettingController extends Controller
{
    private function requireAuth(): void
    {
        $authService = new AuthService(Database::getConnection());

        if (!$authService->check()) {
            $this->redirect('/minicommerce-cms/public/admin/login');
        }
    }

    public function index(): void
    {
        $this->requireAuth();

        $settingRepository = new SettingRepository(Database::getConnection());

        $this->view('admin/settings', [
            'settings' => $settingRepository->getAll(),
        ], 'admin');
    }

    public function update(): void
    {
        $this->requireAuth();

        $settingRepository = new SettingRepository(Database::getConnection());

        $settingRepository->update('site_name', trim($_POST['site_name'] ?? ''));
        $settingRepository->update('contact_email', trim($_POST['contact_email'] ?? ''));

        $this->redirect('/minicommerce-cms/public/admin/settings');
    }
}