<?php

namespace App\Http\Livewire\Admin\Transactions\CashoutPagstar;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\util\Util;
use Yajra\DataTables\Datatables;
use View;


class CashoutApprovalDataTable extends Controller
{
    public function DataTable($type)
    {

        $type = ($type === 'affiliated') ? 'NOT NULL' : 'NULL';

        $model = Transaction::query()->select(
            '*',
            \DB::raw("(SELECT distinct users.my_invite_code from accounts inner join users on accounts.users_id = users.id where accounts.id = transactions.accounts_id) as my_invite_code"),
            \DB::raw("(SELECT distinct users.bonus3_nivelhierarquico from accounts inner join users on accounts.users_id = users.id where accounts.id = transactions.accounts_id) as bonus3_nivelhierarquico"),
            \DB::raw("(SELECT SUM(amount) FROM transactions AS T2 WHERE T2.accounts_id = transactions.accounts_id and T2.status = 'paid') as total_cashin"),
            \DB::raw("(SELECT SUM(amount) FROM transactions AS T3 WHERE T3.accounts_id = transactions.accounts_id and T3.status = 'drawee') as total_cashout"),
        )
            ->where('cashout_approval', '=', 'waiting_for_approval')
            ->whereRaw('(
                SELECT DISTINCT users.bonus3_nivelhierarquico
                FROM accounts
                INNER JOIN users ON accounts.users_id = users.id
                WHERE accounts.id = transactions.accounts_id
            ) IS ' . $type)
            ->where('type', 'cashoutPIX')
            ->where('status', 'waiting_for_withdraw');

        return Datatables::of($model)
            ->editColumn('amount', function ($row) {
                return Util::currency($row->amount);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y \a\s H:i:s');
            })
            ->editColumn('total_cashin', function ($row) {
                return Util::currency($row->total_cashin);
            })
            ->editColumn('total_cashout', function ($row) {
                return Util::currency($row->total_cashout);
            })
            ->editColumn('status', function ($row) {
                $util = new Util;
                return $util->formatStatus($row->status);
            })
            ->editColumn('type', function ($row) {
                $util = new Util;
                return $util->formatType($row->type);
            })
            ->editColumn('cashout_approval', function ($row) {
                $util = new Util;
                return $util->formatCashoutApproval($row->cashout_approval);
            })

            ->filterColumn('amount', function ($query, $keyword) {

                $amount = $keyword;
                $amount = explode(',', $amount);
                $amount = str_replace('.', '', $amount[0]) . (isset($amount[1]) ? '.' . $amount[1] : '');

                $query->where('amount', $amount);
            })

            ->addColumn('action', function ($row) {
                return View::make('livewire.admin.transactions.cashout-pagstar.actions', [
                    'row' => $row,
                ])->render();
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
                'data' => 'my_invite_code',
                'title' => 'Solicitante',
            ],
            [
                'data' => 'amount',
                'title' => 'Valor',
            ],
            [
                'data' => 'type',
                'title' => 'Tipo',
            ],
            [
                'data' => 'created_at',
                'title' => 'Data',
            ],
            [
                'data' => 'status',
                'title' => 'Status',
            ],
            [
                'data' => 'total_cashin',
                'title' => 'Total em depósitos',
            ],
            [
                'data' => 'total_cashout',
                'title' => 'Total em saques',
            ],
            [
                'data' => 'cashout_approval',
                'title' => 'Solicitação de Saque',
            ],
            [
                'data' => 'action',
                'title' => 'Ações',
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

        $type = request()->type;

        if (request()->ajax()) {
            return $this->DataTable($type);
        }
    }
}
