<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class audioControl implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $play,
           $pause,
           $restart,
           $stop;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($play,$pause,$restart,$stop)
    {
        $this->play = $play;
        $this->pause = $pause;
        $this->restart = $restart;
        $this->stop   = $stop;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('audio-control-channel');
    }

    public function broadcastAs(){
        return 'audio-control';
    }
}
