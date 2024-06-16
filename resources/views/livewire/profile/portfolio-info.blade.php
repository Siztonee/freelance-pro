<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Заголовок проекта -->
        <h1 class="text-3xl font-bold mb-4">Название проекта</h1>

        <!-- Изображение проекта -->
        <img class="w-full h-auto rounded-lg shadow-lg mb-8" src="{{ asset('storage/portfolios/' . basename($portfolio->media)) }}" alt="Изображение проекта">

        <!-- Описание проекта -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Описание проекта</h2>
            <p class="text-gray-600 mb-4 w-full overflow-hidden overflow-ellipsis break-words">
                {{ $portfolio->description }}
            </p>
        </div>

        <!-- Детали проекта -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-2">Использованные технологии</h3>
                <ul class="list-disc list-inside text-gray-700">
                    @foreach(explode(',', $portfolio->skills) as $skill)
                        <li>{{ trim($skill) }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-2">Категория проекта</h3>
                <li class="text-gray-700">{{ $portfolio->category }}</li>
            </div>
        </div>

        <!-- Отзыв клиента -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Отзыв клиента</h2>
            <blockquote class="italic text-gray-700 mb-2">
                "Отличная работа! Фрилансер превзошел все наши ожидания и доставил проект в срок. Мы обязательно будем
                работать с ним снова."
            </blockquote>
            <p class="text-gray-600">— Имя клиента, Должность</p>
        </div>

        <!-- Кнопка возврата к портфолио -->
        <a href="{{ url()->previous() }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
            Вернуться назад
        </a>
    </div>
</div>
