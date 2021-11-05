<?php

namespace App\Http\Controllers;


use App\Models\Tag;
use App\Traits\HasItemCache;
use App\Traits\HasListCache;

class TagsController extends Controller
{
    use HasListCache, HasItemCache;

    public function show($routeKey)
    {
        $tag = Tag::getByRouteKeyFromCache($routeKey, ['posts', 'news']);
        $title = 'Список сущностей по тегу "' . $tag->name . '"';
        return view('tags.show', compact('title', 'tag'));
    }
}
