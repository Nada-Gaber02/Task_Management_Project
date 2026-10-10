<?php

header('Content-Type: application/json; charset=utf-8');

try {
    require __DIR__ . '/../vendor/autoload.php';

    $app = require __DIR__ . '/../bootstrap/app.php';

    $kernel = $app->make(
        Illuminate\Contracts\Http\Kernel::class
    );

    $kernel->bootstrap();

    echo json_encode([
        'status' => 'BOOTSTRAP_OK',
        'laravel_version' => Illuminate\Foundation\Application::VERSION,
        'view_provider_registered' => $app->bound(
            Illuminate\View\Factory::class
        ),
        'view_service_bound' => $app->bound('view'),
        'view_provider_loaded' => class_exists(
            Illuminate\View\ViewServiceProvider::class
        ),
    ], JSON_PRETTY_PRINT);

} catch (\Throwable $e) {
    http_response_code(500);

    echo json_encode([
        'status' => 'EXCEPTION',
        'class' => get_class($e),
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ], JSON_PRETTY_PRINT);
}
