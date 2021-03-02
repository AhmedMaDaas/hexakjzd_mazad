<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class blockUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $blocked,
           $userId,
           $commintsIds;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($blocked,$userId,$commintsIds)
    {
        $this->blocked = $blocked;
        $this->userId = $userId;
        $this->commintsIds = $commintsIds;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('block-user-channel');
    }

    public function broadcastAs(){
        return 'block-user';
    }
}
