<?php

namespace App\Http\Controllers;


use App\Post;

class PostsController extends Controller
{

    public function index()
    {
        $title = 'Список статей';
        $posts = Post::where('published', true)->latest()->get();
        return view('posts.index', compact('title', 'posts'));
    }


    public function create()
    {
        $title = 'Страница добавления новой статьи';
        return view('posts.create', compact('title'));
    }

    public function store()
    {
        $this->validate(request(), [
            'slug' => 'required|unique:posts|regex:/^[A-z0-9-_]+$/i',
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'body' => 'required',
        ]);

        Post::create(request()->all());


        return redirect('/posts/create');
    }

    public function show(Post $post)
    {
        $title = $post->title;
        return view('posts.show', compact('title', 'post'));
    }
}
