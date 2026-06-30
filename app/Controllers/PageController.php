<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;
use App\Services\Database;

class PageController extends Controller
{
    public function show(string $slug): void
    {
        $pdo = Database::getConnection();

        $settingRepository = new SettingRepository($pdo);
        $pageRepository = new PageRepository($pdo);

        $siteName = $settingRepository->get('site_name', 'MiniCommerce CMS');
        $pages = $pageRepository->getPublishedPages();
        $page = $pageRepository->findPublishedBySlug($slug);

        if ($page === null) {
            http_response_code(404);
            echo '404 - Page not found';
            return;
        }

        $this->view('public/page', [
            'siteName' => $siteName,
            'pages' => $pages,
            'page' => $page,
        ]);
    }
}