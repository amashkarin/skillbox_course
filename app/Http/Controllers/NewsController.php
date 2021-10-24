<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use App\Models\Tag;
use App\Service\TaggableHelper;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsItem::where('published', true)->latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function adminList()
    {
        $news = NewsItem::latest()->paginate(20);
        return view('news.admin_list', compact('news'));
    }

    public function show(NewsItem $newsItem)
    {
        return view('news.show', compact('newsItem'));
    }

    public function edit(NewsItem $newsItem)
    {
        return view('news.edit', compact('newsItem'));
    }

    public function create()
    {
        return view('news.create');
    }


    public function update(NewsItem $newsItem)
    {
        $data = $this->validatePost($newsItem);
        $newsItem->updateOrFail($data);
        $taggableHelper = resolve(TaggableHelper::class);
        $taggableHelper->syncNewsItemTagsFromRequest($newsItem);

        return redirect(route('admin.news'));
    }


    public function store()
    {
        $data = $this->validatePost();
        $newsItem = new NewsItem($data);
        $newsItem->saveOrFail();
        $taggableHelper = resolve(TaggableHelper::class);
        $taggableHelper->syncNewsItemTagsFromRequest($newsItem);

        return redirect(route('admin.news'));
    }

    public function destroy(NewsItem $newsItem)
    {
        $newsItem->deleteOrFail();
        return redirect(route('admin.news'));
    }

    public function validatePost($newsItem = null)
    {
        $rules = [
            'slug' => 'required|regex:/^[A-z0-9-_]+$/i|unique:posts,slug',
            'title' => 'required',
            'body' => 'required',
        ];

        if ($newsItem instanceof NewsItem) {
            $rules['slug'] .= ',' . $newsItem->slug . ',slug';
        }

        $attributes = $this->validate(request(), $rules);
        $attributes['published'] = request('published') ?: 0;

        return $attributes;
    }
}
