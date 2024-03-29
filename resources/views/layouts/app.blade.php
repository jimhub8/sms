<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="/logo/logo.png">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    {{-- <div class="min-h-screen bg-gray-100" id="app">
        @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
    </div>
    </header> --}}

    <!-- Page Content -->

    <main class="py-4" id="app">
        {{-- {{ $slot }} --}}
        @yield('content')
    </main>
    </div>

    {{-- @stack('modals') --}}

    {{-- @livewireScripts --}}
</body>

</html>
