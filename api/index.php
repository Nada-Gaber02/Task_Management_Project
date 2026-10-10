
<?php

header('Content-Type: application/json; charset=utf-8');

try {
    require __DIR__ . '/../vendor/autoload.php';

    $app = require __DIR__ . '/../bootstrap/app.php';

    $providers = Illuminate\Support\ServiceProvider::defaultProviders()
        ->toArray();

    $result = [
        'app_created' => true,
        'view_provider_in_defaults' => in_array(
            Illuminate\View\ViewServiceProvider::class,
            $providers,
            true
        ),
        'view_bound_before_bootstrap' => $app->bound('view'),
    ];

    $kernel = $app->make(
        Illuminate\Contracts\Http\Kernel::class
    );

    $kernel->bootstrap();

    $result['view_bound_after_bootstrap'] = $app->bound('view');
    $result['status'] = 'BOOTSTRAP_OK';

    echo json_encode($result, JSON_PRETTY_PRINT);
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
