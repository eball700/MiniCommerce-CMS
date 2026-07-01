<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\PageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Services\CartService;
use App\Services\Database;

class CartController extends Controller
{
    public function index(): void
    {
        $pdo = Database::getConnection();

        $settingRepository = new SettingRepository($pdo);
        $pageRepository = new PageRepository($pdo);
        $productRepository = new ProductRepository($pdo);
        $cartService = new CartService();

        $siteName = $settingRepository->get('site_name', 'MiniCommerce CMS');
        $pages = $pageRepository->getPublishedPages();

        $cartItems = [];
        $total = 0.0;

        foreach ($cartService->getItems() as $productId => $quantity) {
            $product = $productRepository->findPublishedById((int) $productId);

            if ($product === null) {
                continue;
            }

            $lineTotal = (float) $product['price'] * (int) $quantity;
            $total += $lineTotal;

            $cartItems[] = [
                'product' => $product,
                'quantity' => (int) $quantity,
                'lineTotal' => $lineTotal,
            ];
        }

        $this->view('public/cart', [
            'siteName' => $siteName,
            'pages' => $pages,
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function add(): void
    {
        $this->verifyCsrf();

        $productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
        $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

        if ($productId > 0) {
            $cartService = new CartService();
            $cartService->add($productId, $quantity);
        }

        $this->redirect('/minicommerce-cms/public/cart');
    }

    public function update(): void
    {

    $this->verifyCsrf();

        $productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
        $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

        if ($productId > 0) {
            $cartService = new CartService();
            $cartService->update($productId, $quantity);
        }

        $this->redirect('/minicommerce-cms/public/cart');
    }

    public function remove(): void
    {
        $this->verifyCsrf();
        
        $productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;

        if ($productId > 0) {
            $cartService = new CartService();
            $cartService->remove($productId);
        }

        $this->redirect('/minicommerce-cms/public/cart');
    }
}