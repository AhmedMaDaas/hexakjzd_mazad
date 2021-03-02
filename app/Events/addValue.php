<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class addValue implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bigValue,
           $minValue,
           $bargainingValue,
           $userName,
           $userId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($bigValue,$minValue,$bargainingValue,$userName,$userId)
    {
        $this->bigValue = $bigValue;
        $this->userName = $userName;
        $this->userId = $userId;
        $this->minValue = $minValue;
        $this->bargainingValue = $bargainingValue;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('add-value-channel');
    }

    public function broadcastAs(){
        return 'add-value';
    }
}
