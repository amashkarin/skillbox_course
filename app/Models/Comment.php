<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, HasTimestamps;

    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        static::created(function (Comment $comment) {
            $commentable = $comment->commentable;
            /**
             * @var \App\Models\Model $commentable
             */

            \Cache::tags($commentable->getItemCacheTag($commentable->getRouteKey()))->flush();

        });

    }


    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
