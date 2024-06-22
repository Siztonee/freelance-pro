<div class="bg-gray-100 min-h-screen">
    <main class="container mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6">Сообщения</h1>

        <div class="flex flex-col sm:flex-row bg-white shadow-md rounded-lg overflow-hidden h-[calc(100vh-10rem)]">
            <!-- Список чатов -->
            <div class="w-full sm:w-1/3 border-b sm:border-r border-gray-200">
                <div class="p-4 border-b border-gray-200">
                    <input type="text" placeholder="Поиск чата" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="overflow-y-auto h-[calc(100vh-16rem)]">
                    @foreach($users as $user)
                        <div wire:click.prevent="selectChat({{ $user['id'] }})" class="{{ $user['id'] == $receiver_id ? 'bg-gray-200' : '' }} p-4 border-b border-gray-200 hover:bg-gray-200 cursor-pointer">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/profiles/'.basename($user['profile_image'])) }}" alt="Пользователь" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $user['first_name'] .' '. $user['last_name'] }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Окно чата -->
            @if($is_opened)
                <div class="w-full sm:w-2/3 flex flex-col">
                    <div class="p-4 border-b border-gray-200 flex items-center">
                        <img src="{{ asset('storage/profiles/'.basename($receiver['profile_image'])) }}" alt="Собеседник" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $receiver['first_name'] .' '. $receiver['last_name'] }}</h3>
                            <p class="text-gray-600 text-sm">{{ $receiver['specialization'] }}</p>
                        </div>
                    </div>

                    <div class="flex-grow overflow-y-auto p-4 space-y-4 custom-scrollbar">
                        @forelse($messages as $message)
                            <div class="flex {{ $message['sender_id'] == auth()->user()->id ? 'justify-end' : 'justify-start' }}">
                                <div class="{{ $message['sender_id'] == auth()->user()->id ? 'bg-indigo-300' : 'bg-gray-100' }} rounded-lg p-3 max-w-xs sm:max-w-md">
                                    <p class="text-gray-800">{{ $message['message'] }}</p>
                                    @if($message['uploads'] && !empty($message['uploads']))
                                        <div class="mt-2 flex flex-col space-y-1">
                                            @foreach($message['uploads'] as $upload)
                                                <div class="{{ $message['sender_id'] == auth()->user()->id ? 'bg-indigo-200' : 'bg-white' }} rounded-md shadow-sm px-2 py-1 text-sm">
                                                    @if (in_array($upload['file_type'], ['jpeg', 'png', 'gif', 'img', 'jpg']))
                                                        <img src="{{ Storage::url($upload['file_path']) }}" alt="{{ $upload['file_name'] }}" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 h-auto">                                                    @else
                                                        <a href="{{ Storage::url($upload['file_path']) }}" class="break-all">{{ $upload['file_name'] }} ({{ $upload['file_size'] }} кб)</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @php
                                        $createdAt = \Carbon\Carbon::parse($message['created_at']);
                                        $formattedDate = $createdAt->isToday()
                                            ? $createdAt->format('H:i')
                                            : $createdAt->format('d.m.Y H:i');
                                    @endphp
                                    <span class="text-gray-500 text-xs mt-1 block">
                                        {{ $formattedDate }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">Нет сообщений</p>
                        @endforelse
                    </div>

                    <div>
                        <div wire:loading wire:target="files" class="ml-2 text-white bg-indigo-600 p-2 rounded text-center mb-4">
                            Загрузка...
                        </div>

                        @if($files)
                            <ul class="ml-3 list-none p-0">
                                @foreach($files as $file)
                                    <li class="flex items-center mb-4 border border-gray-400 p-3">
                                        @if($file->getClientOriginalExtension() === 'php')
                                            <div class="text-sm text-gray-700">
                                                <strong>{{ $file->getClientOriginalName() }}</strong> ({{ number_format($file->getSize() / 1024, 2) }} KB)
                                            </div>
                                        @elseif(str_contains($file->getMimeType(), 'image'))
                                            <div class="text-sm text-gray-700 flex items-center">
                                                <img src="{{ $file->temporaryUrl() }}" alt="{{ $file->getClientOriginalName() }}" class="w-10 h-10 mr-4 rounded">
                                                <strong class="break-all">{{ $file->getClientOriginalName() }}</strong> ({{ number_format($file->getSize() / 1024, 2) }} KB)
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-700">
                                                <strong class="break-all">{{ $file->getClientOriginalName() }}</strong> ({{ number_format($file->getSize() / 1024, 2) }} KB)
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="p-4 border-t border-gray-200">
                        <form wire:submit.prevent="sendMessage" class="flex flex-col sm:flex-row items-center" enctype="multipart/form-data">
                            <div id="preview-container" class="flex flex-col items-start mb-4 w-full"></div>
                            <div class="flex w-full">
                                <label for="file-upload" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-l-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-45" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                    </svg>
                                </label>
                                <input id="file-upload" wire:model="files" type="file" class="hidden" multiple>
                                <input type="text" wire:model="message" placeholder="Введите сообщение..." class="flex-grow px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-90" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="w-full sm:w-2/3 flex items-center justify-center">
                    <p class="text-gray-500">Выберите чат, чтобы начать общение</p>
                </div>
            @endif
        </div>

        <script>
            window.addEventListener('scrollToBottom', event => {
                setTimeout(() => {
                    const chatContainer = document.querySelector('.custom-scrollbar');
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }, 100);  // задержка в 100 миллисекунд
            });
        </script>

    </main>
</div>
