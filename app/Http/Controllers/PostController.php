<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return Inertia::render(
            'Post/Index',
            [
                'posts' => $posts
            ]
        );
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
            'title' => 'required|string|max:255|min:5',
            'content' => 'required|min:5'
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.min' => 'Judul minimal harus memiliki 5 karakter.',
            'title.max' => 'Judul tidak boleh melebihi 255 karakter.',
            'content.required' => 'Konten wajib diisi.',
            'content.min' => 'Konten minimal harus memiliki 5 karakter.'
        ]);
        Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);
        sleep(1);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
        $request->validate([
            'title' => 'required|string|max:255|min:5',
            'content' => 'required|min:5'
        ], [
            'title.required' => 'Judul wajib diisi.',
            'title.min' => 'Judul minimal harus memiliki 5 karakter.',
            'title.max' => 'Judul tidak boleh melebihi 255 karakter.',
            'content.required' => 'Konten wajib diisi.',
            'content.min' => 'Konten minimal harus memiliki 5 karakter.'
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        sleep(1);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        sleep(1);

        return back();
    }
}
