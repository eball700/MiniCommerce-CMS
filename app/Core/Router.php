<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(string $requestUri, string $requestMethod): void
    {
        $path = parse_url($requestUri, PHP_URL_PATH);

        $basePath = '/minicommerce-cms/public';
        if (str_starts_with($path, $basePath)) {
            $path = substr($path, strlen($basePath));
        }

        $path = $path ?: '/';

        if (!isset($this->routes[$requestMethod][$path])) {
            http_response_code(404);
            echo '404 - Page not found';
            return;
        }

        [$controllerClass, $method] = $this->routes[$requestMethod][$path];

        $controller = new $controllerClass();
        $controller->$method();
    }
}