<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\AuthService;
use App\Services\Database;

class AdminProductController extends Controller
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

        $productRepository = new ProductRepository(Database::getConnection());

        $this->view('admin/products-index', [
            'products' => $productRepository->getAll(),
        ], 'admin');
    }

    public function create(): void
    {
        $this->requireAuth();

        $categoryRepository = new CategoryRepository(Database::getConnection());

        $this->view('admin/products-form', [
            'product' => null,
            'categories' => $categoryRepository->getAll(),
            'action' => '/minicommerce-cms/public/admin/products/store',
            'title' => 'Create Product',
        ], 'admin');
    }

    public function store(): void
    {
        $this->requireAuth();

        $productRepository = new ProductRepository(Database::getConnection());
        $productRepository->create($this->getProductDataFromRequest());

        $this->redirect('/minicommerce-cms/public/admin/products');
    }

    public function edit(string $id): void
    {
        $this->requireAuth();

        $pdo = Database::getConnection();

        $productRepository = new ProductRepository($pdo);
        $categoryRepository = new CategoryRepository($pdo);

        $product = $productRepository->findById((int) $id);

        if ($product === null) {
            http_response_code(404);
            echo '404 - Admin product not found';
            return;
        }

        $this->view('admin/products-form', [
            'product' => $product,
            'categories' => $categoryRepository->getAll(),
            'action' => '/minicommerce-cms/public/admin/products/update/' . (int) $id,
            'title' => 'Edit Product',
        ], 'admin');
    }

    public function update(string $id): void
    {
        $this->requireAuth();

        $productRepository = new ProductRepository(Database::getConnection());
        $productRepository->update((int) $id, $this->getProductDataFromRequest());

        $this->redirect('/minicommerce-cms/public/admin/products');
    }

    public function delete(string $id): void
    {
        $this->requireAuth();

        $productRepository = new ProductRepository(Database::getConnection());
        $productRepository->delete((int) $id);

        $this->redirect('/minicommerce-cms/public/admin/products');
    }

    private function getProductDataFromRequest(): array
    {
        $categoryId = isset($_POST['category_id']) && $_POST['category_id'] !== ''
            ? (int) $_POST['category_id']
            : null;

        return [
            'category_id' => $categoryId,
            'name' => trim($_POST['name'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price' => (float) ($_POST['price'] ?? 0),
            'image' => trim($_POST['image'] ?? '') ?: null,
            'status' => ($_POST['status'] ?? '') === 'published' ? 'published' : 'draft',
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
        ];
    }
}