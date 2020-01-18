<?php

namespace App\Http\Controllers;


use App\Post;
use App\Tag;

class TagsController extends Controller
{

    public function index(Tag $tag)
    {
        $title = 'Список статей по тегу "' . $tag->name . '"';
        $posts = $tag->posts()->with('tags')->get();
        return view('posts.index', compact('title', 'posts'));
    }
}
