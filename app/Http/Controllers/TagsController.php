<?php

namespace App\Http\Controllers;


use App\Models\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        $title = 'Список сущностей по тегу "' . $tag->name . '"';
        $tag->load(['posts', 'news']);
        return view('tags.show', compact('title', 'tag'));
    }
}
