<?php

namespace App\Http\Livewire\Admin\Kyc;

use Livewire\Component;

//libs
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

//models
use App\Models\User;


class Kyc extends Component
{
    //redireciona para a página com detalhes do usuario
    public function details($user_id)
    {
        session()->put('user_id', $user_id);
        redirect()->route('admin.kyc-details', ['user_id' => $user_id]);
    }

    public function render()
    {
        $columns = new KycDataTable();
        $columns = $columns->DataTableColumn();

        return view('livewire.admin.kyc.kyc', [
            'columns' => $columns,
        ]);
    }
}
