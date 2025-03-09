@extends('layouts/main')
@include('modals/createNote')
@section('title', 'Profile')
@section('content')
    <div class="nameAndTags flex gap-10 justify-center items-center mb-10">
        <h2 class="text-center font-bold text-2xl dark:text-white">Ваши записи</h2>
        <form method="GET">
            @csrf
            <select name="tag" onchange="this.form.submit()" class="w-full border-[1px]
            border-black px-3 py-1 rounded-lg text-xl dark:bg-black
            dark:border-white dark:text-white">
                <option disabled selected hidden>Фильтрация по тегу</option>
                <option value="">Все</option>
                @forelse($tags as $tag)
                    <option name="id" {{ request('tag') == $tag->id ? 'selected' : '' }} value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </option>
                @empty
                    <option disabled>Нет категорий</option>
                @endforelse
            </select>
        </form>
    </div>
    <div class="buttons flex gap-5">
        <a onclick="openCreatePostModal()"><x-button text="Создать запись" /></a>
    </div>
    <div class="posts mt-10 flex gap-5 flex-wrap items-center justify-center dark:text-white">
        @forelse($posts as $post)
            <a href="{{ route('showPost', ['id' => $post->id]) }}" class="relative min-w-[500px] max-w-[500px]
            py-10 px-28 border-2 border-purple-400 rounded-xl
            hover:bg-purple-400 hover:text-white transition-all duration-300">
                <form class="z-10" method="POST" action="{{ route('deletePost') }}">
                    @csrf
                    @method('DELETE')
                    <input name="id" type="text" value="{{ $post->id }}" class="hidden">
                    <input class="cursor-pointer hover:underline absolute top-1 right-3 text-red-500"
                           type="submit" value="Удалить">
                </form>
                @if($post->status == 2)
                    <p class="text-green-300 absolute top-1 left-3">Опубликовано</p>
                @elseif($post->status == 1)
                    <p class="text-red-500 absolute top-1 left-3">Черновик</p>
                @else
                    <p class="absolute top-1 left-3 hover:text-white">Архив</p>
                @endif
                <p class="text-center">
                    {{ Str::limit($post->title, 20, '...') }}
                </p>
                @if($post->status != 3)
                    <form method="POST" action="{{ route('addToArchive') }}">
                        @csrf
                        <input name="id" class="hidden" type="text" value="{{ $post['id'] }}">
                        <button class="absolute bottom-1 right-3 cursor-pointer hover:underline" type="submit">
                            В архив
                        </button>
                    </form>
                @endif
                <button onclick="event.stopPropagation() ; openChangePost({{ $post->id }}, '{{ $post->title }}',
                '{{ $post->content }}', '{{ $post->tags }}', {{ $post->status }}); return false;"
                class="absolute bottom-1 left-3 hover:text-white hover:underline cursor-pointer">Изменить</button>
                <div class="line border-[1px] border-purple-400 w-full absolute top-1/2 left-0"></div>
                @if($post->comment->first())
                    <p class="mt-10 text-center">{{ $post->comment->last()->content }}</p>
                @else
                    <p class="text-red-500 text-center mt-10">Нет недавних комментариев</p>
                @endif
            </a>
        @empty
            <p class="text-red-500">У вас еще нет записей</p>
        @endforelse
    </div>
    <div class="pagination my-12">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
@endsection
