<?php

use App\Http\Controllers\HypetechController;
use App\Http\Controllers\PagstarWebhookController;
use App\Http\Controllers\FastPaymentsWebhookController;
use App\Http\Controllers\FungamessController;
use App\Http\Controllers\ExternalApiController;
use App\Http\Controllers\PixPaymentGatewayController;
use App\Http\Middleware\CHeckHypetechIp;
use App\Http\Middleware\VerifyCsrfToken;

//API
//Rotas que o HypeTech acessa - API
Route::middleware([CHeckHypetechIp::class])->withoutMiddleware(VerifyCsrfToken::class)->prefix("webhooks/hypetech")->group(function () {
    Route::post('register', [HypetechController::class, 'register']);
    Route::post('wins', [HypetechController::class, 'wins']);
    Route::post('rollback', [HypetechController::class, 'rollback']);
    Route::post('lose', [HypetechController::class, 'lose']);
});

Route::post('webhooks/pagstar', [PagstarWebhookController::class, 'index'])->name("webhook.name");
Route::post('webhooks/fast_payments_gJNlxSSC5PFzWCZ', [FastPaymentsWebhookController::class, 'index'])->name("webhook.fastpayments");

Route::post('webhooks/pix/{gatewayName}/4ksAEBs0DDqtEsquBAk7CwlOUrCIqggL', [PixPaymentGatewayController::class, 'webhook'])->name("webhook.pix");

//API
//Rotas que a Fungamess acessa - API
Route::get('webhook/fungamess/sessionCheck', [FungamessController::class, 'sessionCheck']);
Route::get('webhook/fungamess/playerDetails', [FungamessController::class, 'playerDetails']);
Route::get('webhook/fungamess/getBalance', [FungamessController::class, 'getBalance']);
Route::post('webhook/fungamess/moveFunds', [FungamessController::class, 'moveFunds']);
Route::post('webhook/fungamess/betFunds', [FungamessController::class, 'betFunds']);
Route::get('webhook/fungamess/getUserToken', [FungamessController::class, 'getUserToken']);

//rotas para consumo de api externa
Route::post('api/checkFirstDeposit', [ExternalApiController::class, 'checkFirstDeposit']);
Route::post('api/checkAffiliateStatus', [ExternalApiController::class, 'checkAffiliateStatus']);
/* ************************************************************************************************************************ */
/* ************************************************************************************************************************ */


/* ************************************************************************************************************************ */
// ######################## Perfil Casa de Aposta - ADMIN ###########################
