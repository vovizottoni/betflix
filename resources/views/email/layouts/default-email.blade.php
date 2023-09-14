<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="color-scheme" content="dark">
        <meta name="supported-color-schemes" content="dark">
        <style>
            /* Layout do arquivo email.css */

            /* Base */
            body,
            body *:not(html):not(style):not(br):not(tr):not(code) {
                box-sizing: border-box;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
                    'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
                position: relative;
            }

            body {
                -webkit-text-size-adjust: none;
                background-color: #000;
                color: #718096;
                height: 100%;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                width: 100% !important;
            }

            p,
            ul,
            ol,
            blockquote {
                line-height: 1.4;
                text-align: left;
            }

            a {
                color: #3869d4;
            }

            a img {
                border: none;
            }

            /* Typography */

            h1 {
                color: #fff;
                font-size: 20px;
                font-weight: bold;
                margin-top: 0;
                text-align: left;
            }

            h2 {
                font-size: 16px;
                font-weight: bold;
                margin-top: 0;
                text-align: left;
            }

            h3 {
                font-size: 14px;
                font-weight: bold;
                margin-top: 0;
                text-align: left;
            }

            p {
                color: #fff;
                opacity: 0.8;
                font-size: 16px;
                line-height: 1.5em;
                margin-top: 0;
                text-align: left;
                font-weight: 200 !important;
            }

            p.sub {
                font-size: 10px;
                color: #fff;
                opacity: 0.8;
                font-weight: 200 !important;
            }

            img {
                max-width: 100%;
            }

            /* Layout */

            .wrapper {
                -premailer-cellpadding: 0;
                -premailer-cellspacing: 0;
                -premailer-width: 100%;
                background-color: #000;
                margin: 0;
                padding: 0;
                width: 100%;
            }

            .content {
                -premailer-cellpadding: 0;
                -premailer-cellspacing: 0;
                -premailer-width: 100%;
                margin: 0;
                padding: 0;
                width: 100%;
            }

            /* Header */

            .header {
                padding: 25px 0;
                text-align: center;
            }

            .header a {
                color: #3d4852;
                font-size: 19px;
                font-weight: bold;
                text-decoration: none;
            }

            /* Logo */

            .logo {
                width: 150px;
                max-width: 100%;
                margin-top: 100px;
            }

            /* Body */

            .body {
                -premailer-cellpadding: 0;
                -premailer-cellspacing: 0;
                -premailer-width: 100%;
                background-color: #000;
                border-bottom: 1px solid #000;

                margin: 0;
                padding: 0;
                width: 100%;
            }

            .inner-body {
                -premailer-cellpadding: 0;
                -premailer-cellspacing: 0;
                -premailer-width: 570px;
                background-color: #171717;
                border-color: #e8e5ef;
                border-radius: 2px;
                border-width: 1px;
                box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015);
                margin: 0 auto;
                padding: 0;
                width: 570px;
            }

            /* Subcopy */

            .subcopy {
                border-top: 1px solid #ffffff17;
                margin-top: 50px;
                padding-top: 25px;
            }

            .subcopy p {
                font-size: 14px;
            }

            /* Footer */

            .footer {
                -premailer-cellpadding: 0;
                -premailer-cellspacing: 0;
                -premailer-width: 570px;
                margin: 0 auto;
                padding: 0;
                text-align: center;
                width: 570px;
            }

            .footer p {
                color: #ffffff66;
                font-size: 12px;
                text-align: center;
            }

            .footer a {
                color: #b0adc5;
                text-decoration: underline;
            }

            /* Tables */

            .table table {
                -premailer-cellpadding: 0;
                -premailer-cellspacing: 0;
                -premailer-width: 100%;
                margin: 30px auto;
                width: 100%;
            }

            .table th {
                border-bottom: 1px solid #edeff2;
                margin: 0;
                padding-bottom: 8px;
            }

            .table td {
                color: #74787e;
                font-size: 15px;
                line-height: 18px;
                margin: 0;
                padding: 10px 0;
            }

            .content-cell {
                max-width: 100vw;
                padding: 32px;
            }

            /* Buttons */

            .action {
                -premailer-cellpadding: 0;
                -premailer-cellspacing: 0;
                -premailer-width: 100%;
                margin: 30px auto;
                padding: 0;
                text-align: center;
                width: 100%;
            }

            .button {
                -webkit-text-size-adjust: none;
                border-radius: 2px;
                margin-top: 20px !important;
                margin-bottom: 20px !important;
                color: #fff;
                font-size: 17px;
                display: inline-block;
                overflow: hidden;
                text-decoration: none;
            }

            .button-blue,
            .button-primary {
                background-color: #000000b0;
                border-bottom: 12px solid #000000b0;
                border-left: 18px solid #000000b0;
                border-right: 18px solid #000000b0;
                border-top: 12px solid #000000b0;
            }

            .button-green,
            .button-success {
                background-color: #48bb78;
                border-bottom: 12px solid #48bb78;
                border-left: 18px solid #48bb78;
                border-right: 18px solid #48bb78;
                border-top: 12px solid #48bb78;
            }

            .button-secondary,
            .button-red,
            .button-error {
                background-color: #cb0000;
                border-bottom: 12px solid #cb0000;
                border-left: 18px solid #cb0000;
                border-right: 18px solid #cb0000;
                border-top: 12px solid #cb0000;
            }

            /* Panels */

            .panel {
                border-left: #2d3748 solid 4px;
                margin: 21px 0;
            }

            .panel-content {
                background-color: #000;
                color: #718096;
                padding: 16px;
            }

            .panel-content p {
                color: #718096;
            }

            .panel-item {
                padding: 0;
            }

            .panel-item p:last-of-type {
                margin-bottom: 0;
                padding-bottom: 0;
            }

            /* Utilities */

            .break-all {
                word-break: break-all;
            }

            /* * * * * * * * * * * * * * * */





        @media only screen and (max-width: 600px) {
        .inner-body {
        width: 100% !important;
        }

        .footer {
        width: 100% !important;
        }
        }

        @media only screen and (max-width: 500px) {
        .button {
        width: 100% !important;
        }
        }
        </style>
    </head>

    <body>

        <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td align="center">
                    <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                        <tr>
                            <td class="header">
                                <a href="<?=url('/')?>" style="display: inline-block;">
                                    <img src="<?=getBaseDomain()?>/assets/images/branding/favicon.png"
                                         alt="BrazaBet" class="logo" style="max-width: 200px">
                                </a>
                            </td>
                        </tr>

                        <!-- Email Body -->
                        <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0"
                                style="border: hidden !important;">
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                       role="presentation">
                                    <!-- Body content -->
                                    <tr>
                                        <td class="content-cell">

                                            <!-- CONTEÚDO // disponivel na view: email/cashIn-pix-waiting-for-payment.blade.php -->
                                            @yield('content-email')
                                            <!-- /CONTEUDO-->


                                            <table class="subcopy" width="100%" cellpadding="0" cellspacing="0"
                                                   role="presentation">
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <a href="<?=getBaseDomain()?>" target="_blank"
                                                           style="display: inline-block;">{{__('emails.click_here_to_access')}}</a>
                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0"
                                       role="presentation">
                                    <tr>
                                        <td class="content-cell" align="center">
                                            © <?php echo date('Y') ?> {{__('emails.all_rights_reserved')}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
