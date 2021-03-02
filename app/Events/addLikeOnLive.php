<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class addLikeOnLive implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
     public $likes,
            $cheatLikes;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($likes,$cheatLikes)
    {
        $this->likes = $likes;
        $this->cheatLikes = $cheatLikes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('like-on-live-channel');
    }

    public function broadcastAs(){
        return 'add-like-on-live';
    }
}
