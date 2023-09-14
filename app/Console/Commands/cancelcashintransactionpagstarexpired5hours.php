<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

//models
use App\Models\Transaction;

class cancelcashintransactionpagstarexpired5hours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancelcashintransactionpagstarexpired5hours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //buscando as transactions cashin Pagstar
        $transactions = Transaction::where([['type', '=', 'cashinPIX'],['status', '=','waiting_for_payment']])->select('status','updated_at','id')->get();
                
        $now = now();
        foreach($transactions as $transaction)
        {
            $updated_at_add_five_hours = $transaction->updated_at->addHours(5);

            if($now > $updated_at_add_five_hours){
                Transaction::where([['id', '=', $transaction->id]])->update(['status' => 'canceled']);
            }
            
        }
        
        return Command::SUCCESS;
    }
}
