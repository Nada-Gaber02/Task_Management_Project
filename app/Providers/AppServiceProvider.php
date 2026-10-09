<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (! class_exists(\Livewire\Mechanisms\ComponentRegistry::class, false)) {
            class_alias(\App\Compat\Livewire\ComponentRegistry::class, \Livewire\Mechanisms\ComponentRegistry::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
