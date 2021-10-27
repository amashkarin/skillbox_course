<?php

namespace App\Models;

use App\Contracts\Commentable;
use App\Contracts\Taggable;
use App\Traits\HasComments;
use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NewsItem extends Model implements Taggable, Commentable
{
    use HasFactory, HasTimestamps, HasTags, HasComments;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
