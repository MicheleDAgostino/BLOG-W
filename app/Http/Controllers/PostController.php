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
        
        $posts = Post::withCount('comments')->orderBy('created_at', 'DESC')->get();
        return view('post.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ], [
            'title.required' => 'Il titolo è richiesto',
            'description.required' => 'Il campo descrizione è richiesto.'
        ]);
        
        Auth::user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect('dashboard')->with('message', 'Post inserito con successo');

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
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->title = $request->title;
        $post->description = $request->description;

        $post->update();

        return redirect()->route('post.index')->with('message', 'Post modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->back()->with('message', 'Post eliminato con successo');
    }
}
