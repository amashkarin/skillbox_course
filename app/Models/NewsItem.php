<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    use HasFactory, HasTimestamps;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
