<?php

namespace App\Console\Commands;

use App\Models\FungamessGames;
use App\Models\FungamessProviders;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateJsonCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_json_cache';

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
        $this->cacheProvidersWithGames();
        return Command::SUCCESS;
    }

    private function cacheProvidersWithGames()
    {
        //providers with games
        $rows = FungamessProviders::whereNotNull('logo')->get();
        foreach ($rows as $k => $row) {
            $where = ['provider_id' => $row->id];
            $games = FungamessGames::where($where)->limit(12)->get();
            $qtyGames = FungamessGames::where($where)->count();
            if ($qtyGames > 0) {
                $rows[$k]['games'] = $games;
                $rows[$k]['qty_games'] = $qtyGames;
            } else {
                unset($rows[$k]);
            }
        }
        $json = json_encode($rows);
        Storage::disk('local')->put('json_cache/providers_with_games.json', $json);
    }
}
