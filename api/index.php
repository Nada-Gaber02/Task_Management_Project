
<?php

ini_set('display_errors', '0');
ini_set('log_errors', '1');

try {
    require __DIR__ . '/../vendor/autoload.php';

    $app = require __DIR__ . '/../bootstrap/app.php';

    $kernel = $app->make(
        Illuminate\Contracts\Console\Kernel::class
    );

    $kernel->bootstrap();

    header('Content-Type: text/plain; charset=utf-8');
    echo "Laravel bootstrap successful\n";
    echo "View binding: ";
    echo $app->bound('view') ? 'registered' : 'NOT registered';
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');

    echo get_class($e) . "\n";
    echo $e->getMessage() . "\n";
    echo $e->getFile() . ':' . $e->getLine();
}
