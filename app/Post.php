<?php

namespace App;

class Post extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function owner()
    {
        $this->hasOne(User::class, 'owner_id');
    }
}
