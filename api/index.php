
<?php

error_reporting(E_ALL);
ini_set('display_errors', '0');

try {
    require __DIR__ . '/../vendor/autoload.php';

    $app = require __DIR__ . '/../bootstrap/app.php';

    $app->make(
        Illuminate\Contracts\Http\Kernel::class
    );

    $kernel = $app->make(
        Illuminate\Contracts\Http\Kernel::class
    );

    $kernel->bootstrap();

    $result = [
        'status' => 'BOOTSTRAP_OK',
        'request_bound' => $app->bound('request'),
        'view_bound' => $app->bound('view'),
    ];
} catch (\Throwable $e) {
    $result = [
        'status' => 'EXCEPTION',
        'class' => get_class($e),
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ];
}

if (ob_get_level() > 0) {
    ob_end_clean();
}

header('Content-Type: application/json; charset=utf-8');

echo json_encode(
    $result,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
