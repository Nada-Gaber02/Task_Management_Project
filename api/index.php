
<?php

header('Content-Type: text/plain');

echo "PHP runtime is working\n";
echo "PHP version: " . PHP_VERSION . "\n";
echo "Project root: " . dirname(__DIR__) . "\n";

$root = dirname(__DIR__);

echo "Autoload exists: ";
var_export(file_exists($root . '/vendor/autoload.php'));

echo "\nBootstrap exists: ";
var_export(file_exists($root . '/bootstrap/app.php'));

echo "\n";
