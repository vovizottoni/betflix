<?php

namespace App\Http\Livewire\Admin\Bonus3;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use App\Models\Bet;
use App\Models\Bonus;
use App\util\Util;
use Yajra\DataTables\Datatables;
use View;

class PaymentsHistoryDataTable extends Controller
{

    public function DataTable($id)
    {

        $accounts = Account::where('users_id', $id)->pluck('id')->toArray();

        $model = Bonus::query()->select(
            '*'
        )->where([['group_tipo', '=', '3']])->whereIn('accounts_id', $accounts);

        return Datatables::of($model)
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y \a\s H:i:s');
            })
            ->editColumn('amount', function ($row) {
                return Util::currency($row->amount);
            })
            ->editColumn('bonus3_sinal', function ($row) {
                return $row->bonus3_sinal === '+' ? 'Green' : 'Red';
            })
            ->editColumn('bonus3_processado', function ($row) {
                return $row->bonus3_processado === 's' ? 'Sim' : 'Não';
            })
            ->editColumn('pagou', function ($row) {
                return $row->pagou === 's' ? 'Sim' : 'Não';
            })
            ->editColumn('bonus3_valordopagamentosemanal', function ($row) {
                return Util::currency($row->bonus3_valordopagamentosemanal);
            })
            ->rawColumns(['active', 'action'])
            ->make(true);
    }

    public function DataTableColumn()
    {

        $DataTableColumn = new Util;
        $fields = [
            [
                'data' => 'id',
                'title' => '#ID',
            ],
            [
                'data' => 'created_at',
                'title' => 'Data',
            ],
            [
                'data' => 'bets_id',
                'title' => 'Código da Aposta',
            ],
            [
                'data' => 'amount',
                'title' => 'Valor do Bônus',
            ],
            [
                'data' => 'bonus3_sinal',
                'title' => 'Green/Red',
            ],
            [
                'data' => 'bonus3_semanapagamento',
                'title' => 'Semana',
            ],
            [
                'data' => 'bonus3_processado',
                'title' => 'Pagamento Processado?',
            ],
            [
                'data' => 'pagou',
                'title' => 'Recebeu B3?',
            ],
            [
                'data' => 'bonus3_valordopagamentosemanal',
                'title' => 'Valor Recebido nessa Semana',
            ],
        ];
        $js = $DataTableColumn->getColumns('js', $fields);
        $table = $DataTableColumn->getColumns('table', $fields);

        return (object) [
            'js' => $js,
            'table' => $table,
        ];
    }

    public function index($id)
    {
        if (request()->ajax()) {
            return $this->DataTable($id);
        }
    }
}
