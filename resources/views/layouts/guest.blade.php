<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TaskFlow') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="auth-page">
        <div class="task-app auth-shell">
            <header class="app-header">
                <div class="container">
                    <nav class="navbar app-navbar px-0" aria-label="Main navigation">
                        <a class="brand-link" href="/" aria-label="TaskFlow home" wire:navigate>
                            <span class="brand-mark" aria-hidden="true">T</span>
                            <span>Task<span class="brand-accent">Flow</span></span>
                        </a>
                        @if (Route::has('register') && ! request()->routeIs('register'))
                            <a class="btn btn-sm btn-outline-primary header-action" href="{{ route('register') }}" wire:navigate>Register</a>
                        @elseif (Route::has('login') && ! request()->routeIs('login'))
                            <a class="btn btn-sm btn-outline-primary header-action" href="{{ route('login') }}" wire:navigate>Sign in</a>
                        @endif
                    </nav>
                </div>
            </header>

            <main class="container auth-content">
                <section class="auth-card" aria-labelledby="auth-heading">
                    <div class="auth-heading">
                        <p class="eyebrow mb-2">YOUR PERSONAL WORKSPACE</p>
                        @if (request()->routeIs('register'))
                            <h1 class="auth-title" id="auth-heading">Create your account</h1>
                            <p class="auth-copy">A calmer way to keep your next steps moving.</p>
                        @elseif (request()->routeIs('password.request'))
                            <h1 class="auth-title" id="auth-heading">Reset your password</h1>
                            <p class="auth-copy">We’ll help you get back to your workspace.</p>
                        @elseif (request()->routeIs('password.reset'))
                            <h1 class="auth-title" id="auth-heading">Choose a new password</h1>
                            <p class="auth-copy">Set a secure password for your account.</p>
                        @elseif (request()->routeIs('verification.notice'))
                            <h1 class="auth-title" id="auth-heading">Verify your email</h1>
                            <p class="auth-copy">One quick step before you get started.</p>
                        @elseif (request()->routeIs('password.confirm'))
                            <h1 class="auth-title" id="auth-heading">Confirm your password</h1>
                            <p class="auth-copy">Please confirm it’s you to continue.</p>
                        @else
                            <h1 class="auth-title" id="auth-heading">Welcome back</h1>
                            <p class="auth-copy">Sign in to pick up where you left off.</p>
                        @endif
                    </div>
                    {{ $slot }}
                </section>
                <footer class="auth-footer">Made for your next big thing.</footer>
            </main>
        </div>
        @livewireScripts
    </body>
</html>
