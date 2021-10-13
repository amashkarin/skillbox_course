<?php

namespace App;

use App\Mail\PostCreated;
use App\Notifications\PostNotification;

class Post extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::created(function(Post $post){
//            \Mail::to(\Config::get('mail.admin.email'))->send(new PostCreated($post));
            $post->owner->notify(new PostNotification($post, 'created'));
        });

        static::updated(function(Post $post){
            $post->owner->notify(new PostNotification($post, 'updated'));
        });

        static::deleted(function(Post $post){
            $post->owner->notify(new PostNotification($post, 'deleted'));
        });
    }


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
        return $this->belongsTo(User::class, 'owner_id');
    }
}
