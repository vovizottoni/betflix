<?php

namespace App\Http\Livewire\Referral;

use App\Enums\Bonus3LevelsGroupsEnum;
use App\Http\Livewire\Fungamess\Game;
use Livewire\Component;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

//models utilizadas
use App\Models\Account;
use App\Models\Bonus;
use App\Models\User;
use App\Models\CommandBonus3Processamento__;
use App\Models\Bet;


class Xray extends Component
{


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
    public $my_affilliates_subgerente = 0;
    public $account_group3;
    public $number_affiliates_hierarquia;
    public $n;
    public $c;

    public $RevenueShareOpened;
    public $RevenueSharePaid;
    public $RevenueShareTotal;

    public $CpaOpened;
    public $CpaPaid;
    public $CpaTotal;

    public $perdas_dos_players__HYPETECH;
    public $perdas_dos_players__NUX;
    public $ganho_dos_players__HYPETECH;
    public $ganho_dos_players__NUX;
    public $GGR;
    public $TAXAS;
    public $REVENUE_SHARE;

    public $percentual_masculino;
    public $percentual_feminino;


    public $faixa_18_25 = 0;
    public $faixa_26_33 = 0;
    public $faixa_34_40 = 0;
    public $faixa_acima_40 = 0;

    public $percent_18_25 = 0.0;
    public $percent_26_33 = 0.0;
    public $percent_34_40 = 0.0;
    public $percent_acima_40 = 0.0;

    public $arrCountries = [];

    public $bar_green;
    public $bar_red;
    public $interesses;
    public $ganho_aquisicao;
    public $resumo_grafico;
    public $resumo_grafico_estados;

    public function mount()
    {

        // Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados |
        // Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados |
        // Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados |
        // Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados |


        //Obtem ciclo atual ****************************************************************
        //Obtem ciclo atual ****************************************************************
        //-> obtem ultimo comandobonus3 executado

        $user = Auth::user();
        $bonus3Data = CommandBonus3Processamento__::getPeriodEndStart();
        $this->bonus3_semanapagamento = $bonus3Data['bonus3_semanapagamento'];
        $this->ciclo_inicio = $bonus3Data['ciclo_inicio'];
        $this->ciclo_fim = $bonus3Data['ciclo_fim'];
        $account = $user->accounts()->first();

        //Obtem ciclo atual ****************************************************************
        //Obtem ciclo atual ****************************************************************


        //Faturamento e Gráfico****************************************************************
        //Faturamento e Gráfico****************************************************************


        //faturamento bruto total somando todos meses do ano corrente (até o mes atual)

        //para cada mes do ano corrente
        // faturamento bruto do mes ( soma de bonus red associada ao user logado no mes corrente)
        // despesa do mes ( soma de bonus green associada ao user logado no mes corrente)


        //Faturamento e Gráfico****************************************************************
        //Faturamento e Gráfico****************************************************************


        //Barra Lateral Direita ICONES****************************************************************
        //Barra Lateral Direita ICONES****************************************************************

        //-> PERDA DOS PLAYERS (Perda dos players desde o inicio (está nos bonus gerados a partir de reds, caractere '+'))

        // -- -- -- Na hypetech -- -- --

        //consulta primeira account de User Logado, pois é ela que terá os bonus3 (account que recebe todo tipo bonus)
        //Consulta Account do AFILIADO que Receberá o BONUS: Primeira Account (ACCOUNT INICIAL)
        $id_primeira_account = $account->id;

        // -- -- -- Na NUX       -- -- --

        //Descobre o valor da aposta NUX

        $bonus3_percentual___EMDECIMAL = $user->getBonus3FormatedPercent();

        //obtem somatorio do amount de bets red relacionadas a algum bonus 3 gerado p/ o usuario logado que é de hierarquia de Nonus3

        $perdas_dos_players__HYPETECH = (float)$account->bonus3HypetechPlayerLoses($this->bonus3_semanapagamento)->sum("bets.amount");
        $this->perdas_dos_players__HYPETECH = safeMul($perdas_dos_players__HYPETECH, $bonus3_percentual___EMDECIMAL);


        //obtem somatorio do amount de bets red relacionadas a algum bonus 3 gerado p/ o usuario logado que é de hierarquia de Nonus3
        $amountFungamesLoses = (float)$account->bonus3FungamesPlayersLoses()->sum('amount');

        $this->perdas_dos_players__NUX = safeMul($amountFungamesLoses, $bonus3_percentual___EMDECIMAL);


        //-> Ganho dos Players (Ganho dos players desde o inicio (está nos bonus gerados a partir de greens, caractere '-'))

        // -- -- -- Na hypetech -- -- --
        // $id_primeira_account já consultada acima
        // $bonus3_percentual___EMDECIMAL já calculado


        //obtem somatorio do amount de bets gren relacionadas a algum bonus 3 gerado p/ o usuario logado que é de hierarquia de Nonus3
        $ganho_dos_players__HYPETECH = (float)$account->bonus3HypetechPlayerWins()->sum("bets.amount");

        $this->ganho_dos_players__HYPETECH = safeMul($ganho_dos_players__HYPETECH, $bonus3_percentual___EMDECIMAL);


        // -- -- -- Na NUX       -- -- --

        //obtem somatorio do amount de bets green relacionadas a algum bonus 3 gerado p/ o usuario logado que é de hierarquia de Nonus3
        $ganho_dos_players__NUX = (float)$account->bonus3FungamesPlayersWins($this->bonus3_semanapagamento)->sum('amount');

        $this->ganho_dos_players__NUX = safeMul($ganho_dos_players__NUX, $bonus3_percentual___EMDECIMAL);


        //-> GGR
        $losesSum = safeSum($this->perdas_dos_players__HYPETECH, $this->perdas_dos_players__NUX);
        $winsSum = safeSum($this->ganho_dos_players__HYPETECH, $this->ganho_dos_players__NUX);

        $this->GGR = safeSub($losesSum, $winsSum);


        //-> Taxas
        $this->TAXAS = safeMul($this->GGR, 0.25);

        //-> Revenue Share

        $this->REVENUE_SHARE = safeSub($this->GGR, $this->TAXAS);


        // NOVOS CALCULOS PARA O RAIO X (JOAO PEDRO)
        $RevenueShareOpened = (float)$account->unpaidBonus3()->sum('amount');
        $this->RevenueShareOpened = $RevenueShareOpened;


        $RevenueSharePaid = (float)$account->paidBonus3()->sum('amount');

        $this->RevenueSharePaid = $RevenueSharePaid;


        $this->RevenueShareTotal = safeSum($RevenueSharePaid, $RevenueShareOpened);


        $CpaOpened = (float)$account->unpaidBonus2()->sum('amount');

        $this->CpaOpened = $CpaOpened;


        $CpaPaid = (float)$account->paidBonus2()->sum('amount');

        $this->CpaPaid = $CpaPaid;


        $CpaTotal = safeSum($CpaOpened, $CpaPaid);

        $this->CpaTotal = $CpaTotal;


        //Barra Lateral Direita ICONES****************************************************************
        //Barra Lateral Direita ICONES****************************************************************


        //Resumo demográfico****************************************************************
        //Resumo demográfico****************************************************************

        // -- -- Gênero -- --
        //identificar publico masculino e feminino associado aos bonus 3 nessa bonus3_semanapagamento
        $where = ['bonus.group_tipo' => 3, 'bonus.accounts_id' => $id_primeira_account,
            'bonus.bonus3_semanapagamento' => $this->bonus3_semanapagamento];
        $numero_de_players_MASCULINO = DB::table('bonus')
            ->select('users.id', 'users.name')
            ->join('users', 'bonus.users_id_gerador_do_bonus', '=', 'users.id')
            ->where($where)
            ->where('users.gender', 'm')
            ->count();

        $numero_de_players_FEMININO = DB::table('bonus')
            ->select('users.id', 'users.name')
            ->join('users', 'bonus.users_id_gerador_do_bonus', '=', 'users.id')
            ->where($where)
            ->where('users.gender', 'f')
            ->count();
        $allPlayers = $numero_de_players_MASCULINO + $numero_de_players_FEMININO;
        if ($allPlayers > 0) {
            if ($numero_de_players_MASCULINO > 0) {
                $this->percentual_masculino = safeDiv(($numero_de_players_MASCULINO * 100), $allPlayers);
            } else {
                $this->percentual_masculino = 0.0;
            }
            if ($numero_de_players_FEMININO > 0) {
                $this->percentual_feminino = safeDiv(($numero_de_players_FEMININO * 100), $allPlayers);
            } else {
                $this->percentual_feminino = 0.0;
            }
        } else {
            $this->percentual_masculino = 0.0;
            $this->percentual_feminino = 0.0;
        }


        // -- -- Faixa etária -- --


        // SELECT
        $faixasIdades = getAgePeriods();
        unset($faixasIdades['acima_40']);
        $where = ['bonus.group_tipo' => 3, 'bonus.accounts_id' => $id_primeira_account, 'bonus.bonus3_semanapagamento' => $this->bonus3_semanapagamento];
        $soma_faixas_etarias = 0;

        $usersIds = DB::table("bonus")->where($where)->select(DB::raw("distinct(users_id_gerador_do_bonus)"))->get()->pluck("users_id_gerador_do_bonus");
        $totalAges = count($usersIds);
        $total2 = 0;
        foreach ($faixasIdades as $f => $periods) {
            $from = $periods[1];
            $to = $periods[0];
            $index = "faixa_" . $f;
            $this->$index = DB::table("users")->whereIn("id", $usersIds)->whereDate("users.birth_date", ">=", $from)->
            whereDate("users.birth_date", "<=", $to)->count();
            $indexPercent = "percent_" . $f;
            $total2 = $total2 + $this->$index;
            if ($this->$index > 0) {
                $this->$indexPercent = safeDiv($this->$index * 100, $totalAges);
            }
        }

        $this->faixa_acima_40 = $totalAges - $total2;
        if ($this->faixa_acima_40 > 0) {
            $this->percent_acima_40 = safeDiv($this->faixa_acima_40 * 100, $totalAges);
        }
        //Resumo demográfico****************************************************************
        //Resumo demográfico****************************************************************


        //Resumo de afiliados****************************************************************
        //Resumo de afiliados****************************************************************


        //Resumo de afiliados****************************************************************
        //Resumo de afiliados****************************************************************


        //Consultar TOP afiliados (do ciclo atual) ****************************************************************
        //Consultar TOP afiliados (do ciclo atual) ****************************************************************


        //consulta todos convidados pelo usuario logado

        //Temporariamente aproveitaremos o front que rafael fez para isso injetando dados
        //$this->my_affilliates_group_3 = User::where('bonus3_superiorhierarquico_user_id', '=', Auth::id())->get();
        //$this->number_affiliates_hierarquia = $this->my_affilliates_group_3->count();

        $this->my_affilliates_group_3 = $user->childrens()->limit(6)->get();
        $this->number_affiliates_hierarquia = count($this->my_affilliates_group_3);


        //Imprimir na div
        //Top Afiliados essa lista (nome e email)

        //Consultar TOP afiliados (do ciclo atual) ****************************************************************
        //Consultar TOP afiliados (do ciclo atual) ****************************************************************


        // Resumo demográfico (do ciclo atual) ****************************************************************
        // Resumo demográfico (do ciclo atual) ****************************************************************

        //Fazer considerando os campos 'birth_date' e  'gender'


        // Resumo demográfico (do ciclo atual) ****************************************************************
        // Resumo demográfico (do ciclo atual) ****************************************************************


        // 1) Consultar países que forneceram mais afiliados (do ciclo atual) Máx: 8   e 2) array todos países que forneceram ao menos 1 afiliado ************************
        // 1) Consultar países que forneceram mais afiliados (do ciclo atual) Máx: 8   e 2) array todos países que forneceram ao menos 1 afiliado ************************


        //1) listá-los na barra lateral (Máx: 8)
        // PENDENTE ************************************
        // PENDENTE ************************************
        // PENDENTE ************************************
        // PENDENTE ************************************


        //2) passar esse arrayPPP p/ o JS, e na linha 1146 da view (JS), se o país corrente estiver contido no arrayPPP, colori-lo de vermelho.


        // $this->arrCountries = implode('##', $arrCountries);


        // 1) Consultar países que forneceram mais afiliados (do ciclo atual) e 2) array todos países que forneceram ao menos 1 afiliado *********************************
        // 1) Consultar países que forneceram mais afiliados (do ciclo atual) e 2) array todos países que forneceram ao menos 1 afiliado *********************************


        // =========================================================================

        // No código do rafael abaixo, considerar o ciclo atual: $this->bonus3_semanapagamento

        // =========================================================================

        $this->accountid = getAccountIdSession();
        $account_user_bonus3 = $this->accountid;

        $this->account_owner_bonus_3 = $this->RevenueShareTotal;

        $where = ['bonus3_superiorhierarquico_user_id' => $user->id, 'bonus3_nivelhierarquico' => Bonus3LevelsGroupsEnum::Supervisor];
        $total_my_affilliates_supervisor = User::where($where)->count();
        // echo $total_my_affilliates_supervisor; echo '<br/>';
        // echo $total_my_affilliates_supervisor / 100;
        // exit;
        $this->my_affilliates_supervisor = ($total_my_affilliates_supervisor / 100) * $total_my_affilliates_supervisor;
        $niveis = Bonus3LevelsGroupsEnum::getValues();
        foreach ($niveis as $nl) {
            if ($nl != Bonus3LevelsGroupsEnum::Master) {
                $group = strtolower($nl);
                $index = "my_affilliates_" . $group;
                $where = ['bonus3_superiorhierarquico_user_id' => $user->id, 'bonus3_nivelhierarquico' => $group];
                $this->$index = User::where($where)->count();
            }
        }


        $this->account_group3 = $user;


        // Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados |
        // Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados |
        // Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados |
        // Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados | Raio X de afiliados |


        $this->bar_green = $this->barGreen($account_user_bonus3);
        $this->bar_red = $this->barRed($account_user_bonus3);
        $this->interesses = $this->getInteresses();
        $this->ganho_aquisicao = $this->ganhoPorAquisicao();
        $this->resumo_grafico = $this->resumoGeografico();
    }


