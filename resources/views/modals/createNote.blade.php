<div class="createPost hidden absolute w-full h-full bg-black/80 flex justify-center items-start z-50">
    <form method="POST" action="{{ route('createPost') }}" class="relative bg-white p-10 flex flex-col items-center
     mt-10 gap-5 w-[30%] rounded-xl dark:bg-black dark:text-white dark:border-white dark:border-2">
        @csrf
        <a onclick="closeCreatePostModal()" class="absolute top-0 right-2 text-3xl cursor-pointer">&times;</a>
        <h2 class="text-center font-bold text-2xl">Создание записи</h2>
        <input type="text" value="" id="id" name="id" class="hidden">
        <input id="title" required name="title" type="text" placeholder="Название записи"
               class="w-full border-[1px] border-black px-3 py-1 rounded-lg text-xl dark:bg-black
                dark:border-white">
        <textarea id="content" required name="content" placeholder="Контент записи"
               class="w-full border-[1px] border-black px-3 py-1 rounded-lg text-xl min-h-[100px]
                dark:bg-black dark:border-white"></textarea>
        <label class="w-full" for="tags">Выберите подходящий тег(Если несколько используй Ctrl)</label>
        <select id="tags" required name="tags[]" multiple class="w-full border-[1px]
         border-black px-3 py-1 rounded-lg text-xl dark:bg-black dark:text-white dark:border-white">
            @forelse($tags as $tag)
                <option value="{{ $tag['name'] }}">{{ $tag['name'] }}</option>
            @empty
                <p class="text-red-500">Нет тегов</p>
            @endforelse
        </select>
        <div class="checkCreate flex gap-2 w-full">
            <input id="public" value="2" type="radio" name="status">
            <p>Опубликовать</p>
        </div>
        <div class="checkDraft flex gap-2 w-full">
            <input id="draft" value="1" type="radio" name="status" checked>
            <p>в черновик</p>
        </div>
        <button value="2" name="create" type="submit"><x-button text="Создать" /></button>
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li class="text-center text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </form>
</div>
