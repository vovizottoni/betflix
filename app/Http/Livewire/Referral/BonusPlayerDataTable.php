<?php

namespace App\Http\Livewire\Referral;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bonus;
use App\util\Util;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use View;
use Yajra\DataTables\EloquentDataTable;


class BonusPlayerDataTable extends Controller
{

    public function DataTable()
    {
        $user = Auth::user();
        $model = Bonus::withUserJsonJoin()->where("users.user_id", $user->id)
            ->where('bonus.group_tipo', 2);
        return (new EloquentDataTable($model))
            ->editColumn('name', function ($row) {
                return $row->my_invite_code . '<br><b>' . $row->name . '</b>';
            })
            ->addColumn('type', function ($query) {
                return 'Bônus CPA';
            })
            ->addColumn('status', function ($query) {

                $created = new Carbon($query->created_at);
                $now = Carbon::now();

                return ($created->diff($now)->days > 7) ? '<span class="text-sm"
                style="background: #00ff5a33; width: fit-content; height: fit-content; border-radius: 3px; padding: 0 10px; border: 1px solid #00ff704d; color: #00ff92c9;">Pago</span>' : '<span class="text-sm"
                style="background: #ffbb0033; width: fit-content; height: fit-content; border-radius: 3px; padding: 0 10px; border: 1px solid #ffbf004d; color: #ffbf00c9;">Em
                Processamento</span>';
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->orWhere("name", "like", "%$keyword%");
                    $q->orWhere("my_invite_code", "like", "%$keyword%");
                });
            })
            ->editColumn('amount', function ($row) {
                return Util::currency($row->amount);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y \a\s H:i:s');
            })
            ->rawColumns(['active', 'action', 'name', 'status'])
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
                'data' => 'name',
                'title' => 'Usuário',
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
                'data' => 'created_at',
                'title' => 'Data',
            ],
            [
                'data' => 'amount',
                'title' => 'Valor',
            ],
        ];
        $js = $DataTableColumn->getColumns('js', $fields);
        $table = $DataTableColumn->getColumns('table', $fields);

        return (object)[
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
