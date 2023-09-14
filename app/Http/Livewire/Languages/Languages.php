<?php

namespace App\Http\Livewire\Languages;

use Livewire\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Languages extends Component
{
    public function switchLang($lang)
    {   
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return redirect(request()->header('Referer'));
    }
    
    public function render()
    {
        return view('livewire.languages.languages');
    }
}
