<?php

namespace Baytek\Laravel\Users\Members\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MemberCreatedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $user;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('user.'.$this->user->id);
    }
}
