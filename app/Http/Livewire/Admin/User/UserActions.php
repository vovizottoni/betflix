<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserActions extends Controller
{
    public function updateGroup(Request $request, $user_id)
    {
        # Init transaction
        \DB::beginTransaction();


        try {
            User::where([['id', '=', $user_id]])->update([
                'group_id' => $request->input('group_id'),
            ]);

            \DB::commit();
        } catch (\Exception $e) {
            //throw $th;
            session()->flash('error', $e->getMessage());


            \DB::rollback();
            return redirect()->back()->withInput();
        }
        session()->flash('message_group', 'Grupo Alterado!');
        return redirect(route('admin.manageruser'));
    }

    public function updatePassword(Request $request, $user_id)
    {
        # Init transaction 
        \DB::beginTransaction();
        try {

            User::where([['id', '=', $user_id]])->update([
                'password' => bcrypt($request->input('password')),
            ]);

            \DB::commit();
        } catch (\Exception $e) {
            //throw $th;
            session()->flash('error', $e->getMessage());


            \DB::rollback();
            return redirect()->back()->withInput();
        }

        session()->flash('message_password', 'Senha Alterada!');
        return redirect(route('admin.manageruser'));
    }

    public function updateCpf(Request $request, $user_id)
    {
        # Init transaction 
        \DB::beginTransaction();
        try {

            User::where([['id', '=', $user_id]])->update([
                'cpf' =>  preg_replace('/[^0-9]/', '', $request->input('cpf')),
            ]);

            \DB::commit();
        } catch (\Exception $e) {
            //throw $th;

            session()->flash('error', $e->getMessage());


            \DB::rollback();
            return redirect()->back()->withInput();
        }

        session()->flash('message_password', 'CPF Alterado!');
        return redirect(route('admin.manageruser'));
    }

    public function update2fa(Request $request, $user_id)
    {
        # Init transaction
        \DB::beginTransaction();
        try {
            User::where([['id', '=', $user_id]])->update([
                'two_factor_confirmed_at' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_secret' => null
            ]);

            \DB::commit();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());


            \DB::rollback();
            return redirect()->back()->withInput();
        }
        session()->flash('message_2fa', 'Autenticação em dois fatores desabilitada!');
        return redirect(route('admin.manageruser'));
    }

    public function updateUser(Request $request, $user_id)
    {

        # Init transaction
        \DB::beginTransaction();
        try {
            User::where([['id', '=', $user_id]])->update([
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'birth_date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('birth_date_'))->format('Y-m-d'),
            ]);

            \DB::commit();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            //throw $th;
            \DB::rollback();
            return redirect()->back()->withInput();
        }

        session()->flash('message_account', 'Dados do usuário alterados com sucesso!');
        return redirect(route('admin.manageruser'));
    }

    public function updateStatus(Request $request, $user_id)
    {
        # Init transaction
        \DB::beginTransaction();
        try {

            $user = User::find($user_id);

            if ($user->active == 's') {
                $user->update([
                    'active' => 'n'
                ]);
            } else {
                $user->update([
                    'active' => 's'
                ]);
            }

            \DB::commit();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            //throw $th;
            \DB::rollback();
            return redirect()->back()->withInput();
        }

        session()->flash('message_status', 'Status Alterado!');
        return redirect(route('admin.manageruser'));
    }
}
