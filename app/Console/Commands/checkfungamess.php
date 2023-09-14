<?php

namespace App\Console\Commands;

use App\Jobs\CheckFunGamesJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use App\Models\FungamessProviders;
use App\Models\FungamessGames;


class checkfungamess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkfungamess';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Jogos em atualização!';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get(env('FUNGAMESS_API') . '/gameList', []);

        $totalInsert = 0;
        if($response->ok()){
            $data = $response->json();
            foreach($data['games'] as $item){
                CheckFunGamesJob::dispatch($item);
                $totalInsert++;
            }
        }
        $this->info('Jobs Enviados para atualização Geral : ' . $totalInsert);
        return Command::SUCCESS;
    }

}
