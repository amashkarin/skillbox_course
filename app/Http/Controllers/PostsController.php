<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\Tag;
use App\Service\TaggableHelper;
use Illuminate\Support\Facades\Auth;

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
        $posts = Post::where('published', true)->with('tags')->latest()->paginate(10);
        return view('posts.index', compact('title', 'posts'));
    }

    public function adminList()
    {
        $title = 'Управление статьями';
        $posts = Post::latest()->paginate(20);
        return view('posts.admin_list', compact('title', 'posts'));
    }

    public function publish(Post $post)
    {
        $post->published = true;
        $post->save();
        return redirect(route('admin.posts'));
    }


    public function unpublish(Post $post)
    {
        $post->published = false;
        $post->save();
        return redirect(route('admin.posts'));
    }

    public function store(TaggableHelper $taggableHelper)
    {
        $attributes = $this->validatePost('store');
        $post = \Auth::user()->posts()->create($attributes);
        $taggableHelper->syncTagsFromRequest($post);

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


    public function update(Post $post, TaggableHelper $taggableHelper)
    {
        $this->authorize('update', $post);
        $attributes = $this->validatePost('update', $post);
        $post->update($attributes);

        \Session::flash('message', 'Статья успешно обновлена');

        $taggableHelper->syncTagsFromRequest($post);

        $redirectUrl = Auth::user()->isAdmin() ? route('admin.posts') : route('posts.show', $post->getRouteKey());
        return redirect($redirectUrl);

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
