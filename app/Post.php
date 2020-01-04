<?php

namespace App;

class Post extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
