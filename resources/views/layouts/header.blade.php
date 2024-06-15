<header class="bg-white shadow-md">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
        <div class="text-2xl font-bold text-indigo-600">FreelancePro</div>
        <div class="flex items-center">
            <a href="#" class="text-gray-600 hover:text-indigo-600 mx-4">Найти проект</a>
            <a href="#" class="text-gray-600 hover:text-indigo-600 mx-4">Найти фрилансера</a>
            @if(auth()->user())
                <a href="{{ route('user.profile', auth()->user()->uuid) }}" class="hover:text-indigo-600 px-4 py-2">{{ auth()->user()->username }}</a>
            @else
                <a href="{{ route('user.auth') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Войти</a>
            @endif
        </div>
    </nav>
</header>
