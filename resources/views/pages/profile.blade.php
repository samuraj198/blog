@extends('layouts/main')
@include('modals/createNote')
@section('title', 'Profile')
@section('content')
    <h2 class="text-center font-bold text-2xl mb-10">Ваши записи</h2>
    <div class="buttons flex gap-5">
        <a onclick="openCreatePostModal()"><x-button text="Создать запись" /></a>
        <x-button text="Архив записей" />
    </div>
    <div class="posts mt-10 flex gap-5">
        @forelse($posts as $post)
            <div class="relative py-10 px-14 bg-black/30 rounded-xl
            hover:bg-purple-400 hover:text-white transition-all duration-300">
                @if($post->status == 2)
                    <p class="text-green-300 absolute top-1 left-3">Опубликовано</p>
                @elseif($post->status == 1)
                    <p class="text-red-500 absolute top-1 left-3">Черновик</p>
                @endif
                {{ $post->title }}
                <form action="">
                    <a class="absolute bottom-1 right-3 cursor-pointer hover:underline" type="submit">В архив</a>
                </form>
            </div>
        @empty
            <p class="text-red-500">У вас еще нет записей</p>
        @endforelse
    </div>
@endsection
