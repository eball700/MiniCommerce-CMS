<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\ProductController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/page/{slug}', [PageController::class, 'show']);
$router->get('/products', [ProductController::class, 'index']);
$router->get('/product/{slug}', [ProductController::class, 'show']);