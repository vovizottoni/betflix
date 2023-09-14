@extends('email.layouts.default-email')



@section('content-email')


    <div style="padding: 100px 0; text-align: center; color :#fff; margin: 0 auto; max-width: 100%; width: 600px">
        <h2 style="color :#fff !important;">{{__('emails.hello')}} {{ $parametros['name'] }}, </h2>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;">{{__('emails.your_deposit_via_pix')}}</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.transaction')}}</b> {{__('emails.deposit_confimed')}}</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.BrazaBet_account')}}</b> {{ $parametros['account_id_name'] }}</p>


        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.value')}}</b> R$ {{ number_format($parametros['value_'], 2, ',', '.') }}</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.pix_key_used')}}</b> {{  $parametros['pixkey'] }} </p><br>

        <br>

        <br>
        <br>
        <br>
        <br>

        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;"><b>{{__('emails.transaction_code')}}</b> {{ $parametros['transaction_code'] }}</p>
        <br>
    </div>

@endsection