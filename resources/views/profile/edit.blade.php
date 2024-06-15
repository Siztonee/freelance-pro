@extends('layouts.app')

@section('content')
<div class="bg-gray-100">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="text-gray-600 hover:text-indigo-600 mx-4">Мои проекты</a>
                <a href="#" class="text-gray-600 hover:text-indigo-600 mx-4">Сообщения</a>
                <a href="#" class="text-gray-600 hover:text-indigo-600 mx-4">Настройки</a>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Редактирование профиля</h1>
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif
                <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="mb-6">
                        <label for="avatar" class="block text-gray-700 font-semibold mb-2">Аватар</label>
                        <div class="flex items-center">
                            <img src="{{ $user->profile_image ? asset('storage/profiles/' . basename($user->profile_image)) : asset('storage/profiles/default_profile.jpg') }}" alt="Текущий аватар" class="w-24 h-24 rounded-full mr-6">
                            <input type="file" id="profile" value="{{ $user->profile_image ? asset('storage/profiles/' . basename($user->profile_image)) : asset('storage/profiles/default_profile.jpg') }}" name="profile_image" class="border border-gray-300 p-2 rounded-lg">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-gray-700 font-semibold mb-2">Имя</label>
                            <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" class="w-full border border-gray-300 p-2 rounded-lg">
                        </div>
                        <div>
                            <label for="last_name" class="block text-gray-700 font-semibold mb-2">Фамилия</label>
                            <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" class="w-full border border-gray-300 p-2 rounded-lg">
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="profession" class="block text-gray-700 font-semibold mb-2">Специальность</label>
                        <input type="text" id="search_spec" name="specialization" value="{{ $user->specialization }}" class="w-full border border-gray-300 p-2 rounded-lg">
                        <ul id="results_spec" class="bg-white rounded shadow p-4 hidden cursor-pointer"></ul>
                    </div>
                    <div class="mt-6">
                        <label for="location" class="block text-gray-700 font-semibold mb-2">Местоположение</label>
                        <input type="text" id="location" name="location" value="{{ $user->location }}" class="w-full border border-gray-300 p-2 rounded-lg">
                        <ul id="results_location" class="bg-white rounded shadow p-4 hidden cursor-pointer"></ul>
                    </div>
                    <div class="mt-6">
                        <label for="about" class="block text-gray-700 font-semibold mb-2">Обо мне</label>
                        <textarea id="about" name="description" rows="4" class="w-full border border-gray-300 p-2 rounded-lg">{{ $user->description }}</textarea>
                    </div>

                    <div class="mt-6">
                        <label class="block text-gray-700 font-semibold mb-2">Навыки</label>
                        <div id="selectedSkills" class="flex flex-wrap cursor-pointer">
                            @forelse($skills as $skill)
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2 skill-tag" data-skill-name="{{ $skill }}">{{ $skill }}</span>
                            @empty
                                <span>Нет навыков</span>
                            @endforelse
                        </div>
                        <input type="hidden" id="selectedSkillsInput" name="skills" value="{{ implode(',', $skills) }}">
                        <input type="text" id="new_skill" name="new_skill" placeholder="Добавить новый навык" class="w-full border border-gray-300 p-2 rounded-lg mt-2" data-url="{{ route('search.skill') }}">
                        <div id="skillResults" class="hidden mt-2 cursor-pointer"></div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<div id="getSkill_url" data-url="{{ route('search.skill') }}"></div>
<div id="getSpec_url" data-url="{{ route('search.spec') }}"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

<script src="{{ asset('js/search.js') }}"></script>

@endsection
