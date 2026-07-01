<?php

declare(strict_types=1);

use App\Controllers\AdminAuthController;
use App\Controllers\AdminDashboardController;
use App\Controllers\AdminPageController;
use App\Controllers\AdminProductController;
use App\Controllers\AdminSettingController;
use App\Controllers\CartController;
use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\ProductController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/page/{slug}', [PageController::class, 'show']);

$router->get('/products', [ProductController::class, 'index']);
$router->get('/product/{slug}', [ProductController::class, 'show']);

$router->get('/cart', [CartController::class, 'index']);
$router->post('/cart/add', [CartController::class, 'add']);
$router->post('/cart/update', [CartController::class, 'update']);
$router->post('/cart/remove', [CartController::class, 'remove']);

$router->get('/admin/login', [AdminAuthController::class, 'showLogin']);
$router->post('/admin/login', [AdminAuthController::class, 'login']);
$router->get('/admin/logout', [AdminAuthController::class, 'logout']);
$router->get('/admin/dashboard', [AdminDashboardController::class, 'index']);

$router->get('/admin/pages', [AdminPageController::class, 'index']);
$router->get('/admin/pages/create', [AdminPageController::class, 'create']);
$router->post('/admin/pages/store', [AdminPageController::class, 'store']);
$router->get('/admin/pages/edit/{id}', [AdminPageController::class, 'edit']);
$router->post('/admin/pages/update/{id}', [AdminPageController::class, 'update']);
$router->post('/admin/pages/delete/{id}', [AdminPageController::class, 'delete']);

$router->get('/admin/products', [AdminProductController::class, 'index']);
$router->get('/admin/products/create', [AdminProductController::class, 'create']);
$router->post('/admin/products/store', [AdminProductController::class, 'store']);
$router->get('/admin/products/edit/{id}', [AdminProductController::class, 'edit']);
$router->post('/admin/products/update/{id}', [AdminProductController::class, 'update']);
$router->post('/admin/products/delete/{id}', [AdminProductController::class, 'delete']);

$router->get('/admin/settings', [AdminSettingController::class, 'index']);
$router->post('/admin/settings/update', [AdminSettingController::class, 'update']);