<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Tag;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'store',
            'create',
            'update',
            'edit',
            'destroy',
        ]]);
    }

    public function index()
    {
        $title = 'Список статей';
        $posts = Post::where('published', true)->with('tags')->latest()->get();
        return view('posts.index', compact('title', 'posts'));
    }


    public function store()
    {
        $attributes = $this->validatePost('store');
        \Auth::user()->posts()->create($attributes);

        \Session::flash('message', 'Статья успешно добавлена');

        return redirect('/posts');
    }


    public function create()
    {
        $title = 'Страница добавления новой статьи';
        return view('posts.create', compact('title'));
    }


    public function show(Post $post)
    {
        $title = $post->title;
        return view('posts.show', compact('title', 'post'));
    }


    public function update(Post $post)
    {
        $this->authorize('update', $post);
        $attributes = $this->validatePost('update', $post);
        $post->update($attributes);

        \Session::flash('message', 'Статья успешно обновлена');

        $postTags = $post->tags->keyBy('name');
        $newTags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return $item;
        });
        $syncIds = $postTags->intersectByKeys($newTags)->pluck('id')->toArray();

        $tagsToCreate = $newTags->diffKeys($postTags);
        foreach ($tagsToCreate as $tagName){
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $syncIds[] = $tag->id;
        }

        $post->tags()->sync($syncIds);

        return redirect('/posts/' . $post->getRouteKey());

    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        \Session::flash('message', 'Статья успешно удалена');
        return redirect('/posts');
    }


    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $title = 'Редактирование статьи: ' . $post->getRouteKey();
        return view('posts.edit', compact('title', 'post'));
    }


    public function validatePost($method, $post = null)
    {
        $rules = [
            'slug' => 'required|regex:/^[A-z0-9-_]+$/i|unique:posts,slug',
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'body' => 'required',
        ];

        if ($method == 'update') {
            $rules['slug'] .= ',' . $post->slug . ',slug';
        }

        $attributes = $this->validate(request(), $rules);
        $attributes['published'] = request('published') ? : 0;

        return $attributes;
    }
}
