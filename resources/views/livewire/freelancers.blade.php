<div class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Поиск фрилансеров</h1>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <!-- Категории -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Категории</h2>

            <!-- Специальности -->
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 freelancer-results">
            <!-- Карточка фрилансера (повторить для каждого фрилансера) -->
            @foreach($freelancers as $freelancer)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <a href="{{ route('user.profile', $freelancer->uuid) }}">
                        <img src="{{ asset('storage/profiles/' . basename($freelancer->profile_image)) }}" alt="Фото профиля" class="w-24 h-24 rounded-full mx-auto mb-4">
                        <h2 class="text-xl font-semibold text-center">{{ $freelancer->first_name .' '. $freelancer->last_name }}</h2>
                    </a>
                    <p class="text-gray-600 text-center">{{ $freelancer->specialization }}</p>
                    <div class="flex items-center justify-center mb-6">
                        @php
                            $rating = $freelancer->rating;
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

                        <span class="text-gray-600 ml-2">({{ $freelancer->rating }}, {{ $freelancer->reviews_count }} отзывов)</span>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        @php
                            $skills = explode(',', $freelancer->skills);
                            $displayedSkills = array_slice($skills, 0, 3);
                        @endphp

                        @foreach ($displayedSkills as $skill)
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">{{ $skill }}</span>
                        @endforeach

                        @if (count($skills) > 3)
                            <span class="bg-gray-100 text-gray-600 text-sm font-medium px-2.5 py-0.5 rounded">+ {{ count($skills) - 3 }} more</span>
                        @endif
                    </div>
                    <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Связаться
                    </button>
                </div>
        @endforeach
        <!-- Конец карточки фрилансера -->
        </div>
    </main>

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
{{--    <script src="{{ asset('js/freelancers.js') }}"></script>--}}

</div>
