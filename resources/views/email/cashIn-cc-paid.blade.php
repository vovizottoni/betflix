@extends('email.layouts.default-email')



@section('content-email')


    <div style="padding: 100px 0; text-align: center; color :#fff; margin: 0 auto; max-width: 100%; width: 600px">
        <h2 style="color :#fff !important;">Olá {{ $parametros['name'] }}, </h2>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;">seu depósito via cartão de crédito foi confirmado na BrazaBet.</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>transação:</b> Depósito via CARTÃO DE CRÉDITO CONFIRMADO</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>Conta da BrazaBet:</b> {{ $parametros['account_id_name'] }}</p>


        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>valor:</b> R$ {{ number_format($parametros['value_'], 2, ',', '.') }}</p>

        <br>

        <br>
        <br>
        <br>
        <br>

        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>Código da transação:</b> {{ $parametros['transaction_code'] }}</p>
        <br>
    </div>

@endsection