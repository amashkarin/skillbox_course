<?php

namespace App\Http\Controllers;


use App\Post;
use App\Tag;

class PostsController extends Controller
{

    public function index()
    {
        $title = 'Список статей';
        $posts = Post::where('published', true)->with('tags')->latest()->get();
        return view('posts.index', compact('title', 'posts'));
    }


    public function store()
    {
        $attributes = $this->validate(request(), [
            'slug' => 'required|unique:posts|regex:/^[A-z0-9-_]+$/i',
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'body' => 'required',
        ]);
        $attributes['published'] = request('published') ? : 0;

        Post::create($attributes);
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
        $attributes = $this->validate(request(), [
            'slug' => 'required|unique:posts,slug,' . $post->slug . ',slug|regex:/^[A-z0-9-_]+$/i',
            'title' => 'required|min:5|max:100',
            'description' => 'required|max:255',
            'body' => 'required',
        ]);
        $attributes['published'] = request('published') ? : 0;
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
        $post->delete();
        \Session::flash('message', 'Статья успешно удалена');
        return redirect('/posts');
    }


    public function edit(Post $post)
    {
        $title = 'Редактирование статьи: ' . $post->getRouteKey();
        return view('posts.edit', compact('title', 'post'));
    }
}
