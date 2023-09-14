<?php

namespace App\Console\Commands;

use App\Models\FungamessGames;
use App\Models\FungamessProviders;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class savestorageimagesfungames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'savestorageimagesfungames';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Salvar imagens em Storage :: FunGames && ProviderGames';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->info('START');
        $this->info(\Carbon\Carbon::now()->format('H:i:s'));

        $providers = FungamessProviders::all();

        foreach ($providers as $key => $value) {

            if ($value->logo) {

                try {
                    $contents = file_get_contents($value->logo);
                    $name = substr($value->logo, strrpos($value->logo, '/') + 1);
                    Storage::put('images/FungamessProviders/' . $name, $contents);
                    $value->logo = '/storage/images/FungamessProviders/' . $name;
                    $value->save();
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }


        $FungamessGames = FungamessGames::all();

        foreach ($FungamessGames as $key => $value) {

            if ($value->img) {

                try {
                    $contents = file_get_contents($value->img);
                    $name = substr($value->img, strrpos($value->img, '/') + 1);
                    Storage::put('images/FungamessGames/' . $name, $contents);
                    $value->img = '/storage/images/FungamessGames/' . $name;
                    $value->save();
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        $this->info('END');
        $this->info(\Carbon\Carbon::now()->format('H:i:s'));
    }
}
