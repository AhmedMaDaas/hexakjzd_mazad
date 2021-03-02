<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class addReply implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $view,
           $commintParentId,
           $userId,
           $commintId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($view,$commintParentId,$userId,$commintId)
    {
        $this->view = $view;
        $this->commintParentId = $commintParentId;
        $this->userId     = $userId;
        $this->commintId  = $commintId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('add-reply-channel');
    }

    public function broadcastAs(){
        return 'add-reply';
    }
}
