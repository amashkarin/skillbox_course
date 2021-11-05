<?php

namespace App\Models;


class PostHistory extends Model
{

    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'before' => 'array',
        'after' => 'array',
    ];

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

}
