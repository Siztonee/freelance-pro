<div class="bg-gray-100">
    <main class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Сообщения</h1>

        <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Список чатов -->
            <div class="w-1/3 border-r border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <input type="text" placeholder="Поиск чата" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @foreach($users as $user)
                    <div wire:click.prevent="selectChat({{ $user['id'] }})" class="overflow-y-auto h-[calc(100vh-200px)]">
                        <div class="p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profiles/'.basename($user['profile_image'])) }}" alt="Пользователь" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $user['first_name'] .' '. $user['last_name'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


            <!-- Окно чата -->
            @if($is_opened)
                <div class="w-2/3 flex flex-col">
                <div class="p-4 border-b border-gray-200 flex items-center">
                    <img src="{{ asset('storage/profiles/'.basename($receiver['profile_image'])) }}" alt="Собеседник" class="w-10 h-10 rounded-full mr-3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $receiver['first_name'] .' '. $receiver['last_name'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $receiver['specialization'] }}</p>
                    </div>
                </div>

                    <div class="flex-grow overflow-y-auto p-4 space-y-4">
                        @forelse($messages as $message)
                            @if($message['sender_id'] == auth()->user()->id)
                                <div class="flex justify-end">
                                    <div class="bg-indigo-300 rounded-lg p-3 max-w-md">
                                        <p class="text-gray-800">{{ $message['message'] }}</p>
                                        @if($message['uploads'] && !empty($message['uploads']))
                                            <div class="mt-2 flex flex-col space-y-1">
                                                @foreach($message['uploads'] as $upload)
                                                    <div class="bg-indigo-200 rounded-md shadow-sm px-2 py-1 text-sm">
                                                        @if (in_array($upload['file_type'], ['image/jpeg', 'image/png', 'image/gif']))
                                                            <img src="{{ Storage::url($upload['file_path']) }}" alt="{{ $upload['file_name'] }}" style="max-width: 200px;">
                                                        @else
                                                            <a href="{{ Storage::url($upload['file_path']) }}">{{ $upload['file_name'] }} ({{ $upload['file_size'] }} кб)</a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <span class="text-gray-500 text-xs mt-1 block">14:30</span>
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-start">
                                    <div class="bg-gray-100 rounded-lg p-3 max-w-md">
                                        <p class="text-gray-800">{{ $message['message'] }}</p>
                                        @if($message['uploads'] && !empty($message['uploads']))
                                            <div class="mt-2 flex flex-col space-y-1">
                                                @foreach($message['uploads'] as $upload)
                                                    <div class="bg-white rounded-md shadow-sm px-2 py-1 text-sm">
                                                        @if (in_array($upload['file_type'], ['image/jpeg', 'image/png', 'image/gif']))
                                                            <img src="{{ Storage::url($upload['file_path']) }}" alt="{{ $upload['file_name'] }}" style="max-width: 200px;">
                                                        @else
                                                            <a href="{{ Storage::url($upload['file_path']) }}">{{ $upload['file_name'] }} ({{ $upload['file_size'] }} кб)</a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <span class="text-gray-500 text-xs mt-1 block">14:37</span>
                                    </div>
                                </div>
                            @endif
                        @empty
                            {{-- Здесь можно отобразить сообщение, если нет сообщений --}}
                        @endforelse
                    </div>

                <div class="p-4 border-t border-gray-200">
                    <form wire:submit.prevent="sendMessage" class="flex items-center" enctype="multipart/form-data">
                        <div id="preview-container" class="flex flex-col items-start mb-4"></div>
                        <label for="file-upload" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-l-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer px-4 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-45" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                            </svg>
                        </label>
                        <input id="file-upload" wire:model="files" type="file" class="hidden" multiple>
                        <input type="text" wire:model="message" placeholder="Введите сообщение..." class="ml-2 flex-grow px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-90" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endif


        </div>
        <script>
            const fileInput = document.getElementById('file-upload');

            fileInput.addEventListener('change', () => {
                const files = fileInput.files;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    console.log(`Файл ${file.name} загружен`);
                }
            });
        </script>
    </main>
</div>
