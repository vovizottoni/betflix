<?php

use App\Helpers\ValidaCPFCNPJ;
use Illuminate\Support\Facades\Auth;
use App\Enums\BalanceUsedEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\MetaData;


function formatCPF_CNPJ($value)
{
    $cleanValue = preg_replace('/[^0-9]/', '', $value);
    $formattedValue = '';

    if (strlen($cleanValue) === 11) {
        // Format CPF (ex: 123.456.789-00)
        $formattedValue = substr($cleanValue, 0, 3) . '.' . substr($cleanValue, 3, 3) . '.' . substr($cleanValue, 6, 3) . '-' . substr($cleanValue, 9, 2);
    } elseif (strlen($cleanValue) === 14) {
        // Format CNPJ (ex: 12.345.678/0001-90)
        $formattedValue = substr($cleanValue, 0, 2) . '.' . substr($cleanValue, 2, 3) . '.' . substr($cleanValue, 5, 3) . '/' . substr($cleanValue, 8, 4) . '-' . substr($cleanValue, 12, 2);
    }

    return $formattedValue;
}

function getUniqueCode()
{
    return (string)Ramsey\Uuid\Uuid::uuid4();
    //return md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . $id . (string)time();
}

function getShortUniqueCode()
{
    $random = getUniqueCode();
    return substr($random, 0, 9);
}

function fungamesSufix()
{

    return "_" . date("yW");
}

function getTokenAccountCode()
{
    return getUniqueCode() . fungamesSufix();
    //return md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . $id . (string)time();
}

function checkRateLimit($index, $limit)
{
    $rateLimitService = new \App\Services\RateLimitService($index, $limit);
    $rateLimitService->run();
}

function inTestingEnvironment(): bool
{
    return env("APP_ENV") == 'testing';
}

function inLocalEnvironment(): bool
{

    return env("APP_ENV") == 'local' || inTestingEnvironment();
}

function formatExceptionMessage(\Exception $e)
{
    if (inLocalEnvironment()) {
        return $e->getMessage() . ":" . $e->getFile() . ":" . $e->getLine();
    } else {
        return $e->getMessage();
    }
}


function getAdminMiddleware()
{
    return ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'eh.admin'];
}

function getUserIp()
{
    return request()->ip();
}

function apiErrorMessage($msg, $data = [])
{
    $response = ['success' => false, 'message' => $msg, 'data' => $data];
    return response()->json($response, 422);

}

function apiSuccessMessage(array $data, $msg = 'Operation performed successfully.')
{
    $response = ['success' => true, 'message' => $msg, 'data' => $data];
    return response()->json($response, 200);

}


function joinByCommas($values)
{
    $values = str_replace(" ", "", $values);

    return explode(",", $values);
}

function getHyperGamesRoutes()
{

    return [
        [
            "base" => "freestyle",
            "game_code" => "embaixadinha",
            "route" => "games.embaixadinha"
        ],
        [
            "base" => "motograu",
            "game_code" => "motograu",
            "route" => "games.motograu"
        ],
        [
            "base" => "pipabrazil",
            "game_code" => "pipa",
            "route" => "games.pipa"
        ],
        [
            "base" => "foguetinho",
            "game_code" => "foguetinho",
            "route" => "games.rocketcrash"
        ],
        [
            "base" => "aviador",
            "game_code" => "aviador",
            "route" => "games.aviator"
        ],
        [
            "base" => "toguro",
            "game_code" => "supinocash",
            "route" => "games.supinocash"
        ],
        [
            "base" => "mascara",
            "game_code" => "mask",
            "route" => "games.maskara"
        ],
        [
            "base" => "toguro",
            "game_code" => "toguro",
            "route" => "games.supinocash"
        ],
        [
            "base" => "double",
            "game_code" => "double",
            "route" => "games.double"
        ],
        [
            "base" => "crash",
            "game_code" => "crash",
            "route" => "games.crash"
        ],
        [
            "base" => "wallstreet",
            "game_code" => "wall-street",
            "route" => "games.walls-treet"
        ]
    ];
}

function getMetaDefaults()
{
    return [
        'min_amount_deposit_pix_brl' => 2,
        'max_amount_deposit_pix_brl' => 5000,
        'number_of_withdraws_per_day' => 1,
        'min_amount_deposit_creditcard_brl' => 5,
        'max_amount_deposit_creditcard_brl' => 10000,
        'max_amount_cashout_automatic_approval' => 500
    ];
}

function getMetaValue($name, $default = "")
{
    if ($default == "") {
        $defaultValues = getMetaDefaults();
        if (isset($defaultValues[$name])) {
            $default = $defaultValues[$name];
        }
    }

    return \App\Models\MetaData::getValue($name, $default);
}

function getBalanceUsedSession()
{
    $balanceUsed = session()->get('balanceUsed');
    if (is_null($balanceUsed)) {
        return \App\Enums\BalanceUsedEnum::Balance;
    } else {
        return $balanceUsed;
    }
}

function funGamesApiError($message, $code, $extraData = [])
{
    $data = [
        'status' => false,
        'errorDesc' => $message,
        'errors' => [
            'code' => $code,
            'error' => $message
        ]
    ];
    $data = $data + $extraData;
    registerTransactionLog("Time: " . execTimeSec() . "Line: " . __LINE__ . " Message: " . $message);
    return response()->json($data);
}

function getAccountIdSession()
{
    return session()->get('account_id');
}

function execTimeSec()
{
    return microtime(true) - LARAVEL_START;
}

function registerTransactionLog($text)
{
    /* $name = false;
     $data = request()->all();
     if (isset($data['transactionId'])) {
         $name = $data['transactionId'];
     }
     if ($name == false) {
         return false;
     }
     $fileName = "move_funds_$name.log";
     \Storage::disk("local")->append($fileName, "\n" . $text);*/
}

function registerGatewayLogMessage($text)
{
    $fileName = "gateway-log-" . date("Y-m-d") . ".log";
    \Storage::disk("local")->append($fileName, "\n" . $text);

}

function registerLogMessage($text)
{
    if (inTestingEnvironment()) {
        $fileName = "custom-log-" . date("Y-m-d") . ".log";
        $content = \Storage::disk("local")->get($fileName);
        Storage::disk("local")->put($fileName, $content . "\n" . $text);
    }

}

function defaultTransactionsQueue()
{
    return "transactions";
}

function getFunGamesHash($data)
{
    if (isset($data['extraData'])) {
        unset($data['extraData']);
    }

    ksort($data);
    $data = array_map('strval', $data);
    $data = json_encode($data);
    return hash('sha256', $data . env('FUNGAMESS_API_KEY'));
}

function getRequestData(Request $request)
{
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    if (!isset($data['transaction_id']) || !isset($data['idTransaction'])) {
        $data = $request->all();
    }
    return $data;
}

function onMysqlDatabase()
{
    if (env("DB_CONNECTION") == 'mysql') {
        return true;
    }
    return false;
}

//Multiply, add, subtract and divide
function safeMul($n1, $n2)
{

    return bcmul($n1, $n2, config("constants.numerical_precision"));
}

function safeSub($n1, $n2)
{

    return bcsub($n1, $n2, config("constants.numerical_precision"));
}

function safeDiv($n1, $n2)
{

    return bcdiv($n1, $n2, config("constants.numerical_precision"));
}

function safeSum($n1, $n2)
{

    return bcadd($n1, $n2, config("constants.numerical_precision"));
}

function sendEmailOnQueue($to, $emailObject)
{

    return Mail::to($to)->queue($emailObject);
}

function getBaseDomain()
{
    return url('/');
}

function getStorageFile($file)
{
    return file_get_contents(storage_path('app/' . $file));
}

function getProvidersWithGames()
{
    $json = getStorageFile('json_cache/providers_with_games.json');
    return json_decode($json);
}

function getAgePeriods()
{
    $from = date("Y-m-d");
    $to = date("Y-m-d", strtotime("-25 years"));
    $faixasIdades['18_25'] = [$from, $to];

    $from = date("Y-m-d", strtotime("-26 years"));
    $to = date("Y-m-d", strtotime("-33 years"));
    $faixasIdades['26_33'] = [$from, $to];

    $from = date("Y-m-d", strtotime("-34 years"));
    $to = date("Y-m-d", strtotime("-40 years"));
    $faixasIdades['34_40'] = [$from, $to];

    $from = date("Y-m-d", strtotime("-41 years"));
    $to = "1000-01-01";
    $faixasIdades['acima_40'] = [$from, $to];
    return $faixasIdades;
}

function bandeiras($uf)
{   // data:image/png;base64,
    $bandeira = '';
    switch ($uf) {
        case 'AC':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAWCAMAAACWh252AAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAKtQTFRFAJlM8+cY8uYY7eUZBptLGKBH8uMYzAEAN6pAV7Q5rNAn298d8doXQq49I6NFDZ1Km8sr554Q4eEb44cOEZ5IsNEmRq89CZxK6eMa7soV5OIbesAy3moLytoh6awS0iUE5JIP7ccVabo1j8Yt4YANzgsB1jsG8d0XutQk7cIU0dwficUucr0z4HoMY7g20BkD2t8d6rQTKKZDgMIweL8y1kAGztsgzAQAvdYjcOFucQAAADl0Uk5T///////+///+/f7+//7+//3//v/+/v7////+/v/+//////39//////7//v39//3//v/+/f7//v/+zo3fIAAAAK9JREFUeJx9z8UWgzAURdGb4FIcSt3dvf//ZYWyKAVC3iSDs2Mg3BloSJeVzM5Ul/AFfofZu0cbCZCH7qjvTmpZ0C2kQ+j4pCjL2hlxL0AGCDm8FpdqX7eAHNDHZu5X+k1EAWSTELOUn7/t2RXV1+0k8ICnAhwgOBJ4wNBE8MA7qOYSOE/b9V4AGlqMXABhz8w5oKHa0DPg3Vm3F2Ab1T73D+KZ3ZwTYES8DDhXfv8ANWgIvzDS8b0AAAAASUVORK5CYII=';
            break;
        case 'AL':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAO1QTFRF2iUdAHe5////P5jK41pU/f79tt7H+/z7ueDKmcLdwOPP6unpkM2roda3xeTS7e3s8/n2WpjCecOZ++rpP3mqyTY01N6mhzc8y9/sZaxMHJxTUZXCuJOFk7y6oIRvRa1xtNXXv786tM7LmtGw88rIp9e8vtbO4PDnYqS++eDfucOhicul0ebMzejZN6doyLS9h7XSXbeDpsLU1+nWs0E88Pfzb5a6vNbo7u7nabBbTbB3t9TkNn6yxDs7a6u9bp3DVpbB+fn51OTwr9rCrMTUyz485fTrjMmfU5jGfcWcveHLUbF0v9rnr8HVhrbWKUFC7gAAAE90Uk5T/////f3///////////////////////////////////////////////////////////////////////////////////////////////////RssngAAACUSURBVHiczdHFFsIwFEXRUHhJ6i3u7u4Ud5f//5zOMmE9GMIZ79G9hIh8ksjrEZH/A8w04QMAaauqDAdO/SEf+nKUAQKasaq9sRPdwQ0BhXu285zsyrkwAva9yrAYqBnTMwLoLBk5hpbpjIEA5ZpaBMfrfIkiYOTXVpfXvB3nCLBaXFc4pfoJHQpAa3z5woKf3/0OXAVvDwzsBFgQAAAAAElFTkSuQmCC';
            break;
        case 'AP':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAJlQTFRFAJlMACWA8+cYA10wAAAAa295hYRuACN449gWAJdLDls0AJVKfIB+6t8XE2A5ACR7QoxmF2Q9h4eIFpNUY49xAmk0K4tZi42Mf3spAZVKIC5SElYzHJNWioyLBJdMiYmHdXEj4dYWFSRLZ5NyD4xMJTJUJ4AmJIdUZpJxkZGSf4uDgn0jfXgeL30uGihKiZKMGSlQfnoulJSSSNrS8AAAADN0Uk5T/////wD/////////////////////////////////////////////////////////////UQwiUQAAAJhJREFUeJyNktkSgjAMRWOtS0utCiruCG64L///cTIZOr4k0fOakzttEtA2vfcbLBq0sfGcNyoBwLs9a6AQDR2bgQJEPn6KAoBdFR2SIJjFqUVSCzMD4yZJLQwmwIDCerkdJUYQjo/D7bwTE0o54ecb/vhFNYd3m+Q7yWvepQi7yC6KJmxz2pME715cXeFFZWw/Cjbd8HWlPzI0DE98cypcAAAAAElFTkSuQmCC';
            break;
        case 'AM':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAG9QTFRF////0gAAAAAA+uPj1x8fAR54ugYQGBttkJvDAh95AyB5CyZ9JT2KQ1eaIjuJBCF6GzOFDyl/FjGDMkiRKT+MSVydLESOCSR7S12emIuvFC6ByhQZnqjLOE2UPFGWNEmSHjiHGjOEN0yUO1CWP1OXfc1O9gAAACV0Uk5T//8A//////////////////////////////////////////////0WklcAAAB9SURBVHiczZDLFoIwDAVr9KJpoaUobwVf//+N2h0nLayZk+UsJlcRQev/MbNjvigBKSJXT+W1yF+P7pYnBW7QPuFhUVVJAQPYf+/Ow5ikoAuYxrSYYe1Kwyc0lO+1hvOC/igIQrZgPAmCcNhiL4IMj76Qr0c7yPGiJfcv/AD+2Aek7bTLEwAAAABJRU5ErkJggg==';
            break;
        case 'BA':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAGNQTFRF////yBQKChTI7razAAAA44mE2VxVhInjp6rrnaHpfBRWIivNcXffDBbJo6fq7/D7DxjJ5eb5XmXbvYmqztD0hj+D8/P8EhzKKDHP2tz3dnzg/v7/HSbMi5DlMTrRoaXqe4HhH6kFkwAAACF0Uk5T/////wD/////////////////////////////////////JYIhhAAAAG1JREFUeJzFz8cOgCAURNERsaJi7+3/v1JlQTR54E7v+mSSAWe6CFQKdOsLSOrcCvoCiRUswDBbgJDANDLW+EQnyLMLSsFih+gEZaumttQA0j1UZcK0oDOAQFd5RODkt/vND4BrD5z69rj5PzgAr2cF43/NK0cAAAAASUVORK5CYII=';
            break;
        case 'CE':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAQVQTFRFAJI++MEAAAAAAJI++MIFFJY5+MQM9MABCpQ8mK8Y+tNL/eyyJJk1/Oij1roJ+MUQ8cACrLMT+cgg5L0FIJg2KZo0vbUP////9sEB/fDEk8SoCJM8/f38+/v6mq8XRJ8t+9ts2bsI6u3sEpJJXqMnjpNz//zyXKMn/fDBGZc49ff2icGhZ6Uk7PHvgL2aF5Y4+MID+9xv2LsIaaYkR58tP6NqY7GEtrQQantO0sWrlJ97srSaHY5lla4YlKOaTqp1jG9Xf7eXJolIgLWxP5GArKZ7JppYYoxmwrOYaJ9zjrmjrq2SJ5dvIJJXzL2hv66SW6p9MYFGtLQRVKJ4Ro2GLplvKptZUsBodgAAAFd0Uk5T//8A/P//////////////////////////////////////////////////////////////////////////////////////////////////////////////TeTvBQAAAN1JREFUeJxjYGLAB5iZGEhVICKCV4G0iqKRujRuBZqCAoyMAoL6OBRwGAsbCHFxCRkI63BgUyAqJsHG6+fvYcnLxi4miqGAlZOdkV9Sy1tV1VpLg5+R3ZYVVYEJHyMjo6GMo3Koj7KejAKQwyePpIBHDijCyMItLhXs5WyjLc7NAuRKcPLAFLCag+QZ2STFtT2t3AP1xCXZwAJBrOgmyNq72DlYmMpATJDjwXCDrJlviKtTgCyGG+C+0JVyC5PSxeYLWDioKSmpYQ8HIkKScFyADCEQmwwE0wMGIEIBAF1IGH0p6q0UAAAAAElFTkSuQmCC';
            break;
        case 'DF':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAHVQTFRF////AJI/AAAA9fv3KaNd/P795fTsGZ1SNqlnUaIqOZ0wKpo0C5Q89/z5SKAt5L8FkK4bRKhWaqckVrZ/LqBNpbs+o7IVE5U6NKVaRKxkPqxt9cIBMJsz6fbv/v/+ApI+0rsKq7kt78ECRJ8uor5MHJc4+cMACyMPCAAAACd0Uk5T//8A////////////////////////////////////////////////FATE7QAAAGhJREFUeJxjYGIgAOirgJcZBnjlsClgFWZhYZEQFQSSUrJYFXAwMjLKC4gDSXY2nAq4+TnxK+CSFsKtQJKHm5NPho+Ti0cEuwIVMQU1ZUZVJX4xRTJNIOgGonyBNxwIhSTBuMABaK8AABLQBrWeTmWZAAAAAElFTkSuQmCC';
            break;
        case 'ES':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAGZQTFRF8Ju+AJbh////AAAA+v3+//3+BZjh8J2//P7/5/X8st/29fv+fsrwwOX3y+n56vb8tuH2rNz18vr+8Pn9qNv13PD74fP7hM3wxef47/j9i8/xmtXz0uz6n9fz5PT81u76r971j9DxCC9aFwAAACJ0Uk5T////AP///////////////////////////////////////4eAKHQAAAB2SURBVHic1c3JDoMwDEXR1JjWmQfm0hb4/59sFoggIXnPXVpHfqJ6sFXiHuDJlgGyZQAlSk0HsgcqpwOQV3YObTRJOfmO4ePxBGhZRzO01skJqfHa2Wi2IPUB8KvGX4Lz2NSroSsTiHBN7x9qtgxebBkItnuAPzeECIYutGC0AAAAAElFTkSuQmCC';
            break;
        case 'GO':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAKJQTFRFAJlM8+cYAAAAesAypc4pzNogA5pLps4o9OcY8OYYKqZDTLE8JqVEACWA9OgYByqDASaAAieBIECPAG9eJUNvd4q7KkZym6I9LUqWnKrNvMbeHD2Oj57HFziMCS2ELkp0GjuNKERxPVmefI69VW2qG3dZ0djoDzGHOlacJoJTydHkqbXUXHOt3+TvMX9UY3mxFjeKkaHIDTCGWnGsEjSJlKPJRG0YowAAADZ0Uk5T//8A//3+//3///79/v/////////+//7///////////7//v////7////+//////7/////////ITgpuAAAAJ5JREFUeJyNz8cSwjAMRdFgehEu2Omk0Xto//9roCxYRBOTs76jeXIYA14CimDhEMxhLDN3BZA8T/uGQAQhlxzMUV2nBAZSLfk53kXlw+sQ1YWXLwsDspDemMBAhVtfiCS4rDcTorqwivn3ids7axiZp26utU5d9zAjMJj/jCgM6PTaF10bDOiy2si/Qd+m1cihDQYDm1YjezatRtqDD74HENmy+2M9AAAAAElFTkSuQmCC';
            break;
        case 'MA':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAASZQTFRFAAAA+eXl7+/vwsHBTEpL7kNH7DtBKCYn/vz6/f7+/O7u8nN17DI3IR4f9aus721weXh59rW2/P797DE3hoWG/v78PkCVdzt2bnCtR0ma/f39P0GW83J1PkCWREWZ5Obw5uXw/fz7/Pv5aWqq+/z88W9z3d3q9vb2+uvsSEqaf4C2/e/va2yt6+vxS0yamZnEiIm7Y2FirjZYLy9cZWeqVFJTq26QWlqH73V6k3KgkDln85ibxMTEnZ7HoaCggYCAPUCV98TFdHWxW1ykx8fdfkN9lpfEqKjMMjAxVlag09PT7kRI4uLiqamp6+Tr7UxQrq7SYGCN8/Pz+MvMaGdnYWKmhoWF5+bn8Xl7cXKw/fLz9Zyfysvg7O3x+Pj4lHajQUOX8Ht+Rp2n+gAAAGJ0Uk5TAP////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////+BVJDaAAAA70lEQVR4nH3QazcCURTG8RPCqMSUrc5xRjOT7hdCLiEUXehCVO76/l/CnmNezVmn3+v/2utZmxBKtX960tzyooSQ4m3MVQ1Lahgk4oyxtyxjcB7xCu6JgAN8HgFnZ+uSGyfIvtqF75Ztl+51TYLBbryQsjSavjSeol7jnghYKUXN3DUchiQHIoBGsflVBjjZkFyJkZDbh87QgLKme1AqLnCDczB++c+mZIRB/27bVQlKnD9kpjuugOwDg6S1qmZikL5YVOti8NheUXvBYHK8pFZ3NizM8YyBmV9Tyr9j4Bv41WZO8LCsdoqB5ZsjQ/4AxJUtLI60bCUAAAAASUVORK5CYII=';
            break;
        case 'MT':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAKVQTFRFKBZvAAAA////KRhwAJI/+MMAUkSLOCh6/v7+RDWCLZs0wr3X7evzem+m0c3gfcedqNq9kYi1/Pz9z+raX1KUnJS98vn02e/i8vL39/b539zp88IBIZg3VEaNCZZFw7/Xqtq+nbEX0LsKYaUnPKtsEJU7wLgOv+POQ6AzVbBl2dblGZc55b8FBpRDEZlLR7B0RqM+orIWyroMWLNup7MVZaYlApI/omEeVQAAADd0Uk5T/wD//////////////////////////////////////////////////////////////////////6FfeJQAAADWSURBVHiclZLZDoJQDESht5dVcUPZFUQFARVl+f9PU4hoRHCZtzYnTTtThmU+imX+BIjjkE8AP9H1Cd8PcMoUYKpwPQA/N7RRlo00Y853AEQ1BfeIvo9HVzBV0gZEWYDxEnG3Q1yOQZDFF4AMBwCLvW1LliXZ9n4BMBiSB0C4Fdw0Cy+01iWcVfWKI3dAjKoaAoxzi1IrjzGoG5HYmnBAKaE0kfDQmtDssMGCrte0wE1rh+cVZ2+79c4dVzQ+pCVimXb60Dh5OvU5+UMWP6T5/R/e9R24AsXqEQdHWT56AAAAAElFTkSuQmCC';
            break;
        case 'MS':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAJNQTFRFZpn+AJI/////AAAAAZJA/v7/aZv+zN3/bJ3++/38Z5r8cKD+y9z++fz69/v4wNX+YbmFZryJXbiC8PjzkLS8ccCRydr/c6Lod8OVecSXxtlg8vYXu9L+fKjaqMWR+PoNbp7wt894//8A6/Ihh67JssyBYrqGapz3wdX+5u4rrsmJ8/cWiLDFx9r+cqHrsMqEi7LD97tMNAAAADF0Uk5T////AP///////////////////////////////////////////////////////////8+CzSYAAAC7SURBVHicdc9ZEoIwEATQMYyCAQQURdxX3Jf7n07IUBiSIVX56teQBqenH8yHQoh+NID6ONACOKXcAx5gHlb5qukbAItRlb+0vAWwmJS5CHzgASaqH+h9HeA4VH0PeIBzY58BaJ+IjH4DMAmZ//8Bxup9M9/KCWDM7NNAvc+1v0+gYx/ApQa072r3P28Cap9r9uU3fdzTrAId+57Hw/YsCbD7YLG8ZUDA5fLdfr05KdCxT8ryKmC9r3WcH1FGCRsjnqagAAAAAElFTkSuQmCC';
            break;
        case 'MG':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAALFQTFRF////AAAA/////wAA/xMT/+jo9vb2/wEBra2t/f3919fX/2Rk/xAQ/jAw8fHx0tLStra2/zs7/wsLu7q6/xgY6Ojo2cLC/4SE4+PjvLy8uLi4//n528PDo6Ojzra255KSx7S0xcXF/H9/+U5O37e34t/f+NDQ9HZ27ZiY+vr6v7+/0r+/76Oj17+/zcvL3NzcpqamsbGxxMTE4JSU1dLSqamp/FFRw8DA1dXVyrKy1r+/gkq5BwAAADt0Uk5T/wD+//////////////////////////////////////////////////////////////////////////8TZ7BlAAAAnUlEQVR4nMXSRw7CMBBAUSeD7fTeEwi99w73PxihCCExzhL+amQ9ySPLRJJJTbJEfg/yvBaELI5tTQxYVhhGy5mIgKqdjgA9f6sKQJLOPQBv51s4YNnehSp30GEoODfH/A54qawwoB7aJjwyZxuGgHA54k/Au4qNXTEM4FXQtzCgN97p6JKU0uIaXaJFNQhekiRTZZ06Hwd/+Q9f4AZ8Uwl93jUrLgAAAABJRU5ErkJggg==';
            break;
        case 'PA':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAL1QTFRF/wAA/////wIC/wUF//7+//b2sNLy/7Cw//392er5/w0N/8LC/xAQ/+PjAXTY/1JS/x4eUZ7k/25u/zMzyuH2+vz+9vr+/2JiG4Db//Pz/+DgX6bm/09P/62t/xIS0OX3//f3/2lp//Dw/5yc/woK/3R0/yIi/xYW/yws//r6/3x8/5SU+dbZ/+jo/7y8/0ND/6Cg+3t9/9bW/ygo/4eH/1tb/7e3/9ra2Ob1/0hI/zc3/97e/5iY/1VV/+vr94dmVAAAAMlJREFUeJx90ccWgjAQBdAEEoqAhSIgNpRi7739/2fpEcLq6Wxzz5uZDKHfsq4y+VEFoK9Z7T+gmuFgcGKCTI8SAnLjXoWoE5jRHGuCLGM4azLjQvC5CUMcVYR4iy4MMTdhAVyX2wmcdb37POtKFCkX4wbb9FVK2616vdWm/AkXJn6HDYJg8EliagZJc6zoulIcJ4Witg2pVy58yGGb/ar6eqsBQ/LHUIiRDS8sdc9CMAMfx+zRKiSGQvI7FYGAkKw3/Q9IPy1nfQN4mgxEcc58YAAAAABJRU5ErkJggg==';
            break;
        case 'PB':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAADxQTFRF8AAAAAAAAAAA1gAAGwAA9EBA8zEx9E5O8zk58i0t8ioq9VBQ8iIi93l59VZW94WF+ZWV9mZm8z09935+tsyLzQAAABR0Uk5T//8A///////////////////////zMd49AAAAOklEQVR4nGNgYoQBFmYGTMDEMKoAhwIOHm5OIS5WNpwK+IUF2Nl5+QRxKuBi4+Zk5cBjwmDw5iBUAACSLgKcQ6rosAAAAABJRU5ErkJggg==';
            break;
        case 'PR':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAVNQTFRF////AI1DAAAAJUml/v7+Pl6vgMahLVCoQGCw2u7jAo5EcL+V+v37WnW7PahvGphV9fr4D5NN+Pz67/jz/P79Tq98KEumNKNpv+LQY7mMTK96Tmy1EZRPmcHB5fPsks6vKk2n3eLxRGSyp8vKr9vE7PfxMFKpxeTU6Oz21+3itN7I3vDnZ7uPl9GyS2i0wN7UyufYQqpzaYPAJkqlBY9GHJlXrtfH6fXv4fLpmdGz9Pr3ecKbUrF/3O/llM+wXHe8wePRYLiKHZpY+vz9fpPK8PL5nLTQY3+9zOjZn9S4V7OCdo3GtNPQm6vVtMHgCJBJ1+XoxNneiMepjqHQeJ66dsGarMbS1dztXreI4u3uqtnAT7B9vOHNxeLXUW638fn0Nles7/L4br6TW3m5OaZthJjMFpZT4+jz0erdjMupdMCYeZLFX3u7VXG51+nlB5BIh8mmrW9KLAAAAHF0Uk5T//8A//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8bDH+0AAABK0lEQVR4nH3QZXPCYAwA4ISXClakUByGuzPcmbu7u2///9MK43aFseZbkudySUABv8F/uXAyFCABAKqjojwAWHJsygPQnnDyQAm8V/8vuN5lKWpuPkS7poN+uyCsh8l7FBL24h9QrsDG4puTYghZ7Wf5xMrnODA1LM3DA/daZntBxz5qImC2ceohMI1EnduiWIGEb/d8vmO7Z7Bv0KoWQcP2AyovpbSOIW3hwn+fuTEMa5ctEaCx2xwksZ7jlRDCkCsmv+NVjuYOAKJRUxY/9Kwp+UnBSQjrToZgDCDqU1rQ0g+B/Exa0AUscZgEiL2qIUbTufPoR8rSMU8BiNZ4bV/fzVZPVZLfSQFiLuJZ7gSl/QmAruQTKM0yAHG2XgNZIJKWQR6g+u5McsU39/Ij5WVnqXkAAAAASUVORK5CYII=';
            break;
        case 'PE':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAATJQTFRF////EBBwEBBu6OjxDw9w+fn5ERBwDw9s5iwMmLgVQA5ZaAxG9p2eERpoJCNnFhBtlgwwSw1U/PEMX1tO7W4L4uPsHFw3cAtCFT9L9JULNXsm9IyOnJY16GAORIMlGRBs7vXpmQkvssYTeKYb+vAN6BkcjQk1JWE2Eh9k9qSl5K4N6zAz99sMHBxqGEpEpMET97ALrggl7+US5EEO/eXl7bcMLm0vSA1VUY0hvsIRqxIm6Orv/vXn8nwL+swM/e/vERVs8eft96usw8oR8r4MFxdqTIUmIA9oEiVgq8IUphYpEh5mIB9pIl436mQMWVZR5+Ps7F8MGEJKERhqEhNvJGMzn5kz2dAbVVJTNzVf1c0cSEVYw7skGBprQkBbT0xVzcUgOzpdFhVtUk9UopwyFhZtx402DwAAAGZ0Uk5T///+///+//3//////////////////v///////////////////////////////////////////////////////////////v//////////////////////////////////////////j1F0bgAAASFJREFUeJyFz9Vuw0AQBdC10xhjDjMzMzMzlhn+/xfaOGlSW5Vzn+ZKZzWzAIUl6fWkHQUwJIkgSDssBzStAAacwe9y+Q3c4D+AcCmslqxHo/VkDUtxiAwghfEq7Pb087tdvu9xh1fjAvIXMGQmh5vjw83TlN5uhnEznsuQzBk4WFupuKYgKPbxaRV+nlLrYsnGOk6ANY30k71/ueH5+7v9NNGPTOwRIKQWDzTFSx7SPJ++Fbc3A7iWRERAYJ0Zdbj5+dXrfXw7zNSsgxF7wJS79uDxU18L6/UidixBe7fMwAAl5gnj1W+29PT9VIyJOYECXavqrKhOWS7Pc8VZbemAGkjSbku7WgayFktWEUR8vogiABqN8orLIBS6ABoNGfgGKl8lilbuLWIAAAAASUVORK5CYII=';
            break;
        case 'PI':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAALpQTFRFVqE0wsISfK0okrMh9dIDbagtoLgd/9UAW6My4swJCxCXAAAA1LIaMTWgGBycDBGXFhucP0KmFBibHiKf/v//Li2BHiiGW165Gh+dV1y3TpI+4MkK9/f8Y5k3JS2Ha27As7XfGh6WVlm3IiehfYDI1rYXhKMtSEupkacpaGu/jpDPFiWJ3b4Svb/jOTyjMDOfKzmLcJ0zRkqpS06y5sEQKS2kSUyxVJQ8t7ng+/v9TlGzGSaHOz+kwMHkKCJrqgAAAD50Uk5T//////////////8A//////////////////////////////////////////////////////////////////+t/MdlAAAAsElEQVR4nIWS1xaCQAxEY1dWOgjYe++9/v9vyS4PHjMeuQ/Jy5yUSUhoEmsg46JOSCK4z2SsjXOAEpyD6ys4mJp/LAFKcFp5XteNK+yyQNKic2v24/RoFQAlMOdRNIyzv8wDJEzHsNzQCg3HaE+LAImebm8m+6e+1u3tpQyQqH4YNSoAicx/SPww79vJ1ArYls2Ag7MtcHXmA5rHnET72S3wgOya+ALsH/CJ2EelGPkGvjYT7BkKFhMAAAAASUVORK5CYII=';
            break;
        case 'RJ':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAX1QTFRFAK/v////AAAAf9f3Fbbw6vj+BajiAq3r/Pz8AK/u/v7+iMC6DKRVVG5KXr+SdLzVmcbYRrrgorefTLDY4+LdPa7a+/v6EKXWG5y89fX2MZilpaOUJJqvzs/TqGZqCabaLYmTdlhm1t/csq2yMa/ZR6rGjoKPcmVwN4iEgayYhc3inz8+FKHJysWmKplq0dTB9vb25uvjO67UlbOjQaSveam9VnKRmWhVOpCTbamll5yTU5GIG5i21dXYm7SMssCiYXt0qpugVJa4w8THHoul7+7uwdG0klhhl5SLVXRR09HATqCmIJXHCqviKo+asr6tp6mqiaSgN5WcHrLpqHF12t3O3tvBfNDtLJuvrL2gi7GkPZGMJo2h8O/hebXOVrPXv8vQ4OLhuLi1G5/Gu7qj6fL2F5zSub+nMo+JyMq1LpShJZaigqq8z8ynpKuSnKCY1NfHMZtpVHlWMaCwh66bEK3fOpqfRqey3ufkkbel2Nnb6OjnNZukucOoA6/ut2isoAAAAH90Uk5T//8A/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////zfBpycAAADeSURBVHicY2BiRAGsLAwogImB6gpSgwkokI3jZMetQMyVQ8mITYEdlwKOTBEhk4gg8QxOHApC9St9fdIUHZJ1sCvgSi/wdnI3kzO3ycKuoDpPV11N2TFEWypbHlkBMwyEW2ryFll5ePKWGGvBBYEK4IrZ/Gp4+Pj5+Xhy7QzhxqIo0JDQ4xYW5i4U8RLDqoDdRaJMUEBAMKo2kgOrAgbx6BiL4nIhezcuLqwKOEVNrWVUKhJT/G0lsZtQJ5oTmB8gneRcZYBdAQNDqWp8QlgscuShKWBgYGFFjV0qKAAA8uEiGwep0NsAAAAASUVORK5CYII=';
            break;
        case 'RN':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAX1QTFRF////AJI/AAAAf8ifn7EXC5Q8//76//zy3KYE///9//z0+MMAnKVKCorKCJI98cs4/vbav54D+cwnIZc2tsCufZQddsXwo8Xc+MYOJJk2/vfd67QDmY4JC3AsQWwYIFsdrMG3vZMNNZm1Zooi0+Prf6Owo7B1AIjSe5s6nqA0Uo1r0rsK1LsunKQSHJM2esTlnMHV59Fi5cQZgnURgqZfhMiY9uzIypsS4LoFhsTPhq0dr7yWdoEPgZUVp5UQvKMl8c1IksK3vKENQnYw5b8UMWIkp9PrHZTM7sUuW56CcZQbFnEsyagpmqtuw8i+UYEe3cQ6sJgK8cMJaJNH6b8DlJ0WkceIZIga06cYfYgQs40FwbELpZgQlrAZy5YI6LICfsfv8NJW78Mk8ddqN3Ah3rcEN5HA/fPQInIobI4g6Mc2o6BOa4IogpYgG2Agu6wo7r8BoqlOCnQzF5c5MGIrH2UhuaYMg8TUzp0V9sIE78ksgsnuZIwb8r8AHpHObeVNNgAAAH90Uk5T//8A/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////zfBpycAAADOSURBVHicY2BixA8Y6KqAz4oFBmKLsSlg1S7gtuDmr6wVFEyVxKpA19bLX8fMQaY0L1IYq4KajCLnfI+kHG9ZOT2sbghPcfUVEfFTK5G3wW5CdKCxtbiBuIJiVAiyG5hhwNQoPs5RzE2sPIIjKAwuysDEAAPsQtIVlgkq1fo+HBICcFFUBeZKdapp7vY4FHBVldmZ8KrzejrFuEhhU8BpGKosqqEVnJspGsCFTQEDezI/T6FmNk9WIpIByAqAhrCxpXOxsXEy4FKADdBeAQBP8yJM8AwU7QAAAABJRU5ErkJggg==';
            break;
        case 'RS':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAU1QTFRF2iUd//UAAJI/AAAA2icf4VFK6YB6BZA+////HoM6//MA/vABAZE/1yce+tgE7IgPxy4glrig8ePfoUIm4U8XJoA5zMnEMJFs9/b0clktqcy4e499rzskT2oz6X5529HR77Gu3TcaaqqFw8Cy/PDw2y8nuLamt7zI/f38ujUitJ1O0yke5FwV2dnX7+3hGYY78rWy+/r52ygd3DIq8akL29rZ2ysc30MZ++ADXGQwtaYv8MXCZp1538QX5bq3//lpz3da8aQLs5BPuJyo+dMF52wT5d2og52d2b8ZuODIi0wp4tqo+/ex9b4Hymts64qG7pgNOnU2ab+O69m0EJhKj0op//UQ0NTG+NEFYmEw3j8Z8KAX+twDZWo6287D9NS253ESr49WVWcy7I+LvzIhuqothk8q750MzW5vtZ2sFoc8zntZ6HUShp+eaZ57Mzh1UQAAAG90Uk5T////AP//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////GkrdGQAAAQ9JREFUeJx1z1dbwjAUgOET6bSlCCIgyJ4is0wnDnCBgntvZbj+/6XtYwFjm+8y502eHDBNEGNnZudNQAJi9mpuAYAAWN47bQY1Q/Du3Z8CLT0Qj7qvZgACOD3eu/cVAIyByN9d5F2u/HLUCKgrUTmr2+93W3OUDmQX1ZXoSMgZjztDERoDLP+srcRwKzvh8Nc3x2DgbLTSC3c4iMW2+lx7eBJsKGCsmcT6k8ez+ZH4fUFObUgCBmhbcnfpbTVpU/5QtveqSAkDVMCR2W5mHAGqYrkUENIBiK6VSun0yY2ERuEACr6HVu0cIQKQrz8PJhHeHxB8LFaRriGQU0Xp/+UxKNs7t0ZDDVQsdYE0VsAPZfsgwtwpOW4AAAAASUVORK5CYII=';
            break;
        case 'RO':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAIRQTFRFACWAAJlM8+cYAAAAeoZM////HqNFAppNGKBH/P3+298dAiaAocwpj9Kv8fP4DjGH7uUZdYi6S7E89/a31d0eL02Xx8/jisUuQK0+qbXURLNurrajO1edIUGQwNYjOqtAabs1xujWTGWlE6BZHT2OLEqV4eEc0NbnqM8oNFGaq9An8eYYn6KypwAAACx0Uk5T////AP/////////////////////////////////////////////////////X5eejAAAAqElEQVR4nK3O2RaCIBCAYSdDBfd9y33X93+/0jwdQsyb/kvmA0YQhZ+Jwt9B214A274Aw3AO1Myfaozryc9U/gtdgLaC7uwLM8YI4dg83+FhIGQ8mB3uVCmqKpTSJy9wo3L1ptFd+uQbkEQGkBNyApZRgi1pXHiAODLsyQ45glkCKmlmQF8CU9nTIC/YOUCRf4AVKsc5gBJab+BFvPFa5K1A417fH9HEJ66gCiEK56BNAAAAAElFTkSuQmCC';
            break;
        case 'RR':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAWJQTFRFAKX/////AIIA+MMAIG8A2gIA3AMDCnwA+tnZ/fPz//vv+tNG+cgUpd//5PHk9vv2+MYQBKb/AoMC/v//+MMCD6fv/vjjO6zDUcH/+/7/+tdW++OL/v789cMBBqX5/fLH7fn/+tlf8vnyM7f/3fP/H7D/FIwU/vLK+MUK//75+MUHW5EAGK3/nc+d2bsA+95zi8aLiKUA/PfhEIoQo75xY7Jj++W3bcfv99JGSYMp1r8kzebNV6FNwOn/OpEAG6jjotPNtLtGycdLPJ88f8B/6PPvxsCl+MQE1fD/K7T/Ho8Y/vfflLdoh83fX8b/T6hPl8yXE4cA+9+g+cogt+b/WK1Y3OPS1MU0/fHD/fLw6L8AIpMi3O7cBqb4DIgMBqf/wb9GirVx+v3/F6nvRYsA+9toD34E++B9/vrrWMT/Dqr/Z8n/XbBdm82b+thaxer/jseODX0A+cskBab8JZQk/fPNkQhzuAAAARNJREFUeJx9kOVfwzAQQHMXYMCk3da5u+DuOtzdYbi7/P+k20iz31re1/eS3IUQXRZ3fFBGVxe9CwAGQThMSMrqA8PA4yHeKIBxcNFrdcI/wdfwZ1DU0ka1b50MKT+Ct+2ecXfqcl0NzPop9Ter5JiOd6YReTCxMnU+aJYplc2MGzc4bX2IQlBcjSm0ghJbhuD7MYpBig0fyJd9PsBef0YUgse10u4Ri+otEZBe0igGibfL0tCZrBpkMyMFBwqB/SFZ2eqOHWeXTH+jBrEnxv62vt+ef3V374faN8XgKcm/5UDuyEltS11H42LQpLHVf7g3emv6uG4xaZCGKuprII0ac0N1tRA+QXymB3Xgwcm6Q8/jLxWAIv7PrIU0AAAAAElFTkSuQmCC';
            break;
        case 'SC':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAY9QTFRF7jMzqdBGAAAA////7jMz8EdH//7+wN15wpY/qs5Gx+CH4u/A50M1sdRX8/jksrtD2WI41Ws58EdH40s270ZG7Dc0ospF///+9Pnosb5E2WM7ps1Fqb1CqM9G+fzyn8hFwJE+kcJEqspFo8tFcp1Mu08snUQsmrY5cJZwXHQkuoE2s7ODdG4qwkg5TYVArHdkxreVq4I2p5U/ja45nHU0urlzloJwcJQ1w8mwcX0omZZei4M1wFNGkpV5krBAhmZGk1swo5V3j49jZX0xrphZt8iDwcWeok9HVZM9fIMeqKc9pqGOs5tbqKNHzM6ed3xBjnJUtKGTuVwzrkc2YnEwgp9EfHZFno19xcOOpJeEi6BmVJI9bZJBjLRGtoJnyMWXe3cyurabt405Vpg+c4kkwbt9r6xDtqyYkp9/paB0h7NBWXI2bZw9zMmte6Q/mr0/yFNKpUAszsqZWo08jrFAXJE8wUsri4o2xkw2raNDn8VDkrNFxsyzc5g1lbRAqsFDWJw/XXE0o8dCe6JDuYU3ZYgUugAAAIV0Uk5T//8A//r/+///////////////+v///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////4okCuAAAAEOSURBVHicY2BiYcADWJgYSFQgKigoik+BMAcnJ4cwbgUC/IxJXoz8AjgU8HBwVjUFOcgrcnLwICsQYgUDESlJ6XxPdVcnxeQ8aUkpEYioEFABGzMISLAzMtaF6JRnelsnNNoxMrJLgIXZYAq4eRkZZZsz0u3DzQISbWOkGRl5uREKxPm4GIFA1ty5JjfSMd5Cr1gMxOfiE4cqkGMH8RnFalNi3VKLtKs9SpXBAuxyaCYYa4aaWvlFqEQ3oJkAdYOMoWVUoFGagUa2iQyqG6C+UNKq8C8sU1UL021RQvYFIhwqC3zigt31XWx8UcIBEZIKMspZ8iU5YvUKPFiDGhwXQIAzLoiITcLpAQMQoQAA0BEp29j2MSEAAAAASUVORK5CYII=';
            break;
        case 'SP':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAARRQTFRF/v7+ISElIiImICAkc3N2mZma9PT0Z2dpxMTFjIyOR0dK9/f3VlZZYGBjoKChMjI2Q0NG9vb2x8fI77/AxAAIKUKS00EGxQUIzCUHyBQa1EQFm6bMyhoH0T0Z2F5hzCUp7rq7zikHyh4IxAII3XJ12cbSYzI2WCouaHqyzCYa25Sb77EC0DU6Shke66cCxw4VzzIGPVOc0cXG8OLmz1BX6bW3qHZ59tra77u9TWGko63QckFFyM7j6aqsyh0j6OrzMUmW5ODqyRkasrrX9MUB1trqSV+ixQkK0TtAUman+evrxgwT7e70eUdL8LoCyRwh1lRXyyQkNk2Y8PL4zSgtzSwZxw4Hyh8aVmqp0j9DyyEnxggImoUDGgAAALhJREFUeJyF0sdSAlEUhOEmIyAi3sl5BrOSg4GgooiJjIC8/3vgkqk7Vedb965/SPKWfd0MFSY50m2IB7kolq6ev+2NPhJ/Dnn4FfXOuvLxcDpV3TsEYKzbngmCcF9n7DHD+x/8YX4hPPVNxs5yPHjOu423gVazyl7jmAf5Wl20etpnwX1Vm1keVsalMp6YlvJiLM+PeDjZU83zkCQgTECMgDgBKQKihKB7/BIEBDTiDyZNwAEBEcIOhC0jmVA5JGEAAAAASUVORK5CYII=';
            break;
        case 'SE':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAHtQTFRF+MMAAJI/KBZvAAAAQp8uv7cPfKofFFRXkGw3Oyp7KhhwNiV4KxlxLRxySjuGZViYpp/Dv7rVLBpyeW6lZ1qZdWmjNCR3MiF2l465ysXba1+cSH874+HstrDOc2Y/dmqj/v7+UUOLg3mscmahPCx8cWWfVkeOzcndPy9+mSO4UgAAACl0Uk5T////AP/////////////////////////////////////////////////N8ZSeAAAAiklEQVR4nMXP2Q6CMBQE0DpVkS7s4C64+/9f6L2YmJByedR56Dz0pOkojQZ9GkSzMFppe7wbur/lqQBM+wA8fJkIgJ8vSj5FUNTZYfOaALDP7kp1WoT5gHV22VGtVBgGMZyBoxKAzVv+YbytBODSMwNfJQKIvtkvwxAY2Tac+QMwnwyBkW3Dmf8HbyI5B7jenSRwAAAAAElFTkSuQmCC';
            break;
        case 'TO':
            $bandeira = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAVCAMAAAAQExzYAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAATwAAAE8BY4r91wAAAMlQTFRF/////5YAGUa0AAAA/+rM/8l9//r0/5kI//Xn//He//78/9qm/5YB/f7+/6Ul/7lW//7+/+K4//37HUm1//z4//bo/5gE/8+L7PD5IEy2/6kw09zx/5wP9vj8/6EbMVq8JlG5eJPT+/z+/8Jq/7hTkqjbSWzD/82Hvsvq/6Mfco7R/9WZo7ThKlS5/79jV3jI/7A//PPnt8Ph4ef1Y4LM/+bDydTt9Pb7UnTGm6/e/9GQ//Tk/6w2/7JFNVy9/54T/9uplarc//frM7fMhAAAAEN0Uk5T////AP///////////////////////////////////////////////////////////////////////////////////5AyK5oAAADgSURBVHicfdDnVgIxEAXguW62BQS2S5MmvalgAZX2/g/lxnCyR1gyPzNfkplLxt1lBZMHUmXQFZjP7kkDguWKSAPaxybpwODd5xpQ7XyQ49wGu9cXIsaIojAPVDtNYgXXNN0Cy/pMgdZILGeWbLtkqrY/bJxBsBbZVKxyESiWrcpfm7NnQILWppseOF5SQ1q1xBOThttHnMFnXWb374XoKYYE7X5Xfapm4J64LkE9i15tYfVsKJDtFEYyh6/DGMgDotIks+t5gPtv34AGWEkDOuD+xNAAPt0DGnBaxJd9GL+23w7m3w4AlQAAAABJRU5ErkJggg==';
            break;
    }

    return $bandeira;
}

