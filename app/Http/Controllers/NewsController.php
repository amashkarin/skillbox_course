<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use App\Models\Tag;
use App\Service\TaggableHelper;
use Illuminate\Pagination\Paginator;

class NewsController extends Controller
{
    public function index()
    {
        $pageSize = 10;
        $sortField = 'created_at';
        $sortDirection = 'desc';
        $news = \Cache::tags([NewsItem::getListCacheTag()])->rememberForever(NewsItem::getListCacheKey([$pageSize, $sortField, $sortDirection]), function () use ($pageSize) {
            return NewsItem::where('published', true)->latest()->paginate($pageSize);
        });

        return view('news.index', compact('news'));
    }

    public function adminList()
    {
        $pageSize = 20;
        $sortField = 'created_at';
        $sortDirection = 'desc';
        $news = \Cache::tags([NewsItem::getListCacheTag()])->rememberForever(NewsItem::getListCacheKey([$pageSize, $sortField, $sortDirection]), function () use ($pageSize) {
            return NewsItem::latest()->paginate($pageSize);
        });

        return view('news.admin_list', compact('news'));
    }

    public function show($slug)
    {
        $newsItem = NewsItem::getByRouteKeyFromCache($slug);
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


    public function update(NewsItem $newsItem, TaggableHelper $taggableHelper)
    {
        $data = $this->validatePost($newsItem);
        $newsItem->updateOrFail($data);
        $taggableHelper->syncTagsFromRequest($newsItem);

        return redirect(route('admin.news'));
    }


    public function store(TaggableHelper $taggableHelper)
    {
        $data = $this->validatePost();
        $newsItem = new NewsItem($data);
        $newsItem->saveOrFail();
        $taggableHelper->syncTagsFromRequest($newsItem);

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
