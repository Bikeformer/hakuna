<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReservationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $seatId;
    public $reservationType;

    /**
     * Create a new event instance.
     *
     * @param $seatId
     * @param $reservationType
     */
    public function __construct($seatId, $reservationType)
    {
        $this->seatId = $seatId;
        $this->reservationType = $reservationType;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['public-reservation'];
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'reservation';
    }

}
