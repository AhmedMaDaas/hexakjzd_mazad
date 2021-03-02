<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class addView implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $views,
           $cheat_views;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($views,$cheat_views)
    {
        $this->views = $views;
        $this->cheat_views = $cheat_views;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('add-view-channel');
    }

    public function broadcastAs(){
        return 'add-view';
    }
}
