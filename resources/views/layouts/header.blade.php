<header class="bg-white shadow-md">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
        <div class="text-2xl font-bold text-indigo-600">FreelancePro</div>
        <div class="flex items-center">
            <a href="{{ route('projects') }}" class="text-gray-600 hover:text-indigo-600 mx-4">Найти проект</a>
            <a href="{{ route('freelancers') }}" class="text-gray-600 hover:text-indigo-600 mx-4">Найти фрилансера</a>
            @if(auth()->user())
                <a href="{{ route('user.profile', auth()->user()->uuid) }}" class="hover:text-indigo-600 px-4 py-2">{{ auth()->user()->username }}</a>
            @else
                <a href="{{ route('user.auth') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Войти</a>
            @endif
        </div>
    </nav>

    @if(auth()->user()->is_activated == 0 && auth()->user()->type == 'seller')
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
            <p class="font-bold">Внимание!</p>
            <p>Активируйте аккаунт что бы получать заказы и доступ к определённым функциям. Профиль->Настройки->Активировать аккаунт</p>
        </div>
    @elseif(auth()->user()->is_activated == 0 && auth()->user()->type == 'buyer')
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
            <p class="font-bold">Внимание!</p>
            <p>Активируйте аккаунт что бы заказывать и получить доступ к определённым функциям. Профиль->Настройки->Активировать аккаунт</p>
        </div>
    @endif

</header>
