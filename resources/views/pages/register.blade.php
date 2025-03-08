@vite('resources/css/app.css')
<a href="{{ route('index') }}" class="absolute left-10 top-5 text-black/50 text-2xl">Назад</a>
<form action="{{ route('register') }}" method="POST" class="flex flex-col gap-5 items-center mt-10">
    @csrf
    <h2 class="text-center font-bold text-3xl">Регистрация</h2>
    <input required name="username" type="text" placeholder="Username"
           class="px-3 py-2 border-black border-[1px] rounded-lg w-[20%]">
    <input required name="email" type="email" placeholder="Email"
           class="px-3 py-2 border-black border-[1px] rounded-lg w-[20%]">
    <input required name="profile" type="text" placeholder="Profile information"
           class="px-3 py-2 border-black border-[1px] rounded-lg w-[20%]">
    <input required name="password" type="password" placeholder="Password"
           class="px-3 py-2 border-black border-[1px] rounded-lg w-[20%]">
    <input required name="password_confirmation" type="password" placeholder="Confirmation"
           class="px-3 py-2 border-black border-[1px] rounded-lg w-[20%]">
    <a type="submit"><x-button text="Зарегистрироваться" /></a>
    <p>Уже есть аккаунт? <a class="text-purple-400 hover:underline transition-all duration-300" href="{{ route('login') }}">Вход</a></p>
</form>
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li class="text-center text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
@endif
