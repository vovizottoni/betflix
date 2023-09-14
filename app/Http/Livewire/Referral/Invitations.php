<?php

namespace App\Http\Livewire\Referral;

use App\Http\Livewire\Player\Bets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

//models utilizadas
use App\Models\Account;
use App\Models\Bonus;
use App\Models\User;
use App\Models\CommandBonus3Processamento__;
use App\Models\Bet;
use App\Models\FungamessGameGains;

class Invitations extends Component
{


    // --- Visao Geral ---
    // --- Visao Geral ---
    public $myReferrals;
    public $my_heirarchy;
    public $my_percent;

    public $perdas_dos_players__HYPETECH;
    public $perdas_dos_players__NUX;
    public $ganho_dos_players__HYPETECH;
    public $ganho_dos_players__NUX;
    public $GGR;
    public $TAXAS;
    public $REVENUE_SHARE;
    public $myCPA;
    public $CPAaberto;


    // --- Raio X de afiliados ---
    // --- Raio X de afiliados ---
    public $bonus3_semanapagamento;
    public $ciclo_inicio = '-';
    public $ciclo_fim = '-';

    public $invitesCount;
    public $last_invites;
    public $userId;
    public $total_bruto;
    public $accountid;
    public $account_owner_bonus_3;
    public $my_affilliates_group_3;
    public $my_affiliates_role;
    public $number_supervisor;
    public $my_affilliates_supervisor;
    public $my_affilliates_gerente;
    public $my_affilliates_subgerente;
    public $account_group3;
    public $number_affiliates_hierarquia;
    public $subtracao_amount;
    public $bet_id;


    public $ganho_dos_players__NUX_N;
    public $ganho_dos_players__HYPETECH_N;
    public $perdas_dos_players__NUX_N;
    public $perdas_dos_players__HYPETECH_N;

    public $estimativa_ggr;