function isUuid4($str)
{
    $re = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

    preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0);

    if (count($matches) > 0) {
        return true;
    }
    return false;

}

function validaTelefone($t)
{
    $rule = new ValidaCPFCNPJ($t);
    if (isUuid4($t) || filter_var($t, FILTER_VALIDATE_EMAIL) || $rule->valida()) {
        return false;
    }

    return (bool)preg_match('/[0-9]{10,11}/', preg_replace('/\D/', '', $t));
}

function getFungamesUserId($request)
{

}

function getOnlyNumbers($str)
{


    return preg_replace('/[^0-9]/', '', $str);
}

function getPixTypeOrFails($value)
{
    $rule = new ValidaCPFCNPJ($value);
    if ($rule->valida()) {
        return "cpf";
    } elseif (filter_var($value, FILTER_VALIDATE_EMAIL)) {
        return 'email';
    } elseif (isUuid4($value)) {
        return 'aleatoria';
    } elseif (validaTelefone($value)) {
        return 'telefone';
    } else {
        throw new \Exception("Invalid PIX key.");
    }

}

function hasAllIndexsOrFails(array $arr, array $requiredIndexs)
{
    foreach ($requiredIndexs as $requiredIndex) {
        if (!isset($arr[$requiredIndex])) {
            throw new \Exception("Index $requiredIndex not found.");
        }
    }
}

function cashoutIsActive(): bool
{
    $val = MetaData::getValue('cashout_active', 1, '', true);
    if ($val == 1 || $val === true) {
        return true;
    }
    return false;
}

function cashinIsActive(): bool
{
    $val = MetaData::getValue('deposit_active', 1, '', true);
    if ($val == 1 || $val === true) {
        return true;
    }
    return false;
}

function getCacheOrCreate($cacheKey, $instance, $callback, $timeInMinutes = 3600)
{
    if (Cache::has($cacheKey)) {
        return Cache::get($cacheKey);
    } else {
        $expiresAt = now()->addMinutes($timeInMinutes);
        Cache::put($cacheKey, $callback($instance), $expiresAt);
        return Cache::get($cacheKey);
    }
}

function getAboveLevel($level)
{
    switch ($level) {
        case 'master':
            return 'supervisor';
        case 'supervisor':
            return 'gerente';
        case 'gerente':
            return 'subgerente';
    }
}

function loadingPage($loadingText = null)
{
    if (is_null($loadingText)) {
        $loadingText = __("pagination.loading");
    }
    return view('components.ui.loading-page', ['loadingText' => $loadingText]);
}
