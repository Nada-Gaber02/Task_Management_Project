<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
{
    $this->reportable(function (Throwable $e) {
        error_log(
            'LARAVEL_ERROR: ' . get_class($e)
            . ' | ' . $e->getMessage()
            . ' | ' . $e->getFile()
            . ':' . $e->getLine()
        );
    });
}
}
