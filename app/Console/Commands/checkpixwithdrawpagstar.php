<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

//Libs utilizadas
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


//Models Utilizadas
use App\Models\Account;
use App\Models\Transaction;


class checkpixwithdrawpagstar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkpixwithdrawpagstar';

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

        //consulta todas transacoes do tipo: cashoutPIX e waiting_for_withdraw (pendentes)
        $transactions = Transaction::where([['type', '=', 'cashoutPIX'], ['status', '=', 'waiting_for_withdraw']])->get();

        foreach($transactions as $transaction) {

            //verifica na pagstar de o cashoutPIX foi confirmado
            if($transaction->external_reference){

                //faz requisicao a API pagstar (Check Status)
                try{

                    $response = Http::withHeaders([ 'Authorization' => 'Bearer ' . env('PAGSTAR_ACCESS_TOKEN') ])->get('https://api.pagstar.com/api/v2/wallet/partner/transfers/'.$transaction->external_reference.'/check', [ ]);

                    if($response->ok()){  // http code === 200

                        //Pagamento confirmado pela API Pagstar (atualiza no BD)
                        Transaction::where([['id', '=', $transaction->id]])->update(['status' => 'drawee']);

                    }else{

                        //Pagamento nao confirmado ou nao existente ou falha

                        continue;

                    }


                }catch(\Exception $e){  //falha na requisicao, continue para proxima iteracao

                        continue;
                }




            }

        }

        return Command::SUCCESS;
    }
}
