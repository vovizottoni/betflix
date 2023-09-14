@extends('email.layouts.default-email')



@section('content-email')


    <div style="padding: 100px 0; text-align: center; color :#fff; margin: 0 auto; max-width: 100%; width: 600px">
        <h2 style="color :#fff !important;">{{__('emails.hello')}} {{ $parametros['name'] }}, </h2>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;">{{__('emails.you_have_made_deposit_request')}}</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.transaction')}}</b>{{__('emails.deposit_via_pix')}}</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.BrazaBet_account')}}</b> {{ $parametros['account_id_name'] }}</p>


        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.deposit_amount')}}</b> R$  {{ number_format($parametros['value_'], 2, ',', '.') }}</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.qrcode')}}</b></p><br>
        <img class="ml-auto mr-auto" src="{{ $parametros['pix_qr_code_url'] }}" alt="QRCode"><br>
        <br>

        <br>
        <br>
        <br>
        <br>

        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.internal_transaction_code')}}</b> {{ $parametros['transaction_code'] }}</p>
        <br>

    </div>

@endsection