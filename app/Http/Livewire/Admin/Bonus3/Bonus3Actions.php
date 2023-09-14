<?php

namespace App\Http\Livewire\Admin\Bonus3;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class Bonus3Actions extends Controller
{
    public function desactive($id)
    {
        # Init transaction
        \DB::beginTransaction();

        try {
            $user = User::where([['id', '=', $id]]);

            $user->update([
                'bonus3_nivelhierarquico' => NULL,
                'bonus3_superiorhierarquico_user_id' => NULL,
                'bonus3_percentual' => NULL,
            ]);

            # commit
            \DB::commit();
            session()->flash('message_group', 'Bônus 3 removido com sucesso!');
        } catch (\Exception $e) {
            #rollback
            \DB::rollback();
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('admin.bonus3');
    }

    public function add(Request $request, $id)
    {
        # Init transaction
        \DB::beginTransaction();

        try {


            $user = User::where([['id', '=', $id]]);

            $percentage = (float) rtrim($request->input('percentage'), "%");

            if ($request->input('nivel') === 'master') {

                if ($percentage >= 1 && $percentage <= 100) {
                } else {
                    throw ValidationException::withMessages(['bonus3_percentual' => 'O percentual deve ser entre 1% e 100%.']);
                }

                $user->update([
                    'bonus3_nivelhierarquico' => 'master',
                    'bonus3_percentual' => $percentage,
                ]);
            }

            if ($request->input('nivel') === 'supervisor') {

                $master_aux__ = User::where([['id', '=', $request->input('group_master')]])->first();
                $master_aux__->bonus3_percentual = (int) $master_aux__->bonus3_percentual;

                if ($percentage < $master_aux__->bonus3_percentual) {
                } else {
                    throw ValidationException::withMessages(['bonus3_percentual' => 'O percentual deve ser entre 1% e ' . $master_aux__->bonus3_percentual . '%.']);
                }

                $user->update([
                    'bonus3_nivelhierarquico' => 'supervisor',
                    'bonus3_superiorhierarquico_user_id' => $request->input('group_master'),
                    'bonus3_percentual' => $percentage,
                ]);
            }

            if ($request->input('nivel') === 'gerente') {

                $master_aux__ = User::where([['id', '=', $request->input('group_supervisor')]])->first();
                $master_aux__->bonus3_percentual = (int)$master_aux__->bonus3_percentual;

                if ($percentage < $master_aux__->bonus3_percentual) {
                } else {
                    throw ValidationException::withMessages(['bonus3_percentual' => 'O percentual deve ser entre 1% e ' . $master_aux__->bonus3_percentual . '%.']);
                }

                $user->update([
                    'bonus3_nivelhierarquico' => 'gerente',
                    'bonus3_superiorhierarquico_user_id' => $request->input('group_supervisor'),
                    'bonus3_percentual' => $percentage,
                ]);
            }

            if ($request->input('nivel') === 'subgerente') {

                $master_aux__ = User::where([['id', '=', $request->input('group_gerente')]])->first();
                $master_aux__->bonus3_percentual = (int)$master_aux__->bonus3_percentual;

                if ($percentage < $master_aux__->bonus3_percentual) {
                } else {
                    throw ValidationException::withMessages(['bonus3_percentual' => 'O percentual deve ser entre 1% e ' . $master_aux__->bonus3_percentual . '%.']);
                }

                $user->update([
                    'bonus3_nivelhierarquico' => 'subgerente',
                    'bonus3_superiorhierarquico_user_id' => $request->input('group_gerente'),
                    'bonus3_percentual' => $percentage,
                ]);
            }

            # commit
            \DB::commit();
            session()->flash('message_group', 'Bônus 3 adicionado com sucesso!');
        } catch (\Exception $e) {

            #rollback
            \DB::rollback();
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('admin.bonus3');
    }
}
