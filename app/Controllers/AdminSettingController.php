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
            'errors' => [],
        ], 'admin');
    }

    public function update(): void
    {
        $this->requireAuth();

        $data = [
            'site_name' => trim($_POST['site_name'] ?? ''),
            'contact_email' => trim($_POST['contact_email'] ?? ''),
        ];

        $errors = $this->validateSettingsData($data);

        if (!empty($errors)) {
            $this->view('admin/settings', [
                'settings' => $data,
                'errors' => $errors,
            ], 'admin');
            return;
        }

        $settingRepository = new SettingRepository(Database::getConnection());

        $settingRepository->update('site_name', $data['site_name']);
        $settingRepository->update('contact_email', $data['contact_email']);

        $this->redirect('/minicommerce-cms/public/admin/settings');
    }

    private function validateSettingsData(array $data): array
    {
        $errors = [];

        if ($data['site_name'] === '') {
            $errors['site_name'] = 'Website name is required.';
        }

        if ($data['contact_email'] === '') {
            $errors['contact_email'] = 'Contact email is required.';
        } elseif (!filter_var($data['contact_email'], FILTER_VALIDATE_EMAIL)) {
            $errors['contact_email'] = 'Contact email must be a valid email address.';
        }

        return $errors;
    }
}