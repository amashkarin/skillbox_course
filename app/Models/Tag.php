<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(NewsItem::class, 'taggable');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
