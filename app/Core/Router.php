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

if (str_starts_with($path, $basePath . '/index.php')) {
    $path = substr($path, strlen($basePath . '/index.php'));
} elseif (str_starts_with($path, $basePath)) {
    $path = substr($path, strlen($basePath));
}

$path = $path ?: '/';

        foreach ($this->routes[$requestMethod] ?? [] as $route => $handler) {
            $pattern = preg_replace('#\{[a-zA-Z_][a-zA-Z0-9_]*\}#', '([^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);

                [$controllerClass, $method] = $handler;

                $controller = new $controllerClass();
                $controller->$method(...$matches);
                return;
            }
        }

        http_response_code(404);
        echo '404 - Page not found';
    }
}