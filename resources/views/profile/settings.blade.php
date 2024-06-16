@extends('layouts.app')


@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white rounded-lg shadow-xl p-8 m-4 w-full max-w-md my-[50px]">
            <h1 class="text-2xl font-bold mb-8 text-center">Настройки</h1>

            <div class="space-y-4">
                <!-- Кнопка редактирования профиля -->
                <a href="{{ route('user.profile.edit') }}" class="block w-full bg-indigo-600 text-white text-center py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        @if(auth()->user()->is_activated == 1)
                            Редактировать профиль
                        @else
                            Активировать аккаунт
                        @endif
                    </div>
                </a>

                @if(auth()->user()->is_activated == 1)
                    <!-- Кнопка добавления портфолио -->
                    <a href="{{ route('user.portfolio.add') }}" class="block w-full bg-indigo-600 text-white text-center py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Добавить портфолио
                        </div>
                    </a>
                @endif

                <!-- Кнопка выхода -->
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 text-white text-center py-3 px-4 rounded-lg hover:bg-red-700 transition duration-300">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Выход
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
