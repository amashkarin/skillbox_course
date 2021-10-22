<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostHistory extends Model
{

    protected $guarded = [];
    public $timestamps = false;

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

}
