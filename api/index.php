<?php
$storage = '/tmp/storage';
foreach ([
    $storage . '/app',
    $storage . '/framework/cache',
    $storage . '/framework/sessions',
    $storage . '/framework/views',
    $storage . '/logs',
    '/tmp/bootstrap/cache',
] as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}
putenv('LARAVEL_STORAGE_PATH=' . $storage);
$_ENV['LARAVEL_STORAGE_PATH'] = $storage;
$_SERVER['LARAVEL_STORAGE_PATH'] = $storage;

putenv('LOG_CHANNEL=stderr');
$_ENV['LOG_CHANNEL'] = 'stderr';
$_SERVER['LOG_CHANNEL'] = 'stderr';
require __DIR__ . '/../public/index.php';
