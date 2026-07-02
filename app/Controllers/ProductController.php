<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\PageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Services\Database;

class ProductController extends Controller
{
    public function index(): void
    {
        $pdo = Database::getConnection();

        $settingRepository = new SettingRepository($pdo);
        $pageRepository = new PageRepository($pdo);
        $categoryRepository = new CategoryRepository($pdo);
        $productRepository = new ProductRepository($pdo);

$categoryId = isset($_GET['category']) && $_GET['category'] !== ''
    ? (int) $_GET['category']
    : null;

$sort = $_GET['sort'] ?? 'asc';

if (!in_array($sort, ['asc', 'desc'], true)) {
    $sort = 'asc';
}

$products = $productRepository->getPublishedProducts($categoryId, $sort);

        $siteName = $settingRepository->get('site_name', 'MiniCommerce CMS');
        $pages = $pageRepository->getPublishedPages();
        $categories = $categoryRepository->getAll();
        $products = $productRepository->getPublishedProducts($categoryId, $sort);

        $this->view('public/products', [
            'siteName' => $siteName,
            'pages' => $pages,
            'categories' => $categories,
            'products' => $products,
            'selectedCategory' => $categoryId,
            'selectedSort' => $sort,
        ]);
    }

    public function show(string $slug): void
    {
        $pdo = Database::getConnection();

        $settingRepository = new SettingRepository($pdo);
        $pageRepository = new PageRepository($pdo);
        $productRepository = new ProductRepository($pdo);

        $siteName = $settingRepository->get('site_name', 'MiniCommerce CMS');
        $pages = $pageRepository->getPublishedPages();
        $product = $productRepository->findPublishedBySlug($slug);

        if ($product === null) {
            http_response_code(404);
            echo '404 - Product not found';
            return;
        }

        $this->view('public/product-detail', [
            'siteName' => $siteName,
            'pages' => $pages,
            'product' => $product,
        ]);
    }
}