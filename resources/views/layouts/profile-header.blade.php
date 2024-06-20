<header class="bg-white shadow-md">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
        <div class="flex items-center">
            @if(auth()->user()->type == 'seller')
                <a href="{{ route('user.services') }}" class="text-gray-600 hover:text-indigo-600 mx-4">
                    Мои услуги
                </a>
            @elseif(auth()->user()->type == 'buyer')
                <a href="{{ route('user.projects') }}" class="text-gray-600 hover:text-indigo-600 mx-4">
                    Мои проекты
                </a>
            @endif
            <a href="{{ route('user.chat') }}" class="text-gray-600 hover:text-indigo-600 mx-4">Сообщения</a>
            <a href="{{ route('user.profile.settings') }}"
               class="text-gray-600 hover:text-indigo-600 mx-4">Настройки</a>
        </div>
    </nav>
</header>
