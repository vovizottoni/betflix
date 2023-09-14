<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BetWinEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $accountId;
    public $amount;
    public $balance_used;
    public $fungamessGamesGainsId;

    public function __construct($accountId, $amount, $balance_used, $fungamessGamesGainsId)
    {
        $this->accountId = $accountId;
        $this->amount = $amount;
        $this->balance_used = $balance_used;
        $this->fungamessGamesGainsId = $fungamessGamesGainsId;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
