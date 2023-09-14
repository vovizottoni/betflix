<?php

namespace App\Jobs;

use App\Models\FungamessProviders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckFunGamesProvidersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $item;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $provider = FungamessProviders::where([['provider_id', '=', $this->item['id']]])->first();
        if (empty($provider)) {

            $providerCreated = FungamessProviders::create([
                'provider_id' => $this->item['id'],
                'name' => $this->item['name'],
                'logo' => $this->item['logo']
            ]);
            //$totalInsert += 1;
        } else {

            FungamessProviders::where([['provider_id', '=', $this->item['id']]])->update([
                'name' => $this->item['name'],
                'logo' => $this->item['logo']
            ]);
            //$totalUpdate += 1;
        }
    }
}
