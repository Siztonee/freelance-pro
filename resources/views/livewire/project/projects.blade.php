<div class="bg-gray-100">
    <main class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Поиск проектов</h1>

        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/4 mb-6 md:mb-0 md:mr-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Фильтры</h2>

                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Категория</label>
                        <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Требуемые навыки</label>
                        <div id="selectedSkills" class="flex flex-wrap cursor-pointer">

                        </div>
                        <input type="hidden" id="selectedSkillsInput" name="requirement_skills" value="">
                        <input type="text" id="new_skill" name="new_skill" class="w-full border border-gray-300 p-2 rounded-lg mt-2" data-url="{{ route('search.skill') }}">
                        <div id="skillResults" class="hidden mt-2 cursor-pointer"></div>
                    </div>

                    <div class="mb-4">
                        <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">Оплата</label>
                        <select id="budget" wire:model="pay" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Все</option>
                            <option value="0-1000">До 1000 с</option>
                            <option value="1000-5000">1000 с - 5000 с</option>
                            <option value="5000-10000">5000 с - 10000 с</option>
                            <option value="10000+">Более 10000 с</option>
                        </select>
                    </div>

                </div>

            </div>

            <div class="w-full md:w-3/4">
                <div class="space-y-6">

                    @foreach($projects as $project)
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $project['name'] }}</h3>
                            <p class="text-gray-600 mb-2">{{ Str::limit($project['description'], 255, '...') }}</p>
                            <div class="flex items-center justify-between mb-2">
                                    <span class="text-gray-900 font-semibold">Оплата: {{ $project['pay'] ? $project['pay'].' сом'  : 'Договорная' }}</span>
                                    <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Откликнуться</a>
                            </div>
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $project['category_name'] }}</span>
                            @foreach(explode(',', $project['requirement_skills']) as $skill)
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </main>

    <div id="getSkill_url" data-url="{{ route('search.skill') }}"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="{{ asset('js/search.js') }}"></script>

</div>
