<?php

namespace App\Http\Livewire\Admin\Bets;

use App\Models\Bet;
use Livewire\Component;

class AdminBets extends Component
{
    public $total_bets = 0;
    public $pay_bets = 0;
    public $ggr = 0;
    public function mount()
    {
        $this->total_bets = $this->totalBets();
        $this->pay_bets = $this->payBets();
        $this->ggr = $this->calculateGGR();

    }

    public function totalBets()
    {
        $total_bets = Bet::select('amount')->sum('amount');
        $this->total_bets = $total_bets;
        return $total_bets;
    }

    public function payBets()
    {
        $pay_amount = Bet::where('result', 'green')
        ->selectRaw('SUM(amount * (odd - 1)) as pay_amount')
        ->value('pay_amount');


        $this->pay_bets = $pay_amount;

        return $pay_amount;
    }

    public function calculateGGR()
    {
        $totalBets = Bet::select('amount')->sum('amount'); // Valor total das apostas realizadas
        $totalWinningBets = $this->payBets();
        $ggr = $totalBets - $totalWinningBets;

        $ggrPercentage = ($ggr / $totalBets) * 100; // Cálculo da porcentagem do GGR

        $arrResult = [
            'total' => $ggr,
            'percentage' => $ggrPercentage
        ];
        $this->ggr = $arrResult;

        return $arrResult;
    }


    public function render()
    {

        $columns = new AdminBetsDataTable();
        $columns = $columns->DataTableColumn();

        return view('livewire.admin.bets.admin-bets', [
            'columns' => $columns,
        ]);
    }
}
