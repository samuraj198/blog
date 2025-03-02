<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title> @yield('title')</title>
    <style>
        .dropdown-menu {
            display: none;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body class="">
    <header class="flex justify-between p-10">
        <a href="{{ route('index') }}" class="font-bold text-xl">Work</a>
        <div class="buttons flex items-center justify-center gap-5">
            @if(auth()->user())
                <div class="dropdown relative">
                    <p class="cursor-pointer font-bold text-xl">{{ auth()->user()->username }}</p>
                    <div class="dropdown-menu absolute right-0 mt-0 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Профиль</a>
                        <form action="{{ route('auth') }}" method="POST" class="block">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Выход</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('auth') }}"><x-button text="Вход" /></a>
                <a href="{{ route('register') }}"><x-button text="Регистрация" /></a>
            @endif

        </div>
    </header>
    <main class="flex flex-col items-center">
        @yield('content')
    </main>
</body>
<script>
    function openCreatePostModal() {
        document.querySelector('.createPost').classList.remove('hidden');
    }
    function closeCreatePostModal() {
        document.querySelector('.createPost').classList.add('hidden');
    }
</script>
</html>
