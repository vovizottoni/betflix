<?php

namespace App\Listeners;

use App\Events\BetWinEvent;
use App\Jobs\ProcessBetLose;
use App\Jobs\ProcessBetWin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessBonusWinListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\BetWinEvent $event
     * @return void
     */
    public function handle(BetWinEvent $event)
    {
        ProcessBetWin::dispatch($event->accountId, $event->amount, $event->balance_used, $event->fungamessGamesGainsId);

    }
}
