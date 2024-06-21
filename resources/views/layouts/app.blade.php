<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="robots" content="noindex">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Админка | Паритет</title>

        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if(config('custom.dev'))
            @vite(['resources/scss/admin/app.scss', 'resources/js/admin/app.js'])
        @else
            {{ Vite::useHotFile(storage_path('admin.hot'))
                ->useBuildDirectory('build/admin')
                ->withEntryPoints(['resources/scss/admin/app.scss', 'resources/js/admin/app.js']) }}
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('admin.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="main max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="py-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
