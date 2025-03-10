@extends('layouts/main')
@section('title', 'Main Page')
@section('content')
    <h2 class="text-center font-bold text-2xl dark:text-white">Популярные теги</h2>
    <div class="popularTags flex gap-5 py-10">
        @forelse($tags->slice(0, 5) as $tag)
            <p class="dark:text-white bg-purple-400 px-5 py-3 rounded-xl">{{ $tag->name }} - {{ $tag->frequency }}</p>
        @empty
            <p class="text-center text-red-500">Нет категорий</p>
        @endforelse
    </div>
    <div class="nameAndTags flex gap-10 justify-center items-center">
        <h2 class="text-center font-bold text-2xl dark:text-white">Главная страница</h2>
        <form class="mb-0" method="GET">
            @csrf
            <select name="tag" onchange="this.form.submit()" class="w-full border-[1px] border-black px-3 py-1 rounded-lg text-xl dark:bg-black
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
    <div class="posts mt-10 flex gap-5 flex-wrap items-center justify-center dark:text-white">
        @forelse($posts as $post)
            <a href="{{ route('showPost', ['id' => $post->id]) }}" class="relative min-w-[500px] max-w-[500px]
            py-10 px-28 border-2 border-purple-400 rounded-xl
            hover:bg-purple-400 hover:text-white transition-all duration-300">
                <p class="text-green-300 absolute top-1 left-3">Опубликовано</p>
                <p class="absolute top-1 right-3">{{ $post->user->username }}</p>
                <p class="text-center">
                    {{ Str::limit($post->title, 20, '...') }}
                </p>
                <p class="absolute text-sm text-black/40 bottom-1 left-3 cursor-pointer">
                    {{ $post->created_at->timeZone('Europe/Moscow')->addHour()->format('d.m.Y H:i') }}
                </p>
                <div class="line border-[1px] border-purple-400 w-full absolute top-1/2 left-0"></div>
                @if($post->comment->where('status', 2)->first())
                    <p class="mt-10 text-center">{{ $post->comment->where('status', 2)->last()->content }}</p>
                @else
                    <p class="text-red-500 text-center mt-10">Нет недавних комментариев</p>
                @endif
            </a>
        @empty
            <p class="text-red-500">Еще нет записей</p>
        @endforelse
    </div>
    <div class="pagination my-12">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
@endsection
