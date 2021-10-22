<?php

namespace App\Models;

use App\Mail\PostCreated;
use App\Notifications\PostNotification;
use App\Service\PushAllService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::created(function(Post $post){
//            \Mail::to(\Config::get('mail.admin.email'))->send(new PostCreated($post));
            $post->owner->notify(new PostNotification($post, 'created'));

//            $pushAllService = resolve(PushAllService::class);
//            $pushAllService->sendPush('Создана новая статья', $post->title);
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
