@extends('layouts/main')
@section('title', 'Post')
@section('content')
    <h2 class="text-center font-bold text-2xl mb-10">Пост: {{ $post->title }}</h2>
    <div class="post w-full flex flex-col items-center">
        <div class="content min-h-[100px] w-[80%]">
            <p>{{ $post->content }}</p>
        </div>
        <div class="border-2 border-black w-full"></div>
        <div class="comments mt-10 flex flex-col gap-10 mb-32">
            @forelse($comments as $comment)
                <div class="comment">
                    <p>{{ $comment->author }}</p>
                    <p>{{ $comment->content }}</p>
                </div>
            @empty
                <p class="text-red-500">Комментариев пока нет</p>
            @endforelse
        </div>
        <form method="POST" class="w-full flex items-center justify-center gap-1 fixed bottom-5"
        action="{{ route('createComment', ['id' => $post->id]) }}">
            @csrf
            <input min="10" required type="text" name="content" placeholder="Комментарий" class="border-black border-[1px] w-[80%] px-5 py-3 rounded-xl">
            <button type="submit"> <x-button text="Отправить" /> </button>
        </form>
    </div>
@endsection
