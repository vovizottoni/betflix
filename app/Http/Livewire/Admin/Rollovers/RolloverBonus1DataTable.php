<?php

namespace App\Http\Livewire\Admin\Rollovers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\util\Util;
use Yajra\DataTables\Datatables;

class RolloverBonus1DataTable extends Controller
{

    public function DataTable()
    {
        // Alterar par = s após implementação! 
        $model = User::query()
            ->select(
                '*',
                \DB::raw('(select sum(bets.amount) from accounts left join bets on accounts.id = bets.accounts_id where accounts.users_id = users.id AND bets.result = "green") as profit'),

            )
            ->where([['rollover_bonus1_opcao', '=', 's']]);


        return Datatables::of($model)
            ->addColumn('reached_goal', function ($row) {
                return 'Não';
            })
            ->addColumn('progress', function ($row) {
                return 'progress';
            })
            ->editColumn('rollover_bonus1_valorObjetivo', function ($row) {
                return Util::currency($row->rollover_bonus1_valorObjetivo);
            })
            ->editColumn('progress', function ($row) {

                if ($row->profit > 0 && $row->rollover_bonus1_valorObjetivo > 0) {
                    $goal = $row->rollover_bonus1_valorObjetivo;
                    $percentage = bcdiv(bcmul(100.0, $row->profit), $goal, 2);
                    return \App\Util\Util::currency($row->profit) . ' / ' . \App\Util\Util::currency($goal) . ' <span style="float: right;font-weight: bold;">' . \App\Util\Util::formatPercentage($percentage) . '</span> <br><progress class="progress w-full" value="' . $percentage . '" max="' . $goal . '"></progress>';
                }
            })

            ->filterColumn('rollover_bonus1_valorObjetivo', function ($query, $keyword) {

                $amount = $keyword;
                $amount = explode(',', $amount);
                $amount = str_replace('.', '', $amount[0]) . (isset($amount[1]) ? '.' . $amount[1] : '');
                $query->where('rollover_bonus1_valorObjetivo', $amount);
            })
            ->rawColumns(['progress'])
            ->make(true);
    }

    public function DataTableColumn()
    {

        $DataTableColumn = new Util;
        $fields = [

            [
                'data' => 'id',
                'title' => __('#ID'),
            ],
            [
                'data' => 'name',
                'title' => __('Usuário'),
            ],

            [
                'data' => 'my_invite_code',
                'title' => __('NickNames'),
            ],

            [
                'data' => 'rollover_bonus1_valorObjetivo',
                'title' => __('Objetivo Rollover'),
            ],

            [
                'data' => 'progress',
                'title' => __('Progresso'),
            ],

            [
                'data' => 'reached_goal',
                'title' => __('Atingiu Objetivo'),
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
