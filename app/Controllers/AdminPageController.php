<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\PageRepository;
use App\Services\AuthService;
use App\Services\Database;

class AdminPageController extends Controller
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

        $pageRepository = new PageRepository(Database::getConnection());

        $this->view('admin/pages-index', [
            'pages' => $pageRepository->getAll(),
        ], 'admin');
    }

    public function create(): void
    {
        $this->requireAuth();

$this->view('admin/pages-form', [
    'page' => null,
    'errors' => [],
    'action' => '/minicommerce-cms/public/admin/pages/store',
    'title' => 'Create Page',
], 'admin');
    }

public function store(): void
{
    
    $this->requireAuth();
    $this->verifyCsrf();

    $pageRepository = new PageRepository(Database::getConnection());

    $data = $this->getPageDataFromRequest();
    $errors = $this->validatePageData($data);

    if (!empty($errors)) {
        $this->view('admin/pages-form', [
            'page' => $data,
            'errors' => $errors,
            'action' => '/minicommerce-cms/public/admin/pages/store',
            'title' => 'Create Page',
        ], 'admin');
        return;
    }

    $pageRepository->create($data);

    $this->redirect('/minicommerce-cms/public/admin/pages');
}

    public function edit(string $id): void
    {
        $this->requireAuth();

        $pageRepository = new PageRepository(Database::getConnection());
        $page = $pageRepository->findById((int) $id);

        if ($page === null) {
            http_response_code(404);
            echo '404 - Admin page not found';
            return;
        }

$this->view('admin/pages-form', [
    'page' => $page,
    'errors' => [],
    'action' => '/minicommerce-cms/public/admin/pages/update/' . (int) $id,
    'title' => 'Edit Page',
], 'admin');
    }

public function update(string $id): void
{
    $this->requireAuth();
    $this->verifyCsrf();

    $pageRepository = new PageRepository(Database::getConnection());

    $page = $pageRepository->findById((int) $id);

    if ($page === null) {
        http_response_code(404);
        echo '404 - Admin page not found';
        return;
    }

    $data = $this->getPageDataFromRequest();
    $errors = $this->validatePageData($data);

    if (!empty($errors)) {
        $this->view('admin/pages-form', [
            'page' => array_merge($page, $data),
            'errors' => $errors,
            'action' => '/minicommerce-cms/public/admin/pages/update/' . (int) $id,
            'title' => 'Edit Page',
        ], 'admin');
        return;
    }

    $pageRepository->update((int) $id, $data);

    $this->redirect('/minicommerce-cms/public/admin/pages');
}

    public function delete(string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $pageRepository = new PageRepository(Database::getConnection());
        $pageRepository->delete((int) $id);

        $this->redirect('/minicommerce-cms/public/admin/pages');
    }

    private function validatePageData(array $data): array
{
    $errors = [];

    if ($data['title'] === '') {
        $errors['title'] = 'Page title is required.';
    }

    if ($data['slug'] === '') {
        $errors['slug'] = 'Page slug is required.';
    }

    if ($data['content'] === '') {
        $errors['content'] = 'Page content is required.';
    }

    if (!in_array($data['status'], ['draft', 'published'], true)) {
        $errors['status'] = 'Invalid page status.';
    }

    return $errors;
}

    private function getPageDataFromRequest(): array
    {
        return [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'content' => trim($_POST['content'] ?? ''),
            'meta_title' => trim($_POST['meta_title'] ?? ''),
            'meta_description' => trim($_POST['meta_description'] ?? ''),
            'status' => $_POST['status'] === 'published' ? 'published' : 'draft',
        ];
    }
}