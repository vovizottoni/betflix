<?php

namespace App\Http\Livewire\Admin\Bonus3;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\util\Util;
use Yajra\DataTables\Datatables;
use View;


class Bonus3DataTable extends Controller
{

    public function DataTable()
    {

        $model = User::query()->select(
            '*',

            \DB::raw("(SELECT hierarchical.name FROM `users` as hierarchical WHERE hierarchical.id = users.bonus3_superiorhierarquico_user_id) as hierarchical_superior_name"),
            \DB::raw("(SELECT hierarchical.bonus3_nivelhierarquico FROM `users` as hierarchical WHERE hierarchical.id = users.bonus3_superiorhierarquico_user_id) as hierarchical_superior_nivel"),

        )
            ->where([['users.role', '=', 'player']]);


        $group_master = User::where([['bonus3_nivelhierarquico', '=', 'master'], ['active', '=', 's']])->get();
        $group_supervisor = User::where([['bonus3_nivelhierarquico', '=', 'supervisor'], ['active', '=', 's']])->get();
        $group_gerente = User::where([['bonus3_nivelhierarquico', '=', 'gerente'], ['active', '=', 's']])->get();


        return Datatables::of($model)

            ->editColumn('active', function ($row) {
                if ($row->active === 'n') {
                    return '<div class="flex red-badge"> Usuário Bloqueado </div>';
                } else {
                    return '<div class="flex green-badge"> Usuário Ativo </div>';
                }
            })

            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y');
            })

            ->editColumn('bonus3_nivelhierarquico', function ($row) {
                return ($row->bonus3_nivelhierarquico) ? 'Possui' : 'Não Possui';
            })

            ->addColumn('nivel', function ($row) {
                return ($row->bonus3_nivelhierarquico) ? $row->bonus3_nivelhierarquico : '--';
            })
            ->orderColumn('nivel', function ($query, $order) {
                $query->orderBy('bonus3_nivelhierarquico', $order);
            })

            ->editColumn('hierarchical_superior_name', function ($row) {

                $name = $row->hierarchical_superior_name;

                return ($name) ? $name . '<br> <b>(' . $row->hierarchical_superior_nivel . ')</b> ' : '--';
            })

            ->filterColumn('bonus3_nivelhierarquico', function ($query, $keyword) {
                if ($keyword !== 'all') {
                    if ($keyword === 's') {
                        $query->whereNotNull('bonus3_nivelhierarquico');
                    }
                    if ($keyword === 'n') {
                        $query->whereNull('bonus3_nivelhierarquico');
                    }
                }
            })

            ->filterColumn('hierarchical_superior_name', function ($query) {
            })
            ->filterColumn('hierarchical_superior_nivel', function ($query) {
            })

            ->filterColumn('active', function ($query, $keyword) {
                if (strtolower($keyword) !== 'todos') {
                    return $query->where('active', $keyword);
                }
            })

            ->addColumn('action', function ($row) use ($group_master, $group_supervisor, $group_gerente) {

                $columns = new PaymentsHistoryDataTable();
                $columns =  $columns->DataTableColumn();

                return View::make('livewire.admin.bonus3.actions', [
                    'row' => $row,
                    'columns' => $columns,
                    'group_master' => $group_master,
                    'group_supervisor' => $group_supervisor,
                    'group_gerente' => $group_gerente,
                ])->render();
            })

            ->rawColumns(['active', 'action', 'hierarchical_superior_name'])
            ->make(true);
    }

    public function DataTableColumn()
    {

        $DataTableColumn = new Util;
        $fields = [
            [
                'data' => 'name',
                'title' => 'Nome',
            ],
            [
                'data' => 'email',
                'title' => 'E-mail',
            ],
            [
                'data' => 'created_at',
                'title' => 'Data de Cadastro',
            ],
            [
                'data' => 'bonus3_nivelhierarquico',
                'title' => 'Revenue Share',
            ],
            [
                'data' => 'nivel',
                'title' => 'Nível',
            ],
            [
                'data' => 'hierarchical_superior_name',
                'title' => 'Superior Hierárquico',
            ],
            [
                'data' => 'bonus3_percentual',
                'title' => 'Percentual',
            ],
            // [
            //     'data' => 'rev_share',
            //     'title' => 'Revenue Share',
            // ],
            // [
            //     'data' => 'bonus3_nivelhierarquico',
            //     'title' => 'Nível',
            // ],
            // [
            //     'data' => 'bonus3_nivelhierarquico',
            //     'title' => 'Superior Hierárquico',
            // ],
            // [
            //     'data' => 'bonus3_nivelhierarquico',
            //     'title' => 'Percentual',
            // ],
            [
                'data' => 'active',
                'title' => 'Status',
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
        if (request()->ajax()) {
            return $this->DataTable();
        }
    }
}
