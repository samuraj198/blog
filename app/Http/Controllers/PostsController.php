<?php

namespace App\Http\Controllers;

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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'required|array',
            'status' => 'required|integer',
        ]);

        $tags = implode(',', $request['tags']);

        foreach ($request['tags'] as $tag) {
            $query = Tag::where('name', $tag)->first();
            $query->frequency += 1;
            $query->save();
        }

        $post = Post::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'tags' => $tags,
            'status' => $request['status'],
            'user_id' => auth()->user()->id,
        ]);

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
    public function destroy(Post $post)
    {
        //
    }
}
