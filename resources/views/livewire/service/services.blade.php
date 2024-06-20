<div class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Поиск услуг</h1>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- Категории -->
        <div class="mb-8">

            <!-- Специальности -->
            <div class="bg-white shadow-md py-4 px-4">
                <h2 class="text-xl font-semibold mb-4">Категории</h2>
                <div class="mb-4">
                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $category)
                        <a href="#" wire:click.prevent="selectCategory({{ $category->id }})" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium px-3 py-1 rounded-full specialization-link">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            @if($skill_links != '' && !empty($skill_links))
                <div id="skills-container" class="mb-4">
                    <h3 class="text-lg font-medium mb-2">Навыки</h3>
                    <div class="flex flex-wrap gap-2" id="skills-list">
                        @foreach($skill_links as $link)
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
            </div>

        </div>

        <div class="w-full">
            <div class="space-y-6">
                <!-- Карточка фрилансера (повторить для каждого фрилансера) -->
                @foreach($services as $service)
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/profiles/'.basename($service->user->profile_image)) }}" alt="profile image" class="w-10 h-10 rounded-full mr-2">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">{{ $service->user->username }}</p>
                                        <div class="flex items-center">
                                            @php
                                                $rating = $service->user->rating;
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

                                            <span class="text-gray-600 ml-2">({{ $service->user->rating }}, {{ $service->user->reviews_count }} отзывов)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $service['name'] }}</h3>
                                    <p class="text-gray-600">{{ Str::limit($service['description'], 255, '...') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-900 font-semibold">Оплата: {{ $service['pay'] ? $service['pay'].' сом'  : 'Договорная' }}</span>
                            <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Откликнуться</a>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-2">
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $service->category->name }}</span>
                            @foreach(explode(',', $service['skills']) as $skill)
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
            @endforeach
            <!-- Конец карточки фрилансера -->
            </div>
        </div>
    </div>

</div>
</div>
