@extends('layouts/main')
@include('modals/createNote')
@section('title', 'Profile')
@section('content')
    <h2 class="text-center font-bold text-2xl mb-10">Ваши записи</h2>
    <div class="buttons flex gap-5">
        <a onclick="openCreatePostModal()"><x-button text="Создать запись" /></a>
    </div>
    <div class="posts mt-10 flex gap-5">
        @forelse($posts as $post)
            <a href="{{ route('showPost', ['id' => $post->id]) }}" class="relative py-10 px-20 border-2 border-purple-400 rounded-xl
            hover:bg-purple-400 hover:text-white transition-all duration-300">
                @if($post->status == 2)
                    <p class="text-green-300 absolute top-1 left-3">Опубликовано</p>
                @elseif($post->status == 1)
                    <p class="text-red-500 absolute top-1 left-3">Черновик</p>
                @else
                    <p class="absolute top-1 left-3 hover:text-white">Архив</p>
                @endif
                {{ Str::limit($post->title, 20, '...') }}
                @if($post->status != 3)
                    <form method="POST" action="{{ route('addToArchive') }}">
                        @csrf
                        <input name="id" class="hidden" type="text" value="{{ $post['id'] }}">
                        <button class="absolute bottom-1 right-3 cursor-pointer hover:underline" type="submit">В архив</button>
                    </form>
                @endif
                    <a onclick="openChangePost({{ $post->id }}, '{{ $post->title }}',
                    '{{ $post->content }}', '{{ $post->tags }}', {{ $post->status }})"
                    class="absolute bottom-1 left-3 hover:text-white hover:underline cursor-pointer">Изменить</a>
            </a>
        @empty
            <p class="text-red-500">У вас еще нет записей</p>
        @endforelse
    </div>
@endsection
