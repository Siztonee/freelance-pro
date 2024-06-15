<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация | FreelancePro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">С возвращением в FreelancePro</h2>

        <div class="flex mb-6">
            <button id="loginTab" class="flex-1 py-2 px-4 text-center bg-indigo-600 text-white rounded-tl-md rounded-bl-md focus:outline-none">Вход</button>
            <a href="{{ route('user.register') }}" id="registerTab" class="flex-1 py-2 px-4 text-center bg-gray-200 text-gray-700 rounded-tr-md rounded-br-md focus:outline-none">Регистрация</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <form action="{{ route('login') }}" method="post" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Войти</button>
            </div>
        </form>


        <div class="mt-6 text-center">
            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Забыли пароль?</a>
        </div>
    </div>
</div>
</body>
</html>
