<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $postTitle;
    public $postUrl;
    public $updatedFields;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post, $updatedFields)
    {
        $this->postTitle = $post->title;
        $this->postUrl = route('posts.show', $post);
        $this->updatedFields = array_keys($updatedFields);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('admin');
    }

    public function broadcastWith()
    {
        return [
            'postTitle' => $this->postTitle,
            'postUrl' => $this->postUrl,
            'updatedFields' => $this->updatedFields,
        ];
    }
}
