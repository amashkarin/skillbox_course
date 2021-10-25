<?php

namespace App\Http\Controllers;

use App\Contracts\Commentable;
use App\Models\Comment;
use App\Models\NewsItem;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function storePostComment(Request $request, Post $post)
    {
        return $this->store($request, $post);
    }


    public function storeNewsComment(Request $request, NewsItem $newsItem)
    {
        return $this->store($request, $newsItem);
    }


    public function store(Request $request, Commentable $commentable)
    {
        $data = $request->validate([
            'body' => 'required'
        ]);

        $commentable->comments()->save(new Comment(array_merge($data, [
            'owner_id' => auth()->id()
        ])));

        return back();
    }
}
