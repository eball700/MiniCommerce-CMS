<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\PageController;

$router->get('/', [HomeController::class, 'index']);
$router->get('/page/{slug}', [PageController::class, 'show']);