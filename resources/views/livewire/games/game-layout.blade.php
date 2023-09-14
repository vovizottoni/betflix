<?php
$baseUrl = url('/');
?>
<x-app-layout>

    <div>
        <div>
            <style type="text/css">

                main {
                    padding: 3% 0 !important;
                }

                body {
                    padding-bottom: 0px !important;
                }

                .mobile-market-nav a.option.active, .mobile-market-nav a.option:hover {
                    border-bottom: 1px solid #ffffff1c !important;
                }

                .market-nav {
                    display: none;
                }

                .featured-games-list {
                    border-right: 1px solid #ffffff0f;
                    height: 100%;
                    width: 100%;
                    max-width: 300px;
                }

                .game-icon {
                    min-width: 50px;
                    width: 50px;
                    height: 50px;
                    border-radius: 3px;
                    background-size: cover;
                }

                .games-list .game {
                    position: relative;
                    top: 0;
                    transition: ease 0.2s all;
                    cursor: pointer;
                }

                .games-list .game p {
                    opacity: 0.7;
                }

                .games-list .game:hover {
                    top: -5px;
                    transition: ease 0.4s all;
                    opacity: 1;
                }

                nav {
                    border-bottom: 1px solid #ffffff0f;
                }

                @media (max-width: 767px) {
                    nav,
                    header {
                        display: none;
                    }
                }

                .dropdown-content.rounded-md.card-compact.w-64.p-2.shadow.mt-4 {
                    right: -60px;
                    background: #161616 !important;
                }



                .sticky.top-0 {
                    position: inherit !important;
                }

                label.btn.gap-2.bg-red-600.hover\:bg-red-700.border-none.remove-focus {
                    background: #41761c !important;
                }

                span.balance {
                    display: none !important;
                }

                span.balancePlaying {
                    display: block !important;
                }


                span.gameLoading::before {
                  content: '';
                  animation: reveal 12s infinite;
                }

                @keyframes reveal {
                  0% {
                    content: attr(data-first);
                  }

                  33% {
                    content: attr(data-second);
                  }

                  66% {
                    content: attr(data-third);
                  }
                  100%{
                    content: attr(data-first);
                  }
                }

                .horizontal-mobile-menu {
                    display: none !important;
                }

                iframe {
                    width: 100%;
                    max-width: 100%;
                    min-height: 100vh;
                    border-radius: 5px !important;
                    max-width: 1080px;
                    max-height: 720px;
                }

                .game-fscreen {
                    margin: 0px auto;
                    position: absolute;
                    width: calc(100vw - 250px);
                    max-width: 100vw;
                    right: 0;
                    top: 86px;
                }

                footer,
                .copyright {
                    display: none !important;
                }

                @media screen and (max-width: 720px) {
                        iframe {
                        top: 0;
                        bottom:0;
                        width: 100%;
                        height: -webkit-fill-available;
                        min-height: -webkit-fill-available;
                        max-height: -webkit-fill-available;
                        padding: 0 !important;
                        border-radius: 0px;
                        max-width: 100% !important;
                        max-height: 100% !important;
                    }

                    .game-fscreen {
                        margin: 0px auto;
                        width: 100% !important;
                        max-width: 100vw;
                        right: 0;
                        top: 0 !important;
                    }

                    nav,
                    footer,
                    .copyright {
                        display: none !important;
                    }
                }

                .top-games-count {
                    opacity: 1 !important;
                    width: 30px;
                    height: 30px;
                    background: #ffffff2b;
                    border-radius: 5px;
                    text-align: center;
                }


                .loading::before {
                    display: none;
                }



            </style>
            <div class="mx-auto lg:px-8 lg:py-0 lg:pl-0">

                    <div class="w-full">
                        <div id="divJsError" style="display: none" class="alert alert-error ml-auto mr-auto ">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                     fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span></span>
                            </div>
                        </div>

                        <div class="w-full">
                            <div id="gameLoader" style="height: 70vh; align-items: center; display: flex;">
                                <div class="w-full mx-auto">
                                    <div class="loading ml-auto mr-auto mb-4 mt-12 w-[100px]"></div>
                                </div>
                            </div>

                            <div class="flex">
                              <div class="flex-grow">
                                {{--<iframe class="previewContent" id="gameIframe" src="" width="100%" style="margin: 0 auto; display: none" frameborder="0"></iframe>--}}
                                <iframe class="game-fscreen" id="gameIframe" src="" width="100%" style="margin: 0 auto; display: none" frameborder="0"></iframe>
                              </div>
                            </div>

                        </div>
                    </div>

            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                var ajaxUrl = "<?= $ajax_url ?>";
                $.get(ajaxUrl, function (data) {
                    var url = data.data.url;
                    $("#gameIframe").attr("src", url);
                    const iframe = document.getElementById("gameIframe");
                    iframe.addEventListener("load", function () {
                        setTimeout(function () {
                            $("#gameIframe").show();
                            $("#gameLoader").hide();
                        },3000);

                    });
                }).fail(function () {
                    $("#divJsError span").html("Ocorreu um erro desconhecido. Redirecionando...");
                    $("#divJsError").show();
                    setTimeout(function () {
                        location.href = "{{url('/games')}}", 5000
                    });
                });
            });
        </script>

        <script type="text/javascript">// First we get the viewport height and we multiple it by 1% to get a value for a vh unit
let vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);</script>

    @endpush
</x-app-layout>