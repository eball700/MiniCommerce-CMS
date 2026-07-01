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
    'errors' => [],
    'action' => '/minicommerce-cms/public/admin/products/store',
    'title' => 'Create Product',
], 'admin');

    }

public function store(): void
{
    $this->requireAuth();
    $this->verifyCsrf();

    $data = $this->getProductDataFromRequest();
    $errors = $this->validateProductData($data);

    if (!empty($errors)) {
        $categoryRepository = new CategoryRepository(Database::getConnection());

        $this->view('admin/products-form', [
            'product' => $data,
            'categories' => $categoryRepository->getAll(),
            'errors' => $errors,
            'action' => '/minicommerce-cms/public/admin/products/store',
            'title' => 'Create Product',
        ], 'admin');
        return;
    }

    $productRepository = new ProductRepository(Database::getConnection());
    $productRepository->create($data);

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
    'errors' => [],
    'action' => '/minicommerce-cms/public/admin/products/update/' . (int) $id,
    'title' => 'Edit Product',
], 'admin');
    }

public function update(string $id): void
{
    $this->requireAuth();
    $this->verifyCsrf();

    $pdo = Database::getConnection();

    $productRepository = new ProductRepository($pdo);
    $categoryRepository = new CategoryRepository($pdo);

    $existingProduct = $productRepository->findById((int) $id);

    if ($existingProduct === null) {
        http_response_code(404);
        echo '404 - Admin product not found';
        return;
    }

    $data = $this->getProductDataFromRequest($existingProduct);
    $errors = $this->validateProductData($data);

    if (!empty($errors)) {
        $this->view('admin/products-form', [
            'product' => array_merge($existingProduct, $data),
            'categories' => $categoryRepository->getAll(),
            'errors' => $errors,
            'action' => '/minicommerce-cms/public/admin/products/update/' . (int) $id,
            'title' => 'Edit Product',
        ], 'admin');
        return;
    }

    $productRepository->update((int) $id, $data);

    $this->redirect('/minicommerce-cms/public/admin/products');
}

    public function delete(string $id): void
    {
        $this->requireAuth();
        $this->verifyCsrf();

        $productRepository = new ProductRepository(Database::getConnection());
        $productRepository->delete((int) $id);

        $this->redirect('/minicommerce-cms/public/admin/products');
    }

    private function validateProductData(array $data): array
{
    $errors = [];

    if ($data['name'] === '') {
        $errors['name'] = 'Product name is required.';
    }

    if ($data['slug'] === '') {
        $errors['slug'] = 'Product slug is required.';
    }

    if ($data['description'] === '') {
        $errors['description'] = 'Product description is required.';
    }

    if ($data['price'] <= 0) {
        $errors['price'] = 'Product price must be greater than zero.';
    }

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] === UPLOAD_ERR_OK
    ) {
        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $allowedExtensions, true)) {
            $errors['image'] = 'Only JPG, PNG and WEBP images are allowed.';
        }
    }

    return $errors;
}

private function getProductDataFromRequest(?array $existingProduct = null): array
{
    $categoryId = isset($_POST['category_id']) && $_POST['category_id'] !== ''
        ? (int) $_POST['category_id']
        : null;

    $imagePath = $existingProduct['image'] ?? null;

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] === UPLOAD_ERR_OK
    ) {
        $uploadDir = __DIR__ . '/../../public/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $originalName = $_FILES['image']['name'];
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($extension, $allowedExtensions, true)) {
            $fileName = uniqid('product_', true) . '.' . $extension;
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $imagePath = 'uploads/' . $fileName;
            }
        }
    }

    return [
        'category_id' => $categoryId,
        'name' => trim($_POST['name'] ?? ''),
        'slug' => trim($_POST['slug'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'price' => (float) ($_POST['price'] ?? 0),
        'image' => $imagePath,
        'status' => ($_POST['status'] ?? '') === 'published' ? 'published' : 'draft',
        'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
    ];
}

}