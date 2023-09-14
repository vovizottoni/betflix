<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyInviteCode extends Controller
{
    public function invitecode ($invitecode)
    {
        session()->put('INVITECODE_USED', $invitecode);
        return redirect()->route('register');


    }
}
