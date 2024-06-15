<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::paginate(4);
        return view('posts.index', compact('posts'));
    }

    public function create(){
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'short_description' => 'required',
            'content' => 'required',
            'picture' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data['user_id'] = auth()->id();
        $data['published_at'] = now();

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        Post::create($data);

        return redirect()->route('posts.index');
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post){
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post){
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'short_description' => 'required',
            'content' => 'required',
            'picture' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index');}

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index');
    }

}
