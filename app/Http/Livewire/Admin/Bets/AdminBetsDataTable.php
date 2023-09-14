<?php

namespace App\Http\Livewire\Admin\Bets;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Bet;
use App\util\Util;
use Yajra\DataTables\Datatables;
use View;


class AdminBetsDataTable extends Controller
{
    public $util;
    public function __construct()
    {
        $this->util = new Util();
    }

    public function DataTable()
    {

        $model = Bet::query()->select(
            '*',
            \DB::raw("(SELECT games.name FROM `games` WHERE games.id = bets.games_id) as game_name"),
            // \DB::raw("(SELECT accounts.users_id FROM `accounts` WHERE accounts.id = bets.accounts_id) as account_user_id"),
            \DB::raw("(SELECT distinct users.my_invite_code from accounts inner join users on accounts.users_id = users.id where accounts.id = bets.accounts_id) as nickname"),

        );

        return Datatables::of($model)

            ->editColumn('balance_used', function ($row) {
                return $this->util->formatBalance($row->balance_used) . ' BRL';
            })
            ->editColumn('amount', function ($row) {
                return Util::currency($row->amount);
            })
            ->editColumn('result', function ($row) {
                if ($row->result === 'red') {
                    return '<span class="red-badge">' . __('admin_bets.' . $row->result) . '</span>';
                }
                if ($row->result === 'green') {
                    return '<span class="green-badge">' . __('admin_bets.' . $row->result) . '</span>';
                }
                else {
                    return '<span class="red-badge bg-gray-300">' . __('admin_bets.' . $row->result) . '</span>';
                }
                // return __('admin_bets.' . $row->result);
            })
            ->editColumn('odd', function ($row) {
                return $row->odd . 'x';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y \a\s H:i:s');
            })

            ->filterColumn('game_name', function ($query, $keyword) {
                $query->whereRaw(
                    "(SELECT games.name FROM `games` WHERE games.id = bets.games_id) like ?",
                    ["%{$keyword}%"]
                );
            })
            ->filterColumn('result', function ($query, $keyword) {
                if ($keyword !== 'all') {
                    $query->where('result', $keyword);
                }
            })

            ->filterColumn('nickname', function ($query, $keyword) {
                $query->whereRaw(
                    "(SELECT distinct users.my_invite_code from accounts inner join users on accounts.users_id = users.id where accounts.id = bets.accounts_id) like ?",
                    ["%{$keyword}%"]
                );
            })

            ->filterColumn('amount', function ($query, $keyword) {

                $amount = $keyword;
                $amount = explode(',', $amount);
                $amount = str_replace('.', '', $amount[0]) . (isset($amount[1]) ? '.' . $amount[1] : '');

                $query->where('amount', $amount);
            })

            ->rawColumns(['active', 'action', 'result'])
            ->make(true);
    }

    public function DataTableColumn()
    {

        $DataTableColumn = new Util;
        $fields = [
            [
                'data' => 'game_name',
                'title' => 'Jogo',
            ],
            [
                'data' => 'nickname',
                'title' => 'Apelido',
            ],
            [
                'data' => 'created_at',
                'title' => 'Realizada em',
            ],
            [
                'data' => 'amount',
                'title' => 'Valor',
            ],
            [
                'data' => 'odd',
                'title' => 'Odd',
            ],
            [
                'data' => 'result',
                'title' => 'Resultado',
            ],
            [
                'data' => 'balance_used',
                'title' => 'Saldo Usado',
            ],
            [
                'data' => 'bet_code',
                'title' => 'Código da Aposta',
            ],
        ];
        $js = $DataTableColumn->getColumns('js', $fields);
        $table = $DataTableColumn->getColumns('table', $fields);

        return (object) [
            'js' => $js,
            'table' => $table,
        ];
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->DataTable();
        }
    }
}
