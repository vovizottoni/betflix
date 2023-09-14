<?php

use App\Enums\PaymentGatewaysEnum;
use App\PaymentGateways\PixPaymentGateway;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MyInviteCode;
use App\Http\Controllers\GameController;
use App\Http\Livewire\Admin\Dashboard\DataTable;
use Illuminate\Support\Facades\Redis;
use App\Http\Middleware\VerifyCsrfToken;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::withoutMiddleware([VerifyCsrfToken::class])->group(function () {
    require_once "webhooks.php";
});
Route::get('/ops', function () {

    return request()->ip();

});

Route::get('/rdis_connection2', function () {
    $redis = Redis::connection();
    try {
        var_dump($redis->ping());
    } catch (\Exception $e) {
        $e->getMessage();
    }
});


/* ************************************************************************************************************************ */
// ######################## Rotas Públicas ########################### (Todas devem estar dentro do middleware notplayer, para evitar o problema de sessao expirada)
Route::middleware(['notplayer'])->group(function () {

    Route::get('/', function () {
        return view('livewire/games/games-module');
    })->name('games');
    Route::get('/bonus', function () {
        return view('livewire/bonus/bonus-module');
    })->name('bonus');

    //ROTA PARA CONVITE DE AFILIADOS UTILIZANDO O CODIGO DE CONVITE DE UM INFLUENCIADOR

    Route::get('/affiliate/{invitecode}', [MyInviteCode::class, 'invitecode']);
});

Route::middleware('cache.headers:public;max_age=7200')->get(
    '/manifest.json',
    function () {
        return file_get_contents(public_path('manifest.json'));
    }
);


Route::get('/esportes', function () {
    return view('livewire/fungamess/esportes-module', []);
})->name('fgames.esportes');


Route::get('/fprovider/{name}/{id}', function ($name, $id) {
    return view('livewire/fungamess/provider-games-module', ['name' => $name, 'id' => $id]);
})->name('fprovider.provider-games');



Route::get('/providers', function () {
    return view('livewire/fungamess/providers', [Providers::class, '']);
})->name('fgames.providers');


