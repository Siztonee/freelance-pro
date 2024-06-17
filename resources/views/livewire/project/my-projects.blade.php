<div class="bg-gray-100">
    <main class="container mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Мои проекты</h2>
                <div class="h-1 w-20 bg-blue-500 rounded"></div>
            </div>

            <a href="{{ route('user.projects.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md flex items-center transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Создать проект
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form>
                <div class="mb-4">
                    <label for="category" class="block text-gray-700 font-semibold mb-2">Категория</label>
                    <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="web">Веб-разработка</option>
                        <option value="design">Дизайн</option>
                        <option value="writing">Копирайтинг</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Статус</label>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <input type="radio" id="status-active" name="status" value="active" class="form-radio h-4 w-4 text-blue-600">
                            <label for="status-active" class="ml-2 text-gray-700">Ожидается</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="status-completed" name="status" value="completed" class="form-radio h-4 w-4 text-blue-600">
                            <label for="status-completed" class="ml-2 text-gray-700">Закончен</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">Найти проекты</button>
            </form>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Пример карточки проекта -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Разработка лендинга</h3>
                <p class="text-gray-600 mb-4">Требуется разработать одностраничный сайт для нового продукта.</p>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">Бюджет: 20000 ₽</span>
                    <a href="#" class="text-blue-500 hover:text-blue-600">Подробнее</a>
                </div>
            </div>
            <!-- Повторите этот блок для других проектов -->
        </div>
    </main>
</div>
