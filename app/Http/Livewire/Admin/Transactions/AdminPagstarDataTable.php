<?php

namespace App\Http\Livewire\Admin\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\util\Util;
use Yajra\DataTables\Datatables;
use View;


class AdminPagstarDataTable extends Controller
{
    public function DataTable()
    {

        $model = Transaction::query()->select(
            '*',
            \DB::raw("(SELECT distinct users.my_invite_code from accounts inner join users on accounts.users_id = users.id where accounts.id = transactions.accounts_id) as username"),
        );

        return Datatables::of($model)
            ->setRowAttr(
                [
                    'style' => function ($transaction) {
                        switch ($transaction->status) {
                            case 'paid':
                                return 'background-color: #deffc3; color: #fff';
                                break;
                            case 'drawee':
                                return 'background-color: #ff000033; color: #fff';
                                break;
                            default:
                                return 'background-color: #bbb; color: #fff';
                                break;
                        }
                    }
                ]
            )
            ->editColumn('amount', function ($row) {
                return Util::currency($row->amount);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y');
            })
            ->editColumn('status', function ($row) {
                $util = new Util;
                return $util->formatStatus($row->status);
            })
            ->filterColumn('username', function ($query, $keyword) {
                $query->whereRaw(
                    "(SELECT distinct users.my_invite_code from accounts inner join users on accounts.users_id = users.id where accounts.id = transactions.accounts_id) like ?",
                    ["%{$keyword}%"]
                );
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                if (strlen($keyword) === 2) {
                    $query->whereDay('created_at', $keyword);
                }
                if (strlen($keyword) === 5) {
                    $date = explode('/', $keyword);
                    $query->whereDay('created_at', $date[0]);
                    $query->whereMonth('created_at', $date[1]);
                }
                if (strlen($keyword) === 10) {
                    $date = explode('/', $keyword);
                    $query->whereDay('created_at', $date[0]);
                    $query->whereMonth('created_at', $date[1]);
                    $query->whereYear('created_at', $date[2]);
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                if (strtolower($keyword) !== 'all') {
                    return $query->where('status', $keyword);
                }
            })

            ->filterColumn('amount', function ($query, $keyword) {

                $amount = $keyword;
                $amount = explode(',', $amount);
                $amount = str_replace('.', '', $amount[0]) . (isset($amount[1]) ? '.' . $amount[1] : '');

                $query->where('amount', $amount);
            })

            ->rawColumns(['active', 'action'])
            ->make(true);
    }

    public function DataTableColumn()
    {

        $DataTableColumn = new Util;
        $fields = [

            [
                'data' => 'amount',
                'title' => 'Valor',
            ],
            [
                'data' => 'type',
                'title' => 'Tipo',
            ],
            [
                'data' => 'status',
                'title' => 'Status',
            ],
            [
                'data' => 'username',
                'title' => 'Usuário',
            ],
            [
                'data' => 'created_at',
                'title' => 'Data',
            ],
            [
                'data' => 'transaction_code',
                'title' => 'Código de Transação',
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
