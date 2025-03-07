@extends('layouts/main')
@section('title', 'Main Page')
@section('content')
    <h2 class="text-center font-bold text-2xl">Главная страница</h2>
    <div class="posts mt-10 flex gap-5 flex-wrap items-center justify-center">
        @forelse($posts as $post)
            <a href="{{ route('showPost', ['id' => $post->id]) }}" class="relative py-10 px-28 border-2 border-purple-400 rounded-xl
            hover:bg-purple-400 hover:text-white transition-all duration-300">
                <p class="text-green-300 absolute top-1 left-3">Опубликовано</p>
                <p class="absolute top-1 right-3">{{ $post->user->username }}</p>
                {{ Str::limit($post->title, 20, '...') }}
                <p class="absolute text-sm text-black/40 bottom-1 left-3 cursor-pointer">
                    {{ $post->created_at->timeZone('Europe/Moscow')->addHour()->format('d.m.Y H:i') }}
                </p>
            </a>
        @empty
            <p class="text-red-500">Еще нет записей</p>
        @endforelse
    </div>
    <div class="pagination mt-12">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
@endsection
