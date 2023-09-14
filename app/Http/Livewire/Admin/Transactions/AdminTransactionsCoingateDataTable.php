<?php

namespace App\Http\Livewire\Admin\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\util\Util;
use Yajra\DataTables\Datatables;
use View;


class AdminTransactionsCoingateDataTable extends Controller
{
    public function DataTable()
    {

        $model = Transaction::query()->select(
            '*',
        );

        return Datatables::of($model)

            ->rawColumns(['active', 'action'])
            ->make(true);
    }

    public function DataTableColumn()
    {

        $DataTableColumn = new Util;
        $fields = [
            [
                'data' => 'created_at',
                'title' => 'Data',
            ],
            [
                'data' => 'created_at',
                'title' => 'Data',
            ],
            [
                'data' => 'created_at',
                'title' => 'Data',
            ],
            [
                'data' => 'created_at',
                'title' => 'Data',
            ],
            [
                'data' => 'created_at',
                'title' => 'Data',
            ],
            [
                'data' => 'created_at',
                'title' => 'Data',
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
