<?php

namespace App\Http\Livewire\Fungamess;

use Livewire\Component;

//Libs utilizadas
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\TokenAccount;
use App\Models\FungamessProviders;
use App\Models\FungamessGames;

class Esportes extends Component
{
    public $account_id;
    public $details_account_id;

    public $game_code = 3; // ID 3 esportes
    public $game;

    public $msgErro = '';

    public $link_iframe = '';

    public function mount()
    {
        if(empty(getAccountIdSession())){
            header('Location:/login');
            exit;
        }

        $this->account_id = getAccountIdSession();

        $this->details_account_id = Account::where([['id' , '=',  $this->account_id]])->first();
        $this->checkUserIsBlockedInFungamess($this->details_account_id->users_id);

        $fungamessGame = FungamessGames::where([['game_code' , '=',  $this->game_code]])->first();

        $tokenAccountCreated = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . $this->account_id . (string)time();

        TokenAccount::create(['accounts_id' => $this->account_id, 'tokenu' => $tokenAccountCreated, 'game_code' => $this->game_code, 'balance_used' => 'balance', 'is_fungamess' => true]);

        try{
            $dataBody = [
                'demo' => false,
                'token' => $tokenAccountCreated,
                'userId' => Auth::user()->id,
                'gameId' => $this->game_code,
                'lang' => 'pt',
                'country' => 'BR'
            ];
            // echo '<pre>', print_r($dataBody); exit;

            $response = Http::get(env('FUNGAMESS_API') .'/start', $dataBody);
            // echo '<pre>', print_r($response); exit;
            $this->link_iframe = $this->link_iframe = $response->transferStats->getEffectiveUri()->__toString();

        }catch(\Exception $e){

        }
    }

    public function render()
    {
        return view('livewire.fungamess.esportes', [
        ]);
    }

    private function checkUserIsBlockedInFungamess($user_id)
    {
        $user = User::where([['id' , '=',  $user_id]])->first();

        if(!empty($user->fungamess_user_blocked)){
            header('Location:/');
            exit;
        }
    }
}
