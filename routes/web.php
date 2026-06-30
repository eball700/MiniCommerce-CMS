<?php

declare(strict_types=1);

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