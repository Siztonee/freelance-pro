<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Портфолио работ</h1>

    <!-- Фильтры и сортировка -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-4">
            <select class="bg-white border border-gray-300 rounded-md px-4 py-2">
                <option>Все категории</option>
                <option>Веб-дизайн</option>
                <option>Разработка</option>
                <option>Мобильные приложения</option>
            </select>
            <select class="bg-white border border-gray-300 rounded-md px-4 py-2">
                <option>Сортировка: Новые</option>
                <option>Сортировка: Старые</option>
                <option>Сортировка: А-Я</option>
            </select>
        </div>
    </div>

    <!-- Галерея работ -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($portfolios as $portfolio)
            <a href="{{ route('user.portfolio.info', [$user->uuid, $portfolio->id]) }}" class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 transform group-hover:scale-105">
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/portfolios/' . basename($portfolio->media)) }}" alt="Проект 1">
                    <div class="p-4">
                        <h3 class="font-semibold mb-2 group-hover:text-blue-600">{{ $portfolio->name }}</h3>
                        <p class="text-gray-600 text-sm">
                            {{ Str::limit($portfolio->description, 55, '...') }}
                        </p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span class="text-xs bg-gray-200 rounded-full px-2 py-1">{{ $portfolio->category }}</span>
                            @foreach(explode(',', $portfolio->skills) as $skill)
                                <span class="text-xs bg-gray-200 rounded-full px-2 py-1">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <span>None</span>
        @endforelse

    </div>

    <!-- Пагинация -->
    <div class="mt-12 flex justify-center">
        <nav class="inline-flex rounded-md shadow">
                {{ $portfolios->links() }}
        </nav>
    </div>
</div>
