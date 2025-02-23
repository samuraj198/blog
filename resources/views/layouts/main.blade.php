<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title> @yield('title')</title>
</head>
<body class="">
    <header class="flex justify-between p-10">
        <a href="{{ route('index') }}" class="font-bold text-xl">Work</a>
        <div class="buttons flex items-center justify-center gap-5">
            @if(auth()->user())
                <p>{{ auth()->user()->username }}</p>
                <form action="{{ route('auth') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a type="submit"><x-button text="Выход" /></a>
                </form>
            @else
                <a href="{{ route('auth') }}"><x-button text="Вход" /></a>
                <a href="{{ route('register') }}"><x-button text="Регистрация" /></a>
            @endif

        </div>
    </header>
    @yield('content')
</body>
</html>
