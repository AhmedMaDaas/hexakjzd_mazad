<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class addLikeOnCommint implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $likes,
           $likeStatus,
           $commintId,
           $interactionId,
           $oldInteractionId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($likes,$likeStatus,$commintId,$interactionId,$oldInteractionId)
    {
        $this->likes = $likes;
        $this->likeStatus = $likeStatus;
        $this->commintId = $commintId;
        $this->interactionId = $interactionId;
        $this->oldInteractionId = $oldInteractionId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('like-on-commint-channel');
    }

    public function broadcastAs(){
        return 'add-like-on-commint';
    }

}
