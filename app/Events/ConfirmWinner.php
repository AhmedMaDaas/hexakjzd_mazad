<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConfirmWinner implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $winnerName, $winnerNumber;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($winnerName, $winnerNumber)
    {
        $this->winnerName = $winnerName;
        $this->winnerNumber = $winnerNumber;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('confirm-winner-channel');
    }

    public function broadcastAs(){
        return 'confirm-winner';
    }
}
