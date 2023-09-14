<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Comandos agendados

        //pagstar

        //$schedule->command('checkccpaymentpagstar')->everyTwoMinutes()->runInBackground();

        //olhar status transactions
        //$schedule->command('checkpixwithdrawpagstar')->withoutOverlapping()->everyTwoMinutes()->runInBackground();

        //cancelar cashin pagstar com mais de 5h
        // $schedule->command('cancelcashintransactionpagstarexpired5hours')->withoutOverlapping()->everySixHours()->runInBackground();

        $schedule->command('telescope:prune')->everySixHours();
        //pagar bonus3 semanalmente
        $schedule->command('update_fastpayment_status')->everyFiveMinutes()->runInBackground();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
