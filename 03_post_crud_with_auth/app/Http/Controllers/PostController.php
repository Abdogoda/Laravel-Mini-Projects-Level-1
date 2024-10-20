<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view("posts.index", compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id()){
            return back()->with("error", 'You are not authorized to visit this url!');
        }
        return view("posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()){
            return back()->with("error", 'You are not authorized to visit this url!');
        }
        return view("posts.edit", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id()){
            return back()->with("error", 'You are not authorized to visit this url!');
        }

        $data = $request->all();
        $post->update([
            'title' => $data['title'],
            'content' => $data['content']
        ]);

        return back()->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->user_id != Auth::id()){
            return back()->with("error", 'You are not authorized to visit this url!');
        }

        $post->delete();
        return back()->with('success', 'Post deleted successfully');
    }
}