<?php

namespace App\Http\Controllers;


use App\Models\Tag;


class TagsController extends Controller
{

    public function show($routeKey)
    {
        $tag = Tag::getByRouteKeyFromCache($routeKey, ['posts', 'news']);
        $title = 'Список сущностей по тегу "' . $tag->name . '"';
        return view('tags.show', compact('title', 'tag'));
    }
}
