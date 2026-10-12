<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$storage = '/tmp/laravel-storage';
$bootstrap = '/tmp/laravel-bootstrap';
$cache = $bootstrap . '/cache';

foreach ([
    $cache,
    $storage . '/app',
    $storage . '/framework/cache/data',
    $storage . '/framework/sessions',
    $storage . '/framework/views',
    $storage . '/logs',
] as $directory) {
    if (
        ! is_dir($directory) &&
        ! mkdir($directory, 0755, true) &&
        ! is_dir($directory)
    ) {
        throw new RuntimeException(
            'Cannot create directory: ' . $directory
        );
    }
}

$environment = [
    'APP_STORAGE' => $storage,
    'APP_SERVICES_CACHE' => $cache . '/services.php',
    'APP_PACKAGES_CACHE' => $cache . '/packages.php',
    'APP_CONFIG_CACHE' => $cache . '/config.php',
    'APP_ROUTES_CACHE' => $cache . '/routes.php',
    'APP_EVENTS_CACHE' => $cache . '/events.php',
    'LOG_CHANNEL' => 'stderr',
];

foreach ($environment as $key => $value) {
    putenv($key . '=' . $value);
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

require __DIR__ . '/../vendor/autoload.php';


try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    $kernel = $app->make(
        \Illuminate\Contracts\Http\Kernel::class
    );

    $request = \Illuminate\Http\Request::capture();

    $response = $kernel->handle($request);

    $response->send();

    $kernel->terminate($request, $response);
} catch (\Throwable $e) {
    error_log(
        'LARAVEL_FATAL: ' . get_class($e)
        . ' | ' . $e->getMessage()
        . ' | ' . $e->getFile()
        . ':' . $e->getLine()
    );

    throw $e;
}


$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
