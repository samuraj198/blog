<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tags = Tag::all();
        $posts = Post::where('status', 2)
            ->with('comment')
            ->orderBy('created_at', 'desc');

        if ($request->has('tag') && $request['tag'] !== '') {
            $tag = Tag::find($request['tag']);

            if ($tag) {
                $posts->where('tags', 'LIKE', '%' . $tag->name . '%');
            }
        }

        $posts = $posts->paginate(10);

        return view('pages/index', compact('posts', 'tags'));
    }

    public function profile(Request $request)
    {
        $tags = Tag::all();
        $posts = Post::where('user_id', \auth()->user()->id)
            ->orderBy('created_at', 'desc');

        if ($request->has('tag') && $request['tag'] !== '') {
            $tag = Tag::find($request['tag']);

            if ($tag) {
                $posts->where('tags', 'LIKE', '%' . $tag->name . '%');
            }
        }

        $posts = $posts->paginate(10);

        return view('pages/profile', compact('tags', 'posts'));
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
        //
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
    public function destroy(Post $post)
    {
        //
    }
}
