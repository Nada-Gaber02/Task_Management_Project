
<?php

ini_set('display_errors', '0');
ini_set('log_errors', '1');

register_shutdown_function(function () {
    $error = error_get_last();

    if ($error && in_array($error['type'], [
        E_ERROR,
        E_PARSE,
        E_CORE_ERROR,
        E_COMPILE_ERROR,
    ], true)) {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        http_response_code(500);
        header('Content-Type: text/plain; charset=utf-8');

        echo "ORIGINAL FATAL ERROR\n";
        echo $error['message'] . "\n";
        echo $error['file'] . ':' . $error['line'];
    }
});

try {
    require __DIR__ . '/../vendor/autoload.php';
    echo "AUTOLOAD_OK\n";

    $app = require __DIR__ . '/../bootstrap/app.php';
    echo "APP_CREATED\n";

    $kernel = $app->make(
        Illuminate\Contracts\Http\Kernel::class
    );
    echo "HTTP_KERNEL_CREATED\n";

    $kernel->bootstrap();
    echo "BOOTSTRAP_OK\n";

    echo 'VIEW_BINDING=' .
        ($app->bound('view') ? 'REGISTERED' : 'MISSING');
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');

    echo "CAUGHT EXCEPTION\n";
    echo get_class($e) . "\n";
    echo $e->getMessage() . "\n";
    echo $e->getFile() . ':' . $e->getLine();
}
