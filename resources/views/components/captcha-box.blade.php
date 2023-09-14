<div class="captcha-box" style="width: 100%; margin-top: 10px">
    <div class="g-recaptcha"  data-sitekey="{{env('CAPTCHA_CLIENT')}}"
         style=" transform:scale(1);-webkit-transform:scale(1);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
</div>
@section('scripts')
    <script src='https://www.google.com/recaptcha/api.js?hl=pt'></script>
@endsection
