<?php

$bootstrapCache = '/tmp/laravel-bootstrap/cache';
$storage = '/tmp/laravel-storage';

foreach ([
    $bootstrapCache,
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

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->useBootstrapPath('/tmp/laravel-bootstrap');
$app->useStoragePath($storage);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;
