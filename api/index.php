<?php

// 1. Prepare temporary writable directories for Vercel
$storageDirs = [
    '/tmp/storage/app',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Set environment variables for storage override
putenv('APP_STORAGE=/tmp/storage');
$_ENV['APP_STORAGE'] = '/tmp/storage';

// 3. Forward to public index
require __DIR__ . '/../public/index.php';
