<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class editTimer implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $endTime,
           $time,
           $date,
           $statusPause,
           $startLive;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($endTime,$date,$time,$statusPause,$startLive=false)
    {
        $this->endTime = $endTime;
        $this->date = $date;
        $this->time = $time;
        $this->statusPause = $statusPause;
        $this->startLive = $startLive;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('edit-timer-channel');
    }

    public function broadcastAs(){
        return 'edit-timer';
    }
}
