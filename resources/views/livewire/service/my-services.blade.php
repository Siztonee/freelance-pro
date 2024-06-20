<div class="bg-gray-100">
    <main class="container mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Мои услуги</h2>
                <div class="h-1 w-20 bg-blue-500 rounded"></div>
            </div>

            <a href="{{ route('user.services.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md flex items-center transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Создать услугу
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-semibold mb-2">Категория</label>
                <select id="category" wire:model.lazy="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Все</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Статус</label>
                <div class="flex space-x-4">
                    <div class="flex items-center">
                        <input type="radio" id="status-active" name="status" wire:model.lazy="status" value="active" class="form-radio h-4 w-4 text-blue-600">
                        <label for="status-active" class="ml-2 text-gray-700">Активен</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="status-pending" name="status" wire:model.lazy="status" value="pending" class="form-radio h-4 w-4 text-blue-600">
                        <label for="status-pending" class="ml-2 text-gray-700">Ожидается</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="status-completed" name="status" wire:model.lazy="status" value="completed" class="form-radio h-4 w-4 text-blue-600">
                        <label for="status-completed" class="ml-2 text-gray-700">Закончен</label>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-12 w-full space-y-6">

            <!-- Пример карточки проекта -->
            @forelse($services as $service)
                @php
                    $category = \App\Models\Category::find($service['category_id']);
                @endphp
                <div class="rounded-lg shadow-md p-6 flex flex-col justify-between
                            bg-white
                            ">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2 break-words">{{ $service['name'] }}</h3>
                        <p class="text-gray-600 mb-4 break-words">{{ Str::limit($service['description'], 150, '...') }}</p>

                        <!-- Категория теперь с отступом внизу 4px -->
                        <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mb-1">
                            {{ $category->name ?? 'Без категории' }}
                        </span>
                    </div>

                    <!-- Блок с Бюджетом и Подробнее -->
                    <div class="mt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Оплата: {{ $service['pay'] ? $service['pay'].' сом' : 'Договорная' }}</span>
                            <div>
                                @foreach(explode(',', $service['skills']) as $skill)
                                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        @empty
        @endforelse
        <!-- Повторите этот блок для других проектов -->

        </div>
    </main>
</div>
