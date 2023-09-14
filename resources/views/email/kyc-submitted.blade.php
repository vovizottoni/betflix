@extends('email.layouts.default-email')



@section('content-email')


    <div style="padding: 100px 0; text-align: center; color :#fff; margin: 0 auto; max-width: 100%; width: 600px">
        <h2 style="color :#fff !important;">{{__('emails.hello')}}Olá {{ $parametros['name'] }}, </h2>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;">{{__('emails.the_kyc_form')}}</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;">{{__('emails.wait_up_to_5_day')}}</p>
        <p style="padding-top: 0px; font-size: 15px; font-weight: 100 !important; letter-spacing: 1px; line-height: 21px;">{{__('emails.send_date')}} {{ date('d/m/Y', strtotime($parametros['kyc_date_submitted'])) }}</p>

        <br>
        <br>
        <br>
    </div>

@endsection
