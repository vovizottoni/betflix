<?php

namespace App\Http\Livewire\Admin\Kyc;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use App\util\Util;
use Yajra\DataTables\Datatables;
use View;


class KycDataTable extends Controller
{

    public function DataTable()
    {

        $model = User::query()->with('KycValidation')->select(
            '*',
            \DB::raw("(SELECT kyc_validations.kyc_date_submitted FROM `kyc_validations` WHERE kyc_validations.user_id = users.id) as kyc_date_submitted"),
            \DB::raw("(SELECT kyc_validations.kyc_date_analysed FROM `kyc_validations` WHERE kyc_validations.user_id = users.id) as kyc_date_analysed"),

        )->where('kyc_status', '=', 'under_verification');

        return Datatables::of($model)

            ->editColumn('kyc_status', function ($row) {
                return __('admin_kyc.' . $row->kyc_status);
            })
            ->editColumn('kyc_date_submitted', function ($row) {
                return \Carbon\Carbon::parse($row->kyc_date_submitted)->format('d/m/Y');
            })
            ->editColumn('kyc_date_analysed', function ($row) {
                return ($row->kyc_date_analysed) ? \Carbon\Carbon::parse($row->kyc_date_analysed)->format('d/m/Y') : '--';
            })

            ->addColumn('action', function ($row) {
                return View::make('livewire.admin.kyc.actions', [
                    'row' => $row,
                ])->render();
            })

            ->filterColumn('kyc_status', function ($query, $keyword) {
                if (strtolower($keyword) !== 'all') {
                    return $query->where('kyc_status', $keyword);
                } 
            })

            ->filterColumn('kyc_date_submitted', function ($query, $keyword) {
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

            ->filterColumn('kyc_date_analysed', function ($query, $keyword) {
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

            ->rawColumns(['active', 'action'])
            ->make(true);
    }

    public function DataTableColumn()
    {

        $DataTableColumn = new Util;
        $fields = [
            [
                'data' => 'name',
                'title' => __('admin_kyc.name'),
            ],
            [
                'data' => 'email',
                'title' => __('admin_kyc.email'),
            ],
            [
                'data' => 'kyc_status',
                'title' => __('admin_kyc.status'),
            ],
            [
                'data' => 'kyc_date_submitted',
                'title' => __('admin_kyc.submission_date'),
            ],
            [
                'data' => 'kyc_date_analysed',
                'title' => __('admin_kyc.verification_date'),
            ],
            [
                'data' => 'action',
                'title' => __('admin_kyc.options'),
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
