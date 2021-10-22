<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required'
        ]);

        $comment = new Comment(array_merge($data, [
            'post_id' => $post->id,
            'owner_id' => auth()->id()
        ]));
        $comment->save();

        return back();
    }
}
