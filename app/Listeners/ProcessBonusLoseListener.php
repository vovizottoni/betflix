<?php

namespace App\Listeners;

use App\Events\BetLoseEvent;
use App\Jobs\ProcessBetLose;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessBonusLoseListener
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
     * @param \App\Events\BetLoseEvent $event
     * @return void
     */
    public function handle(BetLoseEvent $event)
    {
        ProcessBetLose::dispatch($event->accountId, $event->amount, $event->balance_used, $event->fungamessGamesGainsId);
    }
}
