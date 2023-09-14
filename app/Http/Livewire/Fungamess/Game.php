<?php

namespace App\Http\Livewire\Fungamess;

use Livewire\Component;
use Illuminate\Http\Request;

//Libs utilizadas
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


//Emails enviados


//Models Utilizadas
use App\Models\Account;
use App\Models\User;
use App\Models\Transaction;
use App\Models\FungamessGames;
use App\Models\TokenAccount;


class Game extends Component
{

    public $account_id;
    public $details_account_id;

    public $game_code;
    public $game;

    public $msgErro = '';

    //quando retornado: guardar link do iframe do game aqui
    public $link_iframe = '';

    //Executa apenas uma vez, e antes do render
    public function mount($game_code)
    {
        if(empty(getAccountIdSession())){
            header('Location:/login');
            exit;
        }

        return view('livewire.fungamess.game');

        $this->account_id = getAccountIdSession();

        $this->details_account_id = Account::where([['id' , '=',  $this->account_id]])->first();
        $this->checkUserIsBlockedInFungamess($this->details_account_id->users_id);

        $fungamessGame = FungamessGames::where([['game_code' , '=',  $game_code]])->first();

        $tokenAccountCreated = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . $this->account_id . (string)time();

        TokenAccount::create(['accounts_id' => $this->account_id, 'tokenu' => $tokenAccountCreated, 'game_code' => $game_code, 'balance_used' => session()->get('balanceUsed'), 'is_fungamess' => true]);

        try{
            $dataBody = [
                'demo' => false,
                'token' => $tokenAccountCreated,
                'userId' => Auth::user()->id,
                'gameId' => $fungamessGame->game_id,
                'lang' => 'pt',
                'country' => 'BR'
            ];
            $response = Http::get(env('FUNGAMESS_API') .'/start', $dataBody);
            // echo '<pre>',print_r($response); exit;
            $this->link_iframe = $response->transferStats->getEffectiveUri()->__toString();

        }catch(\Exception $e){

        }
    }



    public function render(){
        return view('livewire.fungamess.game');

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
