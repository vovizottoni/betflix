<?php

namespace App\Http\Controllers;

use App\Enums\HypetechResults;
use App\Services\HypetechService;
use Illuminate\Http\Request;



class HypetechController extends Controller
{

    //******************************************************************************************* */
    // User Can Bet?
    // User Can Bet?
    private $hypeService;

    public function __construct()
    {

        $this->hypeService = new HypetechService();

    }

    public function register(Request $req)
    {
        $hypeService = $this->hypeService;
        $callback = function ($req, $instance) {
            $instance->processRegister($req);
        };
        return $hypeService->processRequest($req, $callback);
    }



    //******************************************************************************************* */
    // UPDATE BET (green)
    // UPDATE BET (green)

    public function wins(Request $req)
    {
        $hypeService = $this->hypeService;
        $callback = function ($req, $instance) {
            $instance->processBetResult($req, HypetechResults::Green);
        };
        return $hypeService->processRequest($req, $callback);
    }
    //******************************************************************************************* */


    //******************************************************************************************* */
    // UPDATE BET (red)
    // UPDATE BET (red)

    public function lose(Request $req)
    {
        $hypeService = $this->hypeService;
        $callback = function ($req, $instance) {
            $instance->processBetResult($req, HypetechResults::Red);
        };
        return $hypeService->processRequest($req, $callback);
    }



    //******************************************************************************************* */
    // CANCEL BET (ate 5 segs antes de iniciar o jogo)
    // CANCEL BET (ate 5 segs antes de iniciar o jogo)

    //******************************************************************************************* */
    public function rollback(Request $req)
    {
        $hypeService = $this->hypeService;
        $callback = function ($req, $instance) {
            $instance->processBetResult($req, HypetechResults::Canceled);
        };
        return $hypeService->processRequest($req, $callback);

    }
    /************************************************************************** */
}