    public function render()
    {

        //CONSULTAR OS PLAYERS QUE FORAM CONVIDADOS PELO USUARIO LOGADO
        $this->userId = Auth::id();


        //ANTES AQUI ABAIXO HAVIA UMA CONDIÇÃO QUE CONSIDERAVA O BÔNUS 3, COMO ISSO É PARA INDICAÇÃO APENAS, REMOVI;

        $this->last_invites = User::where('invite_code', '=', Auth::user()->my_invite_code)->limit(5)->orderBy('created_at', 'desc')->get();

        $this->invitesCount = $this->last_invites->count();


        return view('livewire.referral.xray');
    }

    private function bar($account_id, $isGreen)
    {

        $user = Auth::user();
        $from = date('Y') . "-01-01";
        $to = date('Y') . "-12-31";

        $account = $user->accounts()->first();
        $rows = $account->bonuses()->select(DB::raw("UPPER(DATE_FORMAT(created_at, '%b')) as mes,SUM(amount) as total"))
            ->isBonus3()->whereDate("created_at", ">=", $from)->whereDate("created_at", "<=", $to);
        $groupBy = DB::raw("UPPER(DATE_FORMAT(created_at, '%b'))");
        if ($isGreen) {
            $results = $rows->isGreen()->groupBy($groupBy);
        } else {
            $results = $rows->isRed()->groupBy($groupBy);
        }

        $data = [];
        $meses = ['JAN', 'FEV', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

        foreach ($results as $key => $item) {
            foreach ($meses as $mes) {
                if ($item->mes == $mes) {
                    $data[] = $item->total;
                } else {
                    $data[] = 0;
                }
            }
        }

        return $data;
    }

    private function barGreen($account_id)
    {

        return $this->bar($account_id, true);
    }

    private function barRed($account_id)
    {
        return $this->bar($account_id, false);

    }

    private function getInteresses()
    {
        $user = Auth::user();

        $accountsIds = $user->getAffAccountsIds();
        $data = [];
        $gamesIds = Bet::select(DB::raw("distinct(games_id) as gid"))->whereIn("accounts_id", $accountsIds)->limit(4)->get()->pluck("gid");
        $total = (float)Bet::whereIn("accounts_id", $accountsIds)->limit(4)->orderBy("amount", "desc")->sum("amount");
        foreach ($gamesIds as $gId) {
            $game = \App\Models\Game::where("id", $gId)->select("name")->first();
            $a = (float)Bet::whereIn("accounts_id", $accountsIds)->sum("amount");

            $qty = ($a * 100);
            if ($qty > 0 && $total > 0) {
                $perc = safeDiv($qty, $total);
            } else {
                $perc = 0;
            }

            $data[] = [
                'name' => $game->name,
                'perc' => number_format($perc, 2, '.', '')
            ];
        }

        return $data;
    }

    private function ganhoPorAquisicao()
    {
        $user = Auth::user();

        $accountsIds = $user->getAffAccountsIds();

        return (float)Bonus::where("group_tipo", 1)->whereIn("accounts_id", $accountsIds)->sum("amount");
    }

    private function resumoGeografico()
    {
        $user = Auth::user();
        $query = $user->childrens()->select(DB::raw("count(state) as total, state"))->groupBy("state")->get();
        $data = [];
        $estados = ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MS', 'MT', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];
        foreach ($estados as $key => $item) {
            $data[$key] = [
                "id" => "BR-" . $item,
                "uf" => $item,
                "value" => 0,
                "bandeira" => bandeiras($item)
            ];
        }

        foreach ($query as $item) {
            foreach ($estados as $key => $est) {
                if ($est == $item->state) {
                    $data[$key] = [
                        "id" => "BR-" . $item->state,
                        "uf" => $item->state,
                        "value" => $item->total,
                        "bandeira" => bandeiras($item->state)
                    ];
                }
            }
        }

        return json_encode($data);
    }

}
