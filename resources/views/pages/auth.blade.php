@vite('resources/css/app.css')
<a href="{{ route('index') }}" class="absolute left-10 top-5 text-black/50 text-2xl dark:text-white/50">Назад</a>
<form action="{{ route('login') }}" method="POST" class="flex flex-col gap-5 items-center mt-10 dark:text-white">
    @csrf
    <h2 class="text-center font-bold text-3xl">Вход</h2>
    <input required name="email" type="email" placeholder="Email"
           class="px-3 py-2 border-black border-[1px] rounded-lg w-[20%] dark:border-white dark:bg-black">
    <input required name="password" type="password" placeholder="Password"
           class="px-3 py-2 border-black border-[1px] rounded-lg w-[20%] dark:border-white dark:bg-black">
    <a type="submit"><x-button text="Войти" /></a>
    <p>Нет аккаунта?
        <a class="text-purple-400 hover:underline transition-all duration-300" href="{{ route('register') }}">
            Регистрация
        </a>
    </p>
</form>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li class="text-center text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
@endif
<script>
    const htmlElement = document.documentElement;

    if (localStorage.getItem('theme') === 'dark') {
        htmlElement.classList.add('dark');
        htmlElement.style.backgroundColor = 'black';
    }
</script>
