<?php
$storage = '/tmp/laravel-storage';
$cache = '/tmp/laravel-bootstrap-cache';
$directories = [
    $storage . '/app',
    $storage . '/framework/cache/data',
    $storage . '/framework/sessions',
    $storage . '/framework/views',
    $storage . '/logs',
    $cache,
];
foreach ($directories as $directory) {
    if (!is_dir($directory) &&
        !mkdir($directory, 0755, true) &&
        !is_dir($directory)) {
        throw new RuntimeException(
            'Could not create directory: ' . $directory
        );
    }
}
putenv('APP_STORAGE=' . $storage);
$_ENV['APP_STORAGE'] = $storage;
$_SERVER['APP_STORAGE'] = $storage;
putenv('LARAVEL_STORAGE_PATH=' . $storage);
$_ENV['LARAVEL_STORAGE_PATH'] = $storage;
$_SERVER['LARAVEL_STORAGE_PATH'] = $storage;
putenv('APP_SERVICES_CACHE=' . $cache . '/services.php');
putenv('APP_PACKAGES_CACHE=' . $cache . '/packages.php');
putenv('APP_CONFIG_CACHE=' . $cache . '/config.php');
putenv('APP_ROUTES_CACHE=' . $cache . '/routes.php');
putenv('APP_EVENTS_CACHE=' . $cache . '/events.php');
$_ENV['APP_SERVICES_CACHE'] = $cache . '/services.php';
$_ENV['APP_PACKAGES_CACHE'] = $cache . '/packages.php';
$_ENV['APP_CONFIG_CACHE'] = $cache . '/config.php';
$_ENV['APP_ROUTES_CACHE'] = $cache . '/routes.php';
$_ENV['APP_EVENTS_CACHE'] = $cache . '/events.php';
putenv('LOG_CHANNEL=stderr');
$_ENV['LOG_CHANNEL'] = 'stderr';
require __DIR__ . '/../public/index.php';
