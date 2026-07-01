<?php

declare(strict_types=1);

namespace App\Core;

use App\Services\CsrfService;

class Controller
{
    protected function view(string $view, array $data = [], string $layout = 'main'): void
    {
        $csrfService = new CsrfService();

        $data['csrfToken'] = $csrfService->token();

        View::render($view, $data, $layout);
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . $path);
        exit;
    }

    protected function verifyCsrf(): void
    {
        $csrfService = new CsrfService();

        if (!$csrfService->validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            echo '403 - Invalid CSRF token';
            exit;
        }
    }
}