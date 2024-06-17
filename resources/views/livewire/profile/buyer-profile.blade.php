<div class="bg-gray-100">

    @if($user->id == auth()->user()->id)
        @include('layouts.profile-header')
    @endif

    <main class="container mx-auto px-6 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center">
                    <img src="{{ asset('storage/profiles/' . basename($user->profile_image)) }}" alt="Аватар пользователя" class="w-24 h-24 rounded-full mr-6">
                    <div>
                        <div class="flex items-end">
                            <h1 class="text-3xl font-bold text-gray-800">{{ $user->first_name .' '. $user->last_name}}</h1>
                            <span class="px-2">
                                Покупатель
                            </span>
                        </div>
                        <p class="text-gray-600">
                            {{ $user->specialization ? $user->specialization : 'Не указано' }}
                            |
                            {{ $user->location ? $user->location : 'Не указано' }}
                        </p>
                        <div class="flex items-center mt-2">
                            @php
                                $rating = $user->rating;
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

                            <span class="text-gray-600 ml-2">({{ $user->rating }}, {{ $user->reviews_count }} отзывов)</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Обо мне</h2>
                    <p class="text-gray-600">
                        {{ $user->description ? $user->description : 'Не указано' }}
                    </p>
                </div>

                <div class="border-t border-gray-200 p-6 my-10">
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
        </div>
    </main>
</div>

