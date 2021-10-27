<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, HasTimestamps;

    protected $guarded = [];

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
