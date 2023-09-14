<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\util\Util;
use Yajra\DataTables\Datatables;
use View;


class UserDataTable extends Controller
{ 

    public function DataTable()
    {

        $model = User::query()->select(
            '*',
            \DB::raw("(SELECT group.name FROM `group` WHERE group.id = users.group_id) as group_name"),
            \DB::raw("(SELECT SUM(balance) FROM accounts WHERE accounts.users_id = users.id) as sum_balance"),
            \DB::raw("(SELECT SUM(balanceBonus) FROM accounts WHERE accounts.users_id = users.id) as sum_balanceBonus"),
        );

        $groups = Group::get();

        return Datatables::of($model)
            // ->addIndexColumn()
            ->editColumn('sum_balance', function ($row) {
                return Util::currency($row->sum_balance);
            })
            ->editColumn('sum_balanceBonus', function ($row) {
                return Util::currency($row->sum_balanceBonus);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d/m/Y');
            })
            ->editColumn('active', function ($row) {
                if ($row->active === 'n') {
                    return '<div class="flex red-badge"> Usuário Bloqueado </div>';
                } else {
                    return '<div class="flex green-badge"> Usuário Ativo </div>';
                }
            })
            ->filterColumn('group_name', function ($query, $keyword) {
                $query->whereRaw(
                    "(SELECT group.name FROM `group` WHERE group.id = users.group_id) like ?",
                    ["%{$keyword}%"]
                );
            })
            ->filterColumn('sum_balance', function ($query, $keyword) {

                $amount = $keyword;
                $amount = explode(',', $amount);
                $amount = str_replace('.', '', $amount[0]) . (isset($amount[1]) ? '.' . $amount[1] : '');


                $query->whereRaw(
                    "(SELECT SUM(balance) FROM accounts WHERE accounts.users_id = users.id) like ?",
                    $amount
                );
            })
            ->filterColumn('sum_balanceBonus', function ($query, $keyword) {
                $amount = $keyword;
                $amount = explode(',', $amount);
                $amount = str_replace('.', '', $amount[0]) . (isset($amount[1]) ? '.' . $amount[1] : '');

                $query->whereRaw(
                    "(SELECT SUM(balanceBonus) FROM accounts WHERE accounts.users_id = users.id) like ?",
                    $amount
                );
            })
            ->filterColumn('active', function ($query, $keyword) {
                if (strtolower($keyword) !== 'todos') {
                    return $query->where('active', $keyword);
                }
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


            ->addColumn('action', function ($row) use ($groups) {
                return View::make('livewire.admin.user.actions', [
                    'row' => $row,
                    'groups' => $groups,
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
                'data' => 'name',
                'title' => __('admin_user_index.name'),
            ],
            [
                'data' => 'email',
                'title' => __('admin_user_index.email'),
            ],
            [
                'data' => 'my_invite_code',
                'title' => 'Apelido',
            ],
            [
                'data' => 'created_at',
                'title' => __('admin_user_index.created'),
            ],
            [
                'data' => 'cpf',
                'title' => 'CPF',
            ],
            [
                'data' => 'group_name',
                'title' => 'Grupo',
            ],
            [
                'data' => 'sum_balance',
                'title' => 'Saldo',
            ],
            [
                'data' => 'sum_balanceBonus',
                'title' => 'Saldo Bônus',
            ],
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
