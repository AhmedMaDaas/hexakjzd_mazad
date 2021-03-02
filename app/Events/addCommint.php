<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class addCommint implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $commintId,
           $commint,
           $approvalUser,
           $userName,
           $userImage,
           $userId,
           $view;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($commintId,$commint,$approvalUser,$userName,$userImage,$userId,$view)
    {
        $this->commintId    = $commintId;
        $this->commint      = $commint;
        $this->approvalUser = $approvalUser;
        $this->userName     = $userName;
        $this->userImage    = $userImage;
        $this->userId       = $userId;
        $this->view         = $view;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('add-commint-channel');
    }

    public function broadcastAs(){
        return 'add-commint';
    }
}
