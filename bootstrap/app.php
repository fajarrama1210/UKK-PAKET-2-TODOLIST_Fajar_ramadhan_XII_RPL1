<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php', // File untuk route web
        commands: __DIR__ . '/../routes/console.php', // File untuk route artisan commands
        health: '/up', // Endpoint untuk health check
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Konfigurasi untuk handling exception, jika diperlukan
    })
    ->create();
