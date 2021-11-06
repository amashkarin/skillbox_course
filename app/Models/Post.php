<?php

namespace App\Models;

use App\Contracts\Commentable;
use App\Contracts\Taggable;
use App\Events\PostUpdated;
use App\Mail\PostCreated;
use App\Notifications\PostNotification;
use App\Service\PushAllService;
use App\Traits\HasComments;
use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Arr;


class Post extends Model implements Taggable, Commentable
{
    use HasFactory, HasTags, HasComments;

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

            $after = $post->getDirty();
            $before = Arr::only($post->getOriginal(), array_keys($after));
            $post->history()->create([
                'owner_id' => auth()->id(),
                'timestamp' => $post->updated_at,
                'before' => $before,
                'after' => $after,
            ]);

            event(new PostUpdated($post, $after));
        });


        static::deleted(function(Post $post){
            $post->owner->notify(new PostNotification($post, 'deleted'));
        });
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function history()
    {
        return $this->hasMany(PostHistory::class, 'post_id', 'id');
    }
}
