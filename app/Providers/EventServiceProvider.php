<?php

namespace App\Providers;

use App\Events\BetLoseEvent;
use App\Events\BetWinEvent;
use App\Events\ConfirmedDeposit;
use App\Events\DepositRequest;
use App\Listeners\ConfirmedDepositListener;
use App\Listeners\DepositRequestListener;
use App\Listeners\LastUserSeen;
use App\Listeners\ProcessBonusLoseListener;
use App\Listeners\ProcessBonusWinListener;
use App\Models\KycValidation;
use App\Models\Transaction;
use App\Observers\KycValidationObserver;

use App\Observers\TransactionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            LastUserSeen::class
        ],
        Login::class => [
            LastUserSeen::class
        ],
        ConfirmedDeposit::class => [
            ConfirmedDepositListener::class
        ],
        DepositRequest::class => [
            DepositRequestListener::class,
            LastUserSeen::class
        ],
        BetWinEvent::class => [
            ProcessBonusWinListener::class
        ],
        BetLoseEvent::class => [
            ProcessBonusLoseListener::class
        ],


    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        KycValidation::observe(KycValidationObserver::class);
        Transaction::observe(TransactionObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
