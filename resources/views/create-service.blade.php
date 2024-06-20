@extends('layouts.app')

@section('content')
    <div class="bg-gray-100">
        <main class="container mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Создание новой услуги</h1>

            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Успешно!</strong>
                    <span class="block sm:inline">Услуга успешно создана.</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zM5.7 8.587L7.173 10 9.75 7.413 12.33 10 14.913 7.413 17.5 10 19.087 8.587 16.413 6 14.827 8.587 12.24 6 9.657 8.587 7.173 10 5.7 8.587z"/></svg>
                    </span>
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg p-6">
                <form method="post" action="{{ route('user.services.store') }}">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <p>{{ $errors->first() }}</p>
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Название услуги</label>
                        <input value="{{ old('name') }}" type="text" id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Описание услуги</label>
                        <textarea id="description" name="description" rows="5" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        {{ old('description') }}
                    </textarea>
                    </div>

                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Категория</label>
                        <select id="category" name="category" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-6">
                        <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">Цена (в сомах)</label>
                        <div id="paymentField" class="relative">
                            <input value="{{ old('pay') }}" type="number" id="budget" name="pay" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <div id="negotiableText" class="absolute inset-y-0 right-0 flex items-center pr-3" style="display: none;">
                                <span class="text-sm font-medium text-gray-500">Договорная</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" id="negotiable" name="payType" value="Договорная" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500" onchange="togglePaymentField()">
                            <label for="negotiable" class="ml-2 block text-sm font-medium text-gray-700">Договорная</label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">Срок выполнения (дней)</label>
                        <input value="{{ old('deadline') ? old('deadline') : 1 }}" type="number" id="deadline" name="deadline" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Навыки</label>
                        <div id="selectedSkills" class="flex flex-wrap cursor-pointer">

                        </div>
                        <input type="hidden" id="selectedSkillsInput" name="skills" value="">
                        <input type="text" id="new_skill" name="new_skill" class="w-full border border-gray-300 p-2 rounded-lg mt-2" data-url="{{ route('search.skill') }}">
                        <div id="skillResults" class="hidden mt-2 cursor-pointer"></div>
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Опубликовать предложение
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <div id="getSkill_url" data-url="{{ route('search.skill') }}"></div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="{{ asset('js/search.js') }}"></script>
        <script src="{{ asset('js/create-project.js') }}"></script>

    </div>
@endsection
