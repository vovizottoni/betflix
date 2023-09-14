<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class ExternalApiController extends Controller
{
    public function checkFirstDeposit(Request $req)
    {
        $data = $req->all();
        $email = $data['email'];

        if(!$email){
            return response()->json([
                "code" => 400,
                "message" => 'Email Not Found'
            ], 400);
        }
 
        $user = User::where([['email', '=', $email]])->select('id')->first();

        if(!$user){
            return response()->json([
                "code" => 400,
                "message" => 'User not Found'
            ], 400);
        }
            
        $accounts_user = Account::where([['users_id', '=', $user->id]])->pluck('id')->toArray();
        $transactions_paid_user = Transaction::whereIn('accounts_id', $accounts_user)->where([['status', '=', 'paid']])->get()->count();
       
        if($transactions_paid_user > 0){
            return response()->json([
                "code" => 200,
                "message" => true
            ], 200);

        }else{
            return response()->json([
                "code" => 200,
                "message" => false
            ], 200);
        }
    }
    
    public function checkAffiliateStatus(Request $req)
    {
        $data = $req->all();
        $email = $data['email'];

        if(!$email){
            return response()->json([
                "code" => 400,
                "message" => 'Email Not Found'               
            ], 400);
        }
 
        $user = User::where([['email', '=', $email]])->select('bonus3_nivelhierarquico')->first();

        if(!$user){
            return response()->json([
                "code" => 400,
                "message" => 'User not Found'
            ], 400);
        }

        if($user->bonus3_nivelhierarquico){
            return response()->json([
                "code" => 200,
                "message" => true
            ], 200);
            
        }else{
            return response()->json([
                "code" => 200,
                "message" => false
            ], 200);
        }
    }
}
