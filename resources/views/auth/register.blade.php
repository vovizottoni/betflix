<x-guest-layout>
    <x-jet-authentication-card class="bg-base-900">
        <a @if (Auth::check()) href="/games" @else href="/" @endif class="w-full logo relative block mb-20">
            <img class="mx-auto" src="{{asset('assets/images/branding/horizontal-branding.png')}}" style="max-height: 40px;">
        </a>

        <x-jet-validation-errors class="mb-4" />

        <style type="text/css">
            .checkbox,
            .checkbox:checked,
            .checkbox[checked=true],
            .checkbox[aria-checked=true],
            [type=text]:focus,
            [type=email]:focus,
            [type=url]:focus,
            [type=password]:focus,
            [type=number]:focus,
            [type=date]:focus,
            [type=datetime-local]:focus,
            [type=month]:focus,
            [type=search]:focus,
            [type=tel]:focus,
            [type=time]:focus,
            [type=week]:focus,
            [multiple]:focus,
            textarea:focus,
            select:focus {
                border-color: 2px solid #ffffffb3 !important;
            }
        </style>

        <form method="POST" class="flex flex-col gap-2" action="{{ route('register') }}">
            @csrf

            <p class="font-bold text-xl mb-6 text-white">{{ __('auth.register') }}</p>

            <div>
                <x-jet-input id="name" type="text"
                    name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="{{ __('auth.name') }}" class="{{ $errors->has('name') ? ' input-error' : ' ' }}"
                    style="font-size: 17px !important; padding: 13px 20px; margin-top: -5px; color: #fff !important; border-radius: 4px !important;" />

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <small>{{ $errors->first('name') }}</small>
                    </span>
                @endif
            </div>

            {{-- <div>
                <select name="gender" id="gender"
                    class="{{ $errors->has('gender') ? 'bg-transparent border-0 text-white text-opacity-50 block mt-1 w-full input-error' : 'bg-transparent border-0 text-white text-opacity-50 block mt-1 w-full' }}"
                    required
                    placeholder="{{ __('auth.select_one_option') }}"
                    style="font-size: 17px !important; padding: 13px 12px; border-bottom: 2px solid #ffffffb3;">
                    <option @if (old('gender') == '') selected @endif value="">
                        {{ __('auth.select_one_option') }}</option>
                    <option @if (old('gender') == 'm') selected @endif value="m">
                        {{ __('auth.gender_male') }}</option>
                    <option @if (old('gender') == 'f') selected @endif value="f">
                        {{ __('auth.gender_female') }}</option>
                </select>

                @if ($errors->has('gender'))
                    <span class="text-red">
                        <small style="color:#f57576">{{ $errors->first('gender') }}</small>
                    </span>
                @endif
            </div> --}}

            <div>
                <x-jet-input id="birth_date" onkeyup="mascaraDataAniversario(this)"
                    class="{{ $errors->has('birth_date') ? 'input-error birth-date-mask' : 'birth-date-mask' }}"
                    type="text"
                    name="birth_date" :value="old('birth_date')" required autofocus placeholder="{{ __('auth.birth_date') }}"
                    maxlength="10"
                    style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;" />

                @if ($errors->has('birth_date'))
                    <span class="text-red">
                        <small style="color:#f57576">{{ $errors->first('birth_date') }}</small>
                    </span>
                @endif
            </div>


            <div>
                <x-jet-input id="cpf" 
                    onkeyup="mascaraCpfCnpj(this)"
                    class="{{ $errors->has('cpf') ? 'text-white text-opacity-50 block mt-1 w-full input-error' : 'text-white text-opacity-50 block mt-1 w-full' }}"
                    type="text"
                    name="cpf" :value="old('cpf')" required autofocus 
                    minlength="9" maxlength="18"
                    placeholder="{{ __('auth.cpf_numbers_only') }}"
                    style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"
                    />
                    

                @if ($errors->has('cpf'))
                    <span class="text-red">
                        <small style="color:#f57576">CPF ou CNPJ inválido</small>
                    </span>
                @endif
            </div>

            <div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
                    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                    $(function() {
                        $("#my_invite_code").on("keyup", function(event) {
                            var value = $(this).val();
                            value = value.toUpperCase();
                            $(this).val(value.replace(/[^0-9a-zA-Z_]/g, ""));
                        });
                    });
                </script>

                <x-jet-input id="my_invite_code" class="uppercase text-white text-opacity-50 block mt-1 w-full"
                    type="text" name="my_invite_code" :value="old('my_invite_code')" required autofocus
                    autocomplete="my_invite_code" placeholder="Usuário"
                    style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"
                    minlength="6" maxlength="20"
                    class="{{ $errors->has('my_invite_code') ? 'input-error' : ' ' }}"/>

                @if ($errors->has('my_invite_code'))
                    <span class="text-red">
                        <small style="color:#f57576">{{ $errors->first('my_invite_code') }}</small>
                    </span>
                @endif
            </div>


            <?php
            
            /*  //select country escondido e no backend o padrao eh BR por enquanto

            <div>

                <style>
                    input#my_invite_code {
                        text-transform: uppercase;
                    }
                    ::-webkit-input-placeholder {
                        text-transform: none;
                    }
                    :-moz-placeholder {
                        text-transform: none;
                    }
                    ::-moz-placeholder {
                        text-transform: none;
                    }
                    :-ms-input-placeholder {
                        text-transform: none;
                    }
                    ::placeholder {
                        text-transform: none;
                    }
                    input.select2-search__field {
                        font-size: 17px !important;
                        padding: 13px 20px;
                        color: #fff !important;
                        border-radius: 4px !important;
                        background: #2e2e2e;
                        height: 52px;
                        border: 1px solid #ffffff0d !important;
                    }
                    .flag-text {
                        margin-left: 10px;
                        font-weight: 300 !important;
                        font-size: 16px;
                        opacity: 0.8;
                    }

                    .select2-container--default .select2-selection--single .select2-selection__arrow {
                        height: 26px;
                        position: absolute;
                        top: 15px;
                        right: 10px;
                        width: 30px;
                    }

                    .select2{ width: 100% !important; }
                    .select2-container {font-size: 17px !important; margin-top: 5px !important; padding: 13px 20px !important; color: #fff !important; border-radius: 4px !important; background-color: #2e2e2e !important; border-color: #2e2e2e !important;}

                    .select2-selection__rendered{ color: #929292 !important;  opacity: 1;  }

                    .select2-search__field{ color: black; }
                    .select2-search__field::placeholder{ color: black; }


                    .select2-container--default .select2-selection--single {

                        background-color: #2e2e2e !important;
                        border: unset !important;
                        border-radius: unset !important;

                    }
                    .select2-results__option{background-color: #1a1817 !important; border-color: #2e2e2e !important; }




                    .select2-dropdown {
                        border: 0px !important;
                    }

                    .select2-dropdown {
                        background-color: #1a1817 !important;
                        border: 0px !important;
                        border-radius: 4px !important;
                    }

                    .select2-container .select2-selection--single .select2-selection__rendered {
                        padding: 0px !important;
                    }

                    .flag-icon.flag-icon-squared {
                        width: 1.3em !important;
                        height: 1.3em !important;
                        border-radius: 3px !important;
                        border: 2px solid #fff !important;
                    }

                    ul#select2-country-gh-results {
                        padding: 15px !important;
                    }
                </style>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"/>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css"/>

                <script>
                    (function($) {
                            $(function() {
                                var isoCountries = [
                                    { id: '##', text: '{{__("auth.click_and_enter_country")}}'},
                                    { id: 'BR', text: 'Brasil'},
                                    { id: 'AF', text: 'Afghanistan'},
                                    { id: 'AX', text: 'Aland Islands'},
                                    { id: 'AL', text: 'Albania'},
                                    { id: 'DZ', text: 'Algeria'},
                                    { id: 'AS', text: 'American Samoa'},
                                    { id: 'AD', text: 'Andorra'},
                                    { id: 'AO', text: 'Angola'},
                                    { id: 'AI', text: 'Anguilla'},
                                    { id: 'AQ', text: 'Antarctica'},
                                    { id: 'AG', text: 'Antigua And Barbuda'},
                                    { id: 'AR', text: 'Argentina'},
                                    { id: 'AM', text: 'Armenia'},
                                    { id: 'AW', text: 'Aruba'},
                                    { id: 'AU', text: 'Australia'},
                                    { id: 'AT', text: 'Austria'},
                                    { id: 'AZ', text: 'Azerbaijan'},
                                    { id: 'BS', text: 'Bahamas'},
                                    { id: 'BH', text: 'Bahrain'},
                                    { id: 'BD', text: 'Bangladesh'},
                                    { id: 'BB', text: 'Barbados'},
                                    { id: 'BY', text: 'Belarus'},
                                    { id: 'BE', text: 'Belgium'},
                                    { id: 'BZ', text: 'Belize'},
                                    { id: 'BJ', text: 'Benin'},
                                    { id: 'BM', text: 'Bermuda'},
                                    { id: 'BT', text: 'Bhutan'},
                                    { id: 'BO', text: 'Bolivia'},
                                    { id: 'BA', text: 'Bosnia And Herzegovina'},
                                    { id: 'BW', text: 'Botswana'},
                                    { id: 'BV', text: 'Bouvet Island'},
                                    { id: 'IO', text: 'British Indian Ocean Territory'},
                                    { id: 'BN', text: 'Brunei Darussalam'},
                                    { id: 'BG', text: 'Bulgaria'},
                                    { id: 'BF', text: 'Burkina Faso'},
                                    { id: 'BI', text: 'Burundi'},
                                    { id: 'KH', text: 'Cambodia'},
                                    { id: 'CM', text: 'Cameroon'},
                                   // { id: 'CA', text: 'Canada'},
                                    { id: 'CV', text: 'Cape Verde'},
                                    { id: 'KY', text: 'Cayman Islands'},
                                    { id: 'CF', text: 'Central African Republic'},
                                    { id: 'TD', text: 'Chad'},
                                    { id: 'CL', text: 'Chile'},
                                    { id: 'CN', text: 'China'},
                                    { id: 'CX', text: 'Christmas Island'},
                                    { id: 'CC', text: 'Cocos (Keeling) Islands'},
                                    { id: 'CO', text: 'Colombia'},
                                    { id: 'KM', text: 'Comoros'},
                                    { id: 'CG', text: 'Congo'},
                                    { id: 'CD', text: 'Congo}, Democratic Republic'},
                                    { id: 'CK', text: 'Cook Islands'},
                                    { id: 'CR', text: 'Costa Rica'},
                                    { id: 'CI', text: 'Cote D\'Ivoire'},
                                    { id: 'HR', text: 'Croatia'},
                                    { id: 'CU', text: 'Cuba'},
                                    { id: 'CY', text: 'Cyprus'},
                                    { id: 'CZ', text: 'Czech Republic'},
                                    { id: 'DK', text: 'Denmark'},
                                    { id: 'DJ', text: 'Djibouti'},
                                    { id: 'DM', text: 'Dominica'},
                                    { id: 'DO', text: 'Dominican Republic'},
                                    { id: 'EC', text: 'Ecuador'},
                                    { id: 'EG', text: 'Egypt'},
                                    { id: 'SV', text: 'El Salvador'},
                                    { id: 'GQ', text: 'Equatorial Guinea'},
                                    { id: 'ER', text: 'Eritrea'},
                                    { id: 'EE', text: 'Estonia'},
                                    { id: 'ET', text: 'Ethiopia'},
                                    { id: 'FK', text: 'Falkland Islands (Malvinas)'},
                                    { id: 'FO', text: 'Faroe Islands'},
                                    { id: 'FJ', text: 'Fiji'},
                                    { id: 'FI', text: 'Finland'},
                                    { id: 'FR', text: 'France'},
                                    { id: 'GF', text: 'French Guiana'},
                                    { id: 'PF', text: 'French Polynesia'},
                                    { id: 'TF', text: 'French Southern Territories'},
                                    { id: 'GA', text: 'Gabon'},
                                    { id: 'GM', text: 'Gambia'},
                                    { id: 'GE', text: 'Georgia'},
                                    { id: 'DE', text: 'Germany'},
                                    { id: 'GH', text: 'Ghana'},
                                    { id: 'GI', text: 'Gibraltar'},
                                    { id: 'GR', text: 'Greece'},
                                    { id: 'GL', text: 'Greenland'},
                                    { id: 'GD', text: 'Grenada'},
                                    { id: 'GP', text: 'Guadeloupe'},
                                    { id: 'GU', text: 'Guam'},
                                    { id: 'GT', text: 'Guatemala'},
                                    { id: 'GG', text: 'Guernsey'},
                                    { id: 'GN', text: 'Guinea'},
                                    { id: 'GW', text: 'Guinea-Bissau'},
                                    { id: 'GY', text: 'Guyana'},
                                    { id: 'HT', text: 'Haiti'},
                                    { id: 'HM', text: 'Heard Island & Mcdonald Islands'},
                                    { id: 'VA', text: 'Holy See (Vatican City State)'},
                                    { id: 'HN', text: 'Honduras'},
                                    { id: 'HK', text: 'Hong Kong'},
                                    { id: 'HU', text: 'Hungary'},
                                    { id: 'IS', text: 'Iceland'},
                                    { id: 'IN', text: 'India'},
                                    { id: 'ID', text: 'Indonesia'},
                                    { id: 'IR', text: 'Iran}, Islamic Republic Of'},
                                    { id: 'IQ', text: 'Iraq'},
                                    { id: 'IE', text: 'Ireland'},
                                    { id: 'IM', text: 'Isle Of Man'},
                                    { id: 'IL', text: 'Israel'},
                                    { id: 'IT', text: 'Italy'},
                                    { id: 'JM', text: 'Jamaica'},
                                    { id: 'JP', text: 'Japan'},
                                    { id: 'JE', text: 'Jersey'},
                                    { id: 'JO', text: 'Jordan'},
                                    { id: 'KZ', text: 'Kazakhstan'},
                                    { id: 'KE', text: 'Kenya'},
                                    { id: 'KI', text: 'Kiribati'},
                                    { id: 'KR', text: 'Korea'},
                                    { id: 'KW', text: 'Kuwait'},
                                    { id: 'KG', text: 'Kyrgyzstan'},
                                    { id: 'LA', text: 'Lao People\'s Democratic Republic'},
                                    { id: 'LV', text: 'Latvia'},
                                    { id: 'LB', text: 'Lebanon'},
                                    { id: 'LS', text: 'Lesotho'},
                                    { id: 'LR', text: 'Liberia'},
                                    { id: 'LY', text: 'Libyan Arab Jamahiriya'},
                                    { id: 'LI', text: 'Liechtenstein'},
                                    { id: 'LT', text: 'Lithuania'},
                                    { id: 'LU', text: 'Luxembourg'},
                                    { id: 'MO', text: 'Macao'},
                                    { id: 'MK', text: 'Macedonia'},
                                    { id: 'MG', text: 'Madagascar'},
                                    { id: 'MW', text: 'Malawi'},
                                    { id: 'MY', text: 'Malaysia'},
                                    { id: 'MV', text: 'Maldives'},
                                    { id: 'ML', text: 'Mali'},
                                    { id: 'MT', text: 'Malta'},
                                    { id: 'MH', text: 'Marshall Islands'},
                                    { id: 'MQ', text: 'Martinique'},
                                    { id: 'MR', text: 'Mauritania'},
                                    { id: 'MU', text: 'Mauritius'},
                                    { id: 'YT', text: 'Mayotte'},
                                    { id: 'MX', text: 'Mexico'},
                                    { id: 'FM', text: 'Micronesia}, Federated States Of'},
                                    { id: 'MD', text: 'Moldova'},
                                    { id: 'MC', text: 'Monaco'},
                                    { id: 'MN', text: 'Mongolia'},
                                    { id: 'ME', text: 'Montenegro'},
                                    { id: 'MS', text: 'Montserrat'},
                                    { id: 'MA', text: 'Morocco'},
                                    { id: 'MZ', text: 'Mozambique'},
                                    { id: 'MM', text: 'Myanmar'},
                                    { id: 'NA', text: 'Namibia'},
                                    { id: 'NR', text: 'Nauru'},
                                    { id: 'NP', text: 'Nepal'},
                                    { id: 'NL', text: 'Netherlands'},
                                    { id: 'AN', text: 'Netherlands Antilles'},
                                    { id: 'NC', text: 'New Caledonia'},
                                    { id: 'NZ', text: 'New Zealand'},
                                    { id: 'NI', text: 'Nicaragua'},
                                    { id: 'NE', text: 'Niger'},
                                    { id: 'NG', text: 'Nigeria'},
                                    { id: 'NU', text: 'Niue'},
                                    { id: 'NF', text: 'Norfolk Island'},
                                    { id: 'MP', text: 'Northern Mariana Islands'},
                                    { id: 'NO', text: 'Norway'},
                                    { id: 'OM', text: 'Oman'},
                                    { id: 'PK', text: 'Pakistan'},
                                    { id: 'PW', text: 'Palau'},
                                    { id: 'PS', text: 'Palestinian Territory}, Occupied'},
                                    { id: 'PA', text: 'Panama'},
                                    { id: 'PG', text: 'Papua New Guinea'},
                                    { id: 'PY', text: 'Paraguay'},
                                    { id: 'PE', text: 'Peru'},
                                    { id: 'PH', text: 'Philippines'},
                                    { id: 'PN', text: 'Pitcairn'},
                                    { id: 'PL', text: 'Poland'},
                                    { id: 'PT', text: 'Portugal'},
                                    { id: 'PR', text: 'Puerto Rico'},
                                    { id: 'QA', text: 'Qatar'},
                                    { id: 'RE', text: 'Reunion'},
                                    { id: 'RO', text: 'Romania'},
                                    { id: 'RU', text: 'Russian Federation'},
                                    { id: 'RW', text: 'Rwanda'},
                                    { id: 'BL', text: 'Saint Barthelemy'},
                                    { id: 'SH', text: 'Saint Helena'},
                                    { id: 'KN', text: 'Saint Kitts And Nevis'},
                                    { id: 'LC', text: 'Saint Lucia'},
                                    { id: 'MF', text: 'Saint Martin'},
                                    { id: 'PM', text: 'Saint Pierre And Miquelon'},
                                    { id: 'VC', text: 'Saint Vincent And Grenadines'},
                                    { id: 'WS', text: 'Samoa'},
                                    { id: 'SM', text: 'San Marino'},
                                    { id: 'ST', text: 'Sao Tome And Principe'},
                                    { id: 'SA', text: 'Saudi Arabia'},
                                    { id: 'SN', text: 'Senegal'},
                                    { id: 'RS', text: 'Serbia'},
                                    { id: 'SC', text: 'Seychelles'},
                                    { id: 'SL', text: 'Sierra Leone'},
                                    { id: 'SG', text: 'Singapore'},
                                    { id: 'SK', text: 'Slovakia'},
                                    { id: 'SI', text: 'Slovenia'},
                                    { id: 'SB', text: 'Solomon Islands'},
                                    { id: 'SO', text: 'Somalia'},
                                    { id: 'ZA', text: 'South Africa'},
                                    { id: 'GS', text: 'South Georgia And Sandwich Isl.'},
                                    { id: 'ES', text: 'Spain'},
                                    { id: 'LK', text: 'Sri Lanka'},
                                    { id: 'SD', text: 'Sudan'},
                                    { id: 'SR', text: 'Suriname'},
                                    { id: 'SJ', text: 'Svalbard And Jan Mayen'},
                                    { id: 'SZ', text: 'Swaziland'},
                                    { id: 'SE', text: 'Sweden'},
                                    { id: 'CH', text: 'Switzerland'},
                                    { id: 'SY', text: 'Syrian Arab Republic'},
                                    { id: 'TW', text: 'Taiwan'},
                                    { id: 'TJ', text: 'Tajikistan'},
                                    { id: 'TZ', text: 'Tanzania'},
                                    { id: 'TH', text: 'Thailand'},
                                    { id: 'TL', text: 'Timor-Leste'},
                                    { id: 'TG', text: 'Togo'},
                                    { id: 'TK', text: 'Tokelau'},
                                    { id: 'TO', text: 'Tonga'},
                                    { id: 'TT', text: 'Trinidad And Tobago'},
                                    { id: 'TN', text: 'Tunisia'},
                                    { id: 'TR', text: 'Turkey'},
                                    { id: 'TM', text: 'Turkmenistan'},
                                    { id: 'TC', text: 'Turks And Caicos Islands'},
                                    { id: 'TV', text: 'Tuvalu'},
                                    { id: 'UG', text: 'Uganda'},
                                    { id: 'UA', text: 'Ukraine'},
                                    { id: 'AE', text: 'United Arab Emirates'},
                                    { id: 'GB', text: 'United Kingdom'},
                                   // { id: 'US', text: 'United States'},
                                    { id: 'UY', text: 'Uruguay'},
                                    { id: 'UZ', text: 'Uzbekistan'},
                                    { id: 'VU', text: 'Vanuatu'},
                                    { id: 'VE', text: 'Venezuela'},
                                    { id: 'VN', text: 'Viet Nam'},
                                    { id: 'VG', text: 'Virgin Islands}, British'},
                                    { id: 'VI', text: 'Virgin Islands}, U.S.'},
                                    { id: 'WF', text: 'Wallis And Futuna'},
                                    { id: 'EH', text: 'Western Sahara'},
                                    { id: 'YE', text: 'Yemen'},
                                    { id: 'ZM', text: 'Zambia'},
                                    { id: 'ZW', text: 'Zimbabwe'}
                                ];

                                function formatCountry (country) {
                                if (!country.id) { return country.text; }
                                var $country = $(
                                    '<span class="flag-icon flag-icon-'+ country.id.toLowerCase() +' flag-icon-squared"></span>' +
                                    '<span class="flag-text">'+ country.text+"</span>"
                                );
                                return $country;
                                };

                                //Assuming you have a select element with name country
                                // e.g. <select name="name"></select>

                                $("[name='country']").select2({
                                    placeholder: "Please Select a country",
                                    templateResult: formatCountry,
                                    data: isoCountries,
                                });
                            });
                    })(jQuery);
                </script>
                <select name="country" class="custom-select-2"></select>

            </div>

            */
            ?>


            <div>
                <x-jet-input id="email"  type="email"
                    name="email" :value="old('email')" required placeholder="Email"
                    style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"
                    class="{{ $errors->has('email') ? 'input-error' : ' ' }}"
                    />
                @if ($errors->has('email'))
                    <span class="text-red">
                        <small style="color:#f57576">{{ $errors->first('email') }}</small>
                    </span>
                @endif
            </div>

            <div>
                <x-jet-input id="password"  type="password"
                    name="password" required autocomplete="new-password" placeholder="{{ __('auth.password') }}"
                    style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"
                    class="{{ $errors->has('password') ? 'input-error' : ' ' }}"/>
                @if ($errors->has('password'))
                    <span class="text-red">
                        <small style="color:#f57576">{{ $errors->first('password') }}</small>
                    </span>
                @endif
            </div>

            {{-- <div>
                <x-jet-input id="password_confirmation" 
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="{{ __('auth.confirm_the_password') }}"
                    style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"
                    class="{{ $errors->has('password_confirmation') ? 'input-error' : ' ' }}"/>
                @if ($errors->has('password_confirmation'))
                    <span class="text-red">
                        <small style="color:#f57576">{{ $errors->first('password_confirmation') }}</small>
                    </span>
                @endif
            </div> --}}



            <div>

                <script>
                    $(function() {
                        $("#invite_code").on("keyup", function(event) {
                            var value = $(this).val();
                            value = value.toUpperCase();
                            $(this).val(value);
                        });
                    });
                </script>



                @php
                    $INVITECODE_USED = session()->get('INVITECODE_USED');
                    
                @endphp
                @if ($INVITECODE_USED)
                    <x-jet-input id="invite_code" class="text-white text-opacity-50 block mt-1 w-full hidden"
                        type="text" name="invite_code"
                        value="{{ !empty($INVITECODE_USED) ? $INVITECODE_USED : '' }}" autofocus
                        autocomplete="invite_code" placeholder="{{ __('auth.invitation_code') }}"
                        style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"
                        minlength="6" maxlength="20" />
                @else
                    <x-jet-input id="invite_code"  type="text"
                        name="invite_code" autofocus autocomplete="invite_code"
                        placeholder="{{ __('auth.invitation_code') }}"
                        style="font-size: 17px !important; padding: 13px 20px; color: #fff !important; border-radius: 4px !important;"
                        minlength="6" maxlength="20" />
                @endif


            </div>


            <div class="mt-4">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" />

                        <div class="ml-2 font-semibold text-white text-opacity-70">
                            {!! __('auth.i_agree_with_the', [
                                'terms_of_service' => '<a target="_blank" href="#" class="underline">' . __('auth.terms_of_service') . '</a>',
                                'privacy_policy' => '<a target="_blank" href="#" class="underline">' . __('auth.privacy_policy') . '</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
            <div>
                @include('components.captcha-box')
            </div>

            <x-jet-button class="mt-4 mb-8">
                {{ __('auth.register') }}
            </x-jet-button>

            <div class="flex items-center justify-center">
                <a class="text-sm text-white text-opacity-70" href="{{ route('login') }}">
                    {{ __('auth.already_have_an_account') }}
                </a>
            </div>
        </form>
        <script>
            var inputErrors = document.getElementsByClassName("input-error");
            for (var i = 0; i < inputErrors.length; i++) {
                inputErrors[i].addEventListener("click", removeInputError);
            }

            function removeInputError(e) {
                e.target.classList.remove("input-error");            
            }
        </script>

    </x-jet-authentication-card>
</x-guest-layout>
