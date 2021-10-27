<?php


namespace App\Traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;


trait HasComments
{
    public function comments(): MorphMany
    {
        /**
         * @var $this Model
         */
        return $this->morphMany(Comment::class, 'commentable');
    }
}
