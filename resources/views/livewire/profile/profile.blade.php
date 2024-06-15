<div class="bg-gray-100">
<header class="bg-white shadow-md">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
        <div class="flex items-center">
            <a href="#" class="text-gray-600 hover:text-indigo-600 mx-4">Мои проекты</a>
            <a href="#" class="text-gray-600 hover:text-indigo-600 mx-4">Сообщения</a>
            <a href="{{ route('user.profile.edit') }}" class="text-gray-600 hover:text-indigo-600 mx-4">Настройки</a>
        </div>
    </nav>
</header>

<main class="container mx-auto px-6 py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex items-center">
                <img src="https://via.placeholder.com/150" alt="Аватар пользователя" class="w-24 h-24 rounded-full mr-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $user->first_name .' '. $user->last_name}}</h1>
                    <p class="text-gray-600">Веб-разработчик | Москва, Россия</p>
                    <div class="flex items-center mt-2">
                        <span class="text-yellow-500 mr-1">&#9733;</span>
                        <span class="text-yellow-500 mr-1">&#9733;</span>
                        <span class="text-yellow-500 mr-1">&#9733;</span>
                        <span class="text-yellow-500 mr-1">&#9733;</span>
                        <span class="text-gray-400">&#9733;</span>
                        <span class="text-gray-600 ml-2">(4.8, 120 отзывов)</span>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Обо мне</h2>
                <p class="text-gray-600">
                    Я опытный веб-разработчик с более чем 5-летним стажем работы. Специализируюсь на создании
                    современных и адаптивных веб-приложений с использованием новейших технологий. Мой подход
                    ориентирован на клиента, и я стремлюсь превзойти ожидания в каждом проекте.
                </p>
            </div>
        </div>

        <div class="border-t border-gray-200 p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Навыки</h2>
            <div class="flex flex-wrap">
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2">HTML</span>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2">CSS</span>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2">JavaScript</span>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2">React</span>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2">Node.js</span>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2">PHP</span>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold mr-2 mb-2">Laravel</span>
            </div>
        </div>

        <div class="border-t border-gray-200 p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Портфолио</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-100 rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x200" alt="Проект 1" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">Проект 1</h3>
                        <p class="text-gray-600">Краткое описание проекта 1</p>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x200" alt="Проект 2" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">Проект 2</h3>
                        <p class="text-gray-600">Краткое описание проекта 2</p>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg overflow-hidden">
                    <img src="https://via.placeholder.com/300x200" alt="Проект 3" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">Проект 3</h3>
                        <p class="text-gray-600">Краткое описание проекта 3</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Отзывы</h2>
            <div class="space-y-6">
                <div class="flex">
                    <img src="https://via.placeholder.com/50" alt="Клиент 1" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Анна Петрова</h3>
                        <div class="flex items-center mb-2">
                            <span class="text-yellow-500 mr-1">&#9733;</span>
                            <span class="text-yellow-500 mr-1">&#9733;</span>
                            <span class="text-yellow-500 mr-1">&#9733;</span>
                            <span class="text-yellow-500 mr-1">&#9733;</span>
                            <span class="text-yellow-500">&#9733;</span>
                        </div>
                        <p class="text-gray-600">Отличный специалист! Иван выполнил работу быстро и качественно. Буду обращаться снова.</p>
                    </div>
                </div>
                <div class="flex">
                    <img src="https://via.placeholder.com/50" alt="Клиент 2" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Сергей Сидоров</h3>
                        <div class="flex items-center mb-2">
                            <span class="text-yellow-500 mr-1">&#9733;</span>
                            <span class="text-yellow-500 mr-1">&#9733;</span>
                            <span class="text-yellow-500 mr-1">&#9733;</span>
                            <span class="text-yellow-500 mr-1">&#9733;</span>
                            <span class="text-gray-400">&#9733;</span>
                        </div>
                        <p class="text-gray-600">Профессионал своего дела. Иван помог решить сложную задачу в короткие сроки.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>

