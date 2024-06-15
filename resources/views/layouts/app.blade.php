<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        @stack('links')
    </head>
    <body class="bg-gray-100">

        @include('layouts.header')

        <main class="container mx-auto px-6 py-8">
            @yield('content')
        </main>

        @include('layouts.footer')

    </body>
</html>