    public function mount()
    {
        $user = Auth::user();
        $account = $user->accounts()->first();
        $bonus3_percentual___EMDECIMAL = $user->getBonus3FormatedPercent();

        //INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL
        //INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL
        //INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL


        //-> Número TOTAL de pessoas que entraram na BrazaBet com meu código de convite (nickname).   (numero de convidados).
        $this->myReferrals = User::where('invite_code','=',  Auth::user()->my_invite_code)->count();

        //-> Meu nível hierárquico no Bonus3 (master ou supervisor ou gerente ou subgerente)
        $this->my_heirarchy = $user->bonus3_nivelhierarquico;

        //-> Meu percentual atual de Bonus3 na hierarquia.
        $this->my_percent = $user->bonus3_percentual;


        //-> PERDA DOS PLAYERS (Perda dos players desde o inicio (está nos bonus gerados a partir de reds, caractere '+'))

        // -- -- -- Na hypetech -- -- --

        //consulta primeira account de User Logado, pois é ela que terá os bonus3 (account que recebe todo tipo bonus)
        //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
        $id_primeira_account = $account->id;

        //obtem somatorio do amount de bets red relacionadas a algum bonus 3 gerado p/ o usuario logado que é de hierarquia de Nonus3
        $perdas_dos_players__HYPETECH = (float)$account->bonus3HypetechPlayerLoses()->sum("bets.amount");

        $this->perdas_dos_players__HYPETECH = $perdas_dos_players__HYPETECH;


        // -- -- -- Na NUX       -- -- --


        //obtem somatorio do amount de bets red relacionadas a algum bonus 3 gerado p/ o usuario logado que é de hierarquia de Nonus3
        $amountFungamesLoses = (float)$account->bonus3FungamesPlayersLoses($this->bonus3_semanapagamento)->sum('amount');
        $this->perdas_dos_players__NUX = safeMul($amountFungamesLoses, $bonus3_percentual___EMDECIMAL);


        //-> Ganho dos Players (Ganho dos players desde o inicio (está nos bonus gerados a partir de greens, caractere '-'))

        // -- -- -- Na hypetech -- -- --
        // $id_primeira_account já consultada acima
        // $bonus3_percentual___EMDECIMAL já calculado


        //obtem somatorio do amount de bets gren relacionadas a algum bonus 3 gerado p/ o usuario logado que é de hierarquia de Nonus3
        $ganho_dos_players__HYPETECH = (float)$account->bonus3HypetechPlayerWins($this->bonus3_semanapagamento)->sum("bets.amount");

        $this->ganho_dos_players__HYPETECH = safeMul($ganho_dos_players__HYPETECH, $bonus3_percentual___EMDECIMAL);


        // -- -- -- Na NUX       -- -- --

        //obtem somatorio do amount de bets green relacionadas a algum bonus 3 gerado p/ o usuario logado que é de hierarquia de Nonus3
        // $ganho_dos_players__NUX = DB::table('bonus')
        // ->select(DB::raw('(bonus.amount/'.$bonus3_percentual___EMDECIMAL.') AS lucro_bet_nux'))
        // ->whereNull('bonus.bets_id') //apenas bonus originados da NUX
        // ->where([['bonus.group_tipo', '=', '3'], ['bonus.amount', '<', '0'], ['bonus.accounts_id', '=', $id_primeira_account]])
        // ->get();


        $ganho_dos_players__NUX = (float)$account->bonus3FungamesPlayersWins($this->bonus3_semanapagamento)->sum('amount');

        $this->ganho_dos_players__NUX = safeMul($ganho_dos_players__NUX, $bonus3_percentual___EMDECIMAL);


        $where = ['group_tipo' => 2, 'accounts_id' => $id_primeira_account];
        $CPA = (float)Bonus::where($where)->sum('amount');


        $this->myCPA = $CPA;


        $where = ['group_tipo' => 2, 'accounts_id' => $id_primeira_account, 'bonus3_processado' => 'n'];
        $CPAaberto = (float)Bonus::where($where)->sum('amount');

        $this->CPAaberto = $CPAaberto;


        //-> GGR

        $this->GGR = ($this->perdas_dos_players__HYPETECH + $this->perdas_dos_players__NUX) - ($this->ganho_dos_players__HYPETECH + $this->ganho_dos_players__NUX);


        //-> Taxas

        $var_25 = 25.0 / 100.0;
        $this->TAXAS = $var_25 * $this->GGR;

        //-> Revenue Share

        $this->REVENUE_SHARE = $this->GGR - $this->TAXAS;


        //-> Estimativa de Revenue Share (consulta todos dados denovo, mas considera apenas dados em aberto)
        //-> Estimativa de Revenue Share (consulta todos dados denovo, mas considera apenas dados em aberto)
        //-> Estimativa de Revenue Share (consulta todos dados denovo, mas considera apenas dados em aberto)
        //-> Estimativa de Revenue Share (consulta todos dados denovo, mas considera apenas dados em aberto)
        $where = ['group_tipo' => 3, 'accounts_id' => $id_primeira_account, 'bonus3_processado' => 'n'];
        $sum = (float)Bonus::where($where)->sum('amount');


        $this->estimativa_ggr = $sum;


        //INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL
        //INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL
        //INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL INDICADORES-VISAO-GERAL


    }


    public function render()
    {

        //CONSULTAR OS PLAYERS QUE FORAM CONVIDADOS PELO USUARIO LOGADO
        $this->userId = Auth::id();
        //ANTES AQUI ABAIXO HAVIA UMA CONDIÇÃO QUE CONSIDERAVA O BÔNUS 3, COMO ISSO É PARA INDICAÇÃO APENAS, REMOVI;
        $this->last_invites = User::where('invite_code', '=', Auth::user()->my_invite_code)->limit(5)->orderBy('created_at', 'desc')->get();

        $this->invitesCount = $this->last_invites->count();

        return view('livewire.referral.invitations');
    }
}
