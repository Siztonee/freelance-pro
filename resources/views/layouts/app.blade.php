<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('app_name') }} @yield('title')</title>
        @stack('links')

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-gray-100">

        @include('layouts.header')

        <main class="container mx-auto px-6 py-8">
            @yield('content')
        </main>

        @include('layouts.footer')


    </body>
</html>
