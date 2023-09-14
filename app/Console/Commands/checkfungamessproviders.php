<?php

namespace App\Console\Commands;

use App\Jobs\CheckFunGamesProvidersJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use App\Models\FungamessProviders;
use Illuminate\Support\Facades\Artisan;

class checkfungamessproviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkfungamessproviders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualização dos providers da fungamess';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get(env('FUNGAMESS_API') . '/providersList', []);
        $totalInsert = 0;
        
        if($response->ok()){
            $data = $response->json();
            foreach($data as $item){
                CheckFunGamesProvidersJob::dispatch($item);
                $totalInsert++;
            }
        }

        $this->info('Jobs Enviados para atualização Geral : ' . $totalInsert);
        Artisan::call('update_json_cache');
        return Command::SUCCESS;
    }
}
