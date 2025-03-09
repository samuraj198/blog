<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showPost($id)
    {
        $comments = Comment::where('post_id', $id)->get();

        $post = Post::where('id', $id)->first();

        return view('pages/showPost', compact('comments', 'post'));
    }

    public function createComment($id, Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        if (empty(auth()->user()->username)) {
            $author = 'Guest';
            $email = null;
        } else {
            $author = auth()->user()->username;
            $email = auth()->user()->email;
        }

        $comment = Comment::create([
            'content' => $request['content'],
            'post_id' => $id,
            'author' => $author,
            'email' =>$email,
            'status' => 1,
        ]);
        return redirect()->back()->with('createComm', 'Комментарий отправлен на проверку');
    }

    public function addToArchive(Request $request)
    {
        $post = Post::where('id', $request['id'])->first();
        if ($post) {
            $post['status'] = 3;
            $post->save();
        }
        return redirect()->back()
            ->with('addToArchive', 'Пост успешно добавлен в архив и не виден другим пользователям');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'required|array',
            'status' => 'required|integer',
        ]);

        $oldTags = [];
        if ($request['id']) {
            $post = Post::find($request['id']);
            $oldTags = explode(',', $post->tags);
        }

        foreach ($oldTags as $tag) {
            if (!in_array($tag, $request['tags'])) {
                $query = Tag::where('name', $tag)->first();
                if ($query) {
                    $query->frequency -= 1;
                    $query->save();
                }
            }
        }

        foreach ($request['tags'] as $tag) {
            $query = Tag::where('name', $tag)->first();
            $query->frequency += 1;
            $query->save();
        }

        $tags = implode(',', $request['tags']);

        if ($request['id']) {
            $query = Post::where('id', $request['id'])->first();
            $query->title = $request['title'];
            $query->content = $request['content'];
            $query->tags = $tags;
            $query->status = $request['status'];
            $query->save();
        } else {
            $post = Post::create([
                'title' => $request['title'],
                'content' => $request['content'],
                'tags' => $tags,
                'status' => $request['status'],
                'user_id' => auth()->user()->id,
            ]);
        }


        return redirect()->route('profile');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request['id']);
        $tags = explode(',', $post->tags);
        foreach ($tags as $tag) {
            $query = Tag::where('name', $tag)->first();
            $query->frequency -= 1;
            $query->save();
        }
        $post->delete();
        return redirect()->route('profile')->with('Вы успешно удалили пост');
    }
}
