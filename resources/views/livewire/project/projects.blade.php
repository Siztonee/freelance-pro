<div class="bg-gray-100">
    <main class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Поиск проектов</h1>

        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/4 mb-6 md:mb-0 md:mr-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Фильтры</h2>

                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Категория</label>
                        <select id="category" wire:model.lazy="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Все</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if($skills != '' && !empty($skills))
                        <div id="skills-container" class="mb-4">
                            <h3 class="text-lg font-medium mb-2">Навыки</h3>
                            <div class="flex flex-wrap gap-2" id="skills-list">
                                @foreach($skills as $link)
                                    <a href="#" wire:click.prevent="searchBySkills('{{ $link }}')" class="bg-green-100 hover:bg-green-200 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                                        {{ $link }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif


                    @if($selectedSkills != '' && !empty($selectedSkills))
                        <div id="selected-skills-container" class="mb-4">
                            <h3 class="text-lg font-medium mb-2">Выбранные навыки</h3>
                            <div class="flex flex-wrap gap-2" id="selected-skills-list">
                                @foreach($selectedSkills as $selectedSkill)
                                    <a href="#" wire:click.prevent="deleteSkill('{{ $selectedSkill }}')" class="bg-blue-200 text-blue-800 text-sm font-medium px-3 py-1 rounded-full selected-skill">
                                        {{ $selectedSkill }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">Оплата</label>
                        <select id="budget" wire:model.lazy="pay" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
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

                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <div class="flex items-center">
                                        <img src="{{ asset('storage/profiles/'.basename($project['user']['profile_image'])) }}" alt="profile image" class="w-10 h-10 rounded-full mr-2">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-700">{{ $project['user']['username'] }}</p>
                                            <div class="flex items-center">
                                                @php
                                                    $rating = $project['user']['rating'];
                                                    $fullStars = floor($rating); // Целые звезды
                                                    $hasHalfStar = $rating - $fullStars >= 0.5; // Есть ли половина звезды

                                                    for ($i = 1; $i <= $fullStars; $i++) {
                                                        echo '<span class="text-yellow-500 mr-1">&#9733;</span>';
                                                    }

                                                    if ($hasHalfStar) {
                                                        echo '<span class="text-yellow-500 mr-1">&#9734;</span>';
                                                    }

                                                    for ($i = $fullStars + ($hasHalfStar ? 2 : 1); $i <= 5; $i++) {
                                                        echo '<span class="text-gray-400 mr-1">&#9734;</span>';
                                                    }
                                                @endphp

                                                <span class="text-gray-600 ml-2">({{ $project['user']['rating'] }}, {{ $project['user']['reviews_count'] }} отзывов)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $project['name'] }}</h3>
                                        <p class="text-gray-600">{{ Str::limit($project['description'], 255, '...') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-900 font-semibold">Оплата: {{ $project['pay'] ? $project['pay'].' сом'  : 'Договорная' }}</span>
                                <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Откликнуться</a>
                            </div>

                            <div class="flex flex-wrap gap-2 mb-2">
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $project['category_name'] }}</span>
                                @foreach(explode(',', $project['requirement_skills']) as $skill)
                                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </main>

</div>