//Rotas que a CoinGate acessa - API
Route::post('webhooks/coingate/callback', [CoinGateController::class, 'updateStatusTransaction'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

//rotas para consumo de api externa
Route::post('api/checkFirstDeposit', [ExternalApiController::class, 'checkFirstDeposit'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::post('api/checkAffiliateStatus', [ExternalApiController::class, 'checkAffiliateStatus'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
/* ************************************************************************************************************************ */
/* ************************************************************************************************************************ */


/* ************************************************************************************************************************ */
// ######################## Perfil Casa de Aposta - ADMIN ###########################


Route::middleware(getAdminMiddleware())->group(function () {


    //Home - dahsboard
    Route::get('/admin/home', function () {
        return view('livewire/admin/dashboard/home-module');
    })->name('admin.home');
    Route::get('datatable-data', '@dataTableData')->name('datatable.data');
    Route::get('/admin/data-table', function () {
        return view('livewire/admin/dashboard/data-table');
    })->name('admin.data-table');

    //Grid Luan (Example)
    Route::get('/admin/grid', function () {
        return view('livewire/admin/grid-module');
    })->name('admin.grid');


    //Formulario
    Route::get('/admin/form', function () {
        return view('livewire/admin/form-module');
    })->name('admin.form');


    /* ================================================================================================================== */

    // Rotas Dentinho
    //kyc
    Route::get('/admin/kyc', function () {
        return view('livewire/admin/kyc/kyc-module');
    })->name('admin.kyc');

    # Complement Init DataTable extends Controller
    Route::prefix('/admin/kyc')->group(function () {
        # DataTable Controller
        Route::get('/dt', [App\Http\Livewire\Admin\Kyc\KycDataTable::class, 'index'])->name('admin.kyc.data-table');
    });



    Route::get('/admin/kyc/{user_id}', function ($user_id) {
        return view('livewire/admin/kyc/kyc-details-module', ['user_id' => $user_id]);
    })->name('admin.kyc-details');

    //transactions pagstar
    Route::get('/admin/transactions/pagstar', function () {
        return view('livewire/admin/transactions/admin-transactions-module');
    })->name('admin.transactions.pagstar');

    # Complement Init DataTable extends Controller
    Route::prefix('admin/transactions/pagstar')->group(function () {
        # DataTable Controller
        Route::get('/dt', [App\Http\Livewire\Admin\Transactions\AdminPagstarDataTable::class, 'index'])->name('admin.transactions.pagstar.data-table');
    });


    //transactions coingate
    Route::get('/admin/transactions/coingate', function () {
        return view('livewire/admin/transactions/admin-transactions-coingate-module');
    })->name('admin.transactions.coingate');

    # Complement Init DataTable extends Controller
    Route::prefix('admin/transactions/coingate')->group(function () {
        # DataTable Controller
        Route::get('/dt', [App\Http\Livewire\Admin\Transactions\AdminTransactionsCoingateDataTable::class, 'index'])->name('admin.transactions.coingate.data-table');
    });

    //bets
    Route::get('/admin/bets', function () {
        return view('livewire/admin/bets/admin-bets-module');
    })->name('admin.bets');

    # Complement Init DataTable extends Controller
    Route::prefix('admin/bets')->group(function () {
        # DataTable Controller
        Route::get('/dt', [App\Http\Livewire\Admin\Bets\AdminBetsDataTable::class, 'index'])->name('admin.bets.data-table');
    });

    //admin management
    Route::get('/admin/management', function () {
        return view('livewire/admin/management/admin-management-module');
    })->name('admin.management');

    //rollover
    Route::get('/admin/rollovers/rollover-bonus1', function () {
        return view('livewire/admin/rollovers/rollover-bonus1-module');
    })->name('admin.rollover-bonus1');

    # Complement Init DataTable extends Controller
    Route::prefix('admin/rollovers/rollover-bonus1')->group(function () {
        # DataTable Controller
        Route::get('/dt', [App\Http\Livewire\Admin\Rollovers\RolloverBonus1DataTable::class, 'index'])->name('admin.rollover-bonus1.data-table');
    });

    //cashout approval
    Route::get('/admin/transactions/cashout-pagstar/cashout-approval', function () {
        return view('livewire/admin/transactions/cashout-pagstar/cashout-approval-module');
    })->name('admin.cashout-pagstar.cashout-approval');

    # Complement Init DataTable extends Controller
    Route::prefix('admin/transactions/cashout-pagstar/cashout-approval')->group(function () {
        # DataTable Controller
        Route::get('/dt', [App\Http\Livewire\Admin\Transactions\CashoutPagstar\CashoutApprovalDataTable::class, 'index'])->name('admin.cashout-pagstar.cashout-approval.data-table');

        Route::prefix('update')->group(function () {
            Route::get('/cashoutApproved/{transaction_id}', [App\Http\Livewire\Admin\Transactions\CashoutPagstar\CashoutApprovalActions::class, 'cashoutApproved'])->name('admin.cashout-pagstar.cashout-approval.actions.cashoutApproved');
            Route::post('/cashoutDenied/{transaction_id}', [App\Http\Livewire\Admin\Transactions\CashoutPagstar\CashoutApprovalActions::class, 'cashoutDenied'])->name('admin.cashout-pagstar.cashout-approval.actions.cashoutDenied');
        });
    });


    /* ================================================================================================================== */
    /* ROTA MANAGER USER ---- RAFAEL */

    Route::get('/admin/user/index', function () {
        return view('livewire/admin/user/manageruser-module');
    })->name('admin.manageruser');
    Route::get('/admin/user/show-bets', function () {
        return view('livewire/bets');
    })->name('admin.bets');

    Route::get('/admin/user/show-apostas', function () {
        return view('livewire/apostas');
    })->name('admin.apostas');

    # Complement Init DataTable extends Controller
    Route::prefix('admin/user')->group(function () {

        # DataTable Controller
        Route::get('/dt', [App\Http\Livewire\Admin\User\UserDataTable::class, 'index'])->name('admin.manageruser.data-table');
        # Actions
        Route::prefix('update')->group(function () {
            Route::post('/group/{user_id}', [App\Http\Livewire\Admin\User\UserActions::class, 'updateGroup'])->name('admin.manageruser.actions.update_group');
            Route::post('/password/{user_id}', [App\Http\Livewire\Admin\User\UserActions::class, 'updatePassword'])->name('admin.manageruser.actions.update_password');
            Route::post('/cpf/{user_id}', [App\Http\Livewire\Admin\User\UserActions::class, 'updateCpf'])->name('admin.manageruser.actions.update_cpf');
            Route::post('/2fa/{user_id}', [App\Http\Livewire\Admin\User\UserActions::class, 'update2fa'])->name('admin.manageruser.actions.update_2fa');
            Route::post('/user/{user_id}', [App\Http\Livewire\Admin\User\UserActions::class, 'updateUser'])->name('admin.manageruser.actions.update_user');
            Route::post('/status/{user_id}', [App\Http\Livewire\Admin\User\UserActions::class, 'updateStatus'])->name('admin.manageruser.actions.update_status');
        });
    });


    /* ROTA GROUP ---- RAFAEL */

    Route::get('/admin/group', function () {
        return view('livewire/admin/group/group-admin-module');
    })->name('admin.admim-group');

    /* ROTA REGISTER GROUP */

    Route::get('/admin/group/register', function () {
        return view('livewire/admin/group/register-group-module');
    })->name('admin.register-group');


    /* ROTA PAYMENT GROUPS */

    Route::get('/admin/group/payment', function () {
        return view('livewire/admin/group/payment-groups-module');
    })->name('admin.payment-group');

    /* ROTA BONUS 3 ---- RAFAEL */

    Route::get('/admin/bonus3', function () {
        return view('livewire/admin/bonus3/bonus3-module');
    })->name('admin.bonus3');

    //VISÃO DO CICLO ADMIN
    Route::get('/admin/cycle-view', function () {
        return view('livewire/admin/bonus3/cycle-view-module');
    })->name('admin.cycle-view');

    # Complement Init DataTable extends Controller
    Route::prefix('admin/bonus3')->group(function () {

        # DataTable Controller
        Route::get('/dt', [App\Http\Livewire\Admin\Bonus3\Bonus3DataTable::class, 'index'])->name('admin.bonus3.data-table');
        Route::get('/dt-payment-history/{id}', [App\Http\Livewire\Admin\Bonus3\PaymentsHistoryDataTable::class, 'index'])->name('admin.bonus3.payment-history.data-table');

        # Actions
        Route::prefix('update')->group(function () {
            Route::post('/desactive/{user_id}', [App\Http\Livewire\Admin\Bonus3\Bonus3Actions::class, 'desactive'])->name('admin.bonus3.actions.desactive');
            Route::post('/add/{user_id}', [App\Http\Livewire\Admin\Bonus3\Bonus3Actions::class, 'add'])->name('admin.bonus3.actions.add');
        });
    });

    /* ================================================================================================================== */

    // Rotas Paulino
    Route::get('/admin/dashboard/index', function () {
        return view('livewire/admin/dashboard/index-module');
    })->name('admin.dashboard.index');
    Route::get('/admin/dashboard/finance', function () {
        return view('livewire/admin/dashboard/finance-module');
    })->name('admin.dashboard.finance');

    Route::get('/admin/fungamess/providers', function () {
        return view('livewire/admin/fungamess/provider-module');
    })->name('admin.fungamess.provider');

    Route::get('/admin/fungamess/providers/{provider_id}/games', function ($provider_id) {
        return view('livewire/admin/fungamess/game-module', ['provider_id' => $provider_id]);
    })->name('admin.fungamess.game');

    Route::get('/admin/fungamess/users', function () {
        return view('livewire/admin/fungamess/users-module');
    })->name('admin.fungamess.users');
});


/* ************************************************************************************************************************ */
/* ************************************************************************************************************************ */


/* ************************************************************************************************************************ */
// ######################## Perfil Apostador ###########################

// ROTA PROTEGIDA APENAS PARA O USUARIO LOGADO PODER ESCOLHER SUA CONTA
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'eh.apostador'])->group(function () {

    //Contas
    Route::get('/player/accounts', function () {
        return view('livewire/player/accounts-module');
    })->name('player.accounts');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'eh.apostador', 'select.account.apostador'])->group(function () {

    Route::get('/games', function () {
        return view('livewire/games/games-module');
    })->name('games');

    Route::get('/bonus', function () {
        return view('livewire/bonus/bonus-module');
    })->name('bonus');
    //Convites Desconto
    Route::get('/player/myinvitations', function () {
        return view('livewire/referral/invitation_module');
    })->name('player.myinvitations');


    //MEUS AFILIADOS//MEUS AFILIADOS//MEUS AFILIADOS
    Route::get('/player/myaffiliates', function () {
        return view('livewire/referral/affiliates_module');
    })->name('player.myaffiliates');

    //PESQUISA HIERARQUIA
    Route::get('/player/show-heirarchy', function () {
        return view('livewire/referral/show-heirarchy-module');
    })->name('player.show-heirarchy');

    //CONSULTA SALDO DE AFILIADOS
    Route::get('/affiliate/wallet', function () {
        return view('livewire/referral/balance_affiliates_module');
    })->name('player.balance-affiliates');

    //Raio-x de convidados do afiliado
    Route::get('/player/myaffiliatesxray', function () {
        return view('livewire/referral/xray-module');
    })->name('player.myaffiliatesxray');


    //MEUS GANHOS
    Route::get('/player/mybonus', function () {
        return view('livewire/referral/bonus-player-module');
    })->name('player.mybonus');

    # Complement Init DataTable extends Controller
    Route::prefix('player/mybonus')->group(function () {

        # DataTable Controller
        Route::get('/dt', [App\Http\Livewire\Referral\BonusPlayerDataTable::class, 'index'])->name('player.mybonus.data-table');
    });


    //Contas
    Route::get('/player/kyc', function () {
        return view('livewire/player/kyc-module');
    })->name('player.kyc');



    //BETS DA ACCOUNT_ID ESCOLHIDA (session)
    Route::get('/bets', function () {
        return view('livewire/player/bets-module');
    })->name('bets');

    //CashIn e CashOut nao precisam de rotas separadas, pois sao carregados dentro de modais com os comandos:  @livewire('transactions.cash-in')  e @livewire('transactions.cash-out')


    //Quando um pagamento via cc eh efetuado c sucesso, o pagstar redireciona p/ esta rota
    Route::get('/cardpayment/status/{externalreference}', function () {
        return view('livewire/transactions/cardpaymentstatusextreference-module');
    })->name('cardpayment.status.externalreference');

    //transactions de cashinpix, cashincc, cashoutpix, etc ...
    Route::get('/player/account/transactions', function () {
        return view('livewire/transactions/history-module');
    })->name('player.account.transactions');

    Route::get('/ranking', function () {
        return view('livewire/ranking/overview');
    })->name('ranking.controller');
    Route::get('/referral', function () {
        return view('livewire/referral/overview');
    })->name('player.referral');
    Route::get('/games', function () {
        return view('livewire/games/games-module');
    })->name('apostador.transacoes');

    Route::get('/profile', function () {
        return view('profile/show');
    })->name('profile');
    Route::get('/support', function () {
        return view('livewire/support/support');
    })->name('support');

    //Rotas que acessam os games livewire *_*
    foreach (getHyperGamesRoutes() as $gr) {
        Route::get('games/' . $gr['base'], function () use ($gr) {
            $controller = new GameController();
            return $controller->playHypeLegacy($gr['game_code']);
        })->name($gr['route']);
    }
    Route::get('providers/games/{game_code}', [GameController::class, 'playFgames'])->name("fgames.game");


    Route::get('game/play/{provider}/{code}', [GameController::class, 'getGameUrl'])->name("game.play");


    Route::get('/load-more-scroll', function () {
        return view('lists');
    });
});




/* ************************************************************************************************************************ */
/* ************************************************************************************************************************ */
