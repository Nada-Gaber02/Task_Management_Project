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
        <body>
            <div class="task-app">
                <livewire:layout.navigation />

                <main class="container app-content">
                    @if (isset($header))
                        <header class="welcome-section mb-4">
                            <div>{{ $header }}</div>
                        </header>
                    @endif
                    {{ $slot }}
                </main>
            </div>
            @livewireScripts
        </body>
    </html>
