<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\PageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Services\Database;

class HomeController extends Controller
{
    public function index(): void
    {
        $pdo = Database::getConnection();

        $settingRepository = new SettingRepository($pdo);
        $pageRepository = new PageRepository($pdo);
        $productRepository = new ProductRepository($pdo);

        $siteName = $settingRepository->get('site_name', 'MiniCommerce CMS');
        $pages = $pageRepository->getPublishedPages();
        $featuredProducts = $productRepository->getFeaturedProducts(3);

        $this->view('public/home', [
            'siteName' => $siteName,
            'pages' => $pages,
            'featuredProducts' => $featuredProducts,
        ]);
    }
}