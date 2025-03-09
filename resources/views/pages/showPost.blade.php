@extends('layouts/main')
@section('title', 'Post')
@section('content')
    <h2 class="text-center font-bold text-2xl mb-10 dark:text-white">{{ $post->title }}</h2>
    <div class="post w-full flex flex-col items-center">
        <div class="content min-h-[100px] w-[80%] dark:text-white">
            <p>{{ $post->content }}</p>
        </div>
        <div class="border-2 border-black w-full dark:border-purple-400"></div>
        <div class="comments mt-10 flex flex-col gap-10 mb-32 w-[80%] dark:text-white">
            @forelse($comments as $comment)
                @if($comment->status == 2 || auth()->user() && $post->user_id == auth()->user()->id)
                    <div class="comment relative border-[1px] border-purple-400 w-full px-10 py-10 rounded-xl">
                        @if ($comment->status == 1)
                            <p class="absolute top-1 right-3 text-black/50 dark:text-white/50">
                                Комментарий в обработке
                            </p>
                            <form class="dark:text-white absolute bottom-1 right-3"
                            action="{{ route('approveComment') }}" method="POST">
                                @csrf
                                <input name="id" class="hidden" type="text" value="{{ $comment->id }}">
                                <button type="submit">Утвердить комментарий</button>
                            </form>
                        @endif
                        <p class="absolute top-1 left-3 text-black/50 dark:text-white/50">
                            {{ $comment->author }}
                        </p>
                        <p>
                            {{ $comment->content }}
                        </p>
                    </div>
                @endif
            @empty
                @if($post->status != 3)
                    <p class="text-red-500 text-center">Комментариев пока нет</p>
                @else
                    <p class="text-red-500 text-center">
                        Комментариев нет. Пост в архиве, писать новые комментарии запрещено
                    </p>
                @endif
            @endforelse
            <p class="dark:text-white text-center">Комментариев в обработке: {{ $wait }}</p>
        </div>
        @if($post->status != 3)
            <form method="POST" class="w-full flex items-center justify-center gap-1 fixed bottom-5 dark:text-white"
                  action="{{ route('createComment', ['id' => $post->id]) }}">
                @csrf
                <input required type="text" name="content" placeholder="Комментарий" class="border-black border-[1px]
                w-[80%] px-5 py-3 rounded-xl dark:border-white dark:bg-black">
                <button type="submit"> <x-button text="Отправить" /> </button>
            </form>
        @endif
    </div>
@endsection
