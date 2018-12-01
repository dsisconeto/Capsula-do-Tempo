<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='Local Market' name='author'>
    <meta content='Local Market - O Marketplace Inteligente' name='description'>
    <meta content='Local Market' property='og:site_name'>
    <meta content='http://www.localmarket.com.br/' property='og:url'>

    <title>Local Market - O Marketplace Inteligente</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/img/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/Proxima Nova/fonts.min.css" />
    <link rel="stylesheet" href="/assets/vendor/lightSlider/dist/css/lightslider.min.css">
    <link rel="stylesheet" href="/assets/vendor/lightGallery/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/card.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.reboot.css">
    <link rel="stylesheet" href="/assets/css/switcher.css">
</head>

<body>

<header class="main-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col text-left">
                <a id="lateral-menu-btn" class="lateral-menu-btn d-block d-lg-none"><i class="fas fa-bars"></i></a>
            </div>
            <div class="col text-center">
                <a href="/"><img class="logo-icon animated bounceInDown" src="/assets/img/logo-icon.svg" alt="Logo - Local Market"></a>
            </div>
            <div class="col text-right">
                <a href="#" class="lateral-menu-btn mr-3"><i class="fas fa-shopping-cart"></i></a>
                <a href="#" class="lateral-menu-btn"><i class="fas fa-user"></i></a>
            </div>
        </div>
        <form action="#">
            <div class="row align-items-center text-center">
                <div class="col search-panel">
                    <div class="input-group input-group-responsive mt-2">
                        <div class="input-group-append">
                            <button class="btn btn-location d-block d-lg-none" id="location-btn" type="button"><i class="fas fa-map-marker-alt"></i></button>
                        </div>
                        <input id="search" name="search" autocomplete="off" class="form-control search-field" placeholder="O que você quer hoje?">
                        <div class="input-group-append">
                            <div class="select-location-group d-none d-lg-block">
                                <div class="select-location">
                                    <a id="user-location-loading" style="opacity: 0"><strong>...</strong></a>
                                    <a id="user-location" onclick="getLocation()">Palmas, TO&nbsp;<strong>Brasil</strong></a>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-search" type="button"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</header>

@yield('content')

<footer>
    <div class="primary-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5><i class="far fa-lightbulb fa-2x"></i>Receba as melhores ofertas!</h5>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input class="form-control" placeholder="Seu email aqui :)">
                        <div class="input-group-append">
                            <button class="btn btn-secondary"><i class="fas fa-envelope"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="secondary-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-sm-left text-center">
                    <span>Todos os direitos reservados</span>
                </div>
                <div class="col-md-4 text-center">
                    <strong>2018 &copy; Local Market</strong>
                </div>
                <div class="col-md-4 text-sm-right text-center">
                    <ul class="social-icons">
                        <li><a href="www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="www.youtube.com" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="switcher-wrapper">
    <div class="demo-changer">
        <div class="demo-icon"><i class="fas fa-cog fa-2x"></i></div>
        <div class="form_holder">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="predefined_styles">
                        <div class="skin-theme-switcher">
                            <h4>Cor</h4>
                            <a href="#" data-switchcolor="color1" class="styleswitch" style="background-color:#E6E6E6;"> </a>
                            <a href="#" data-switchcolor="color2" class="styleswitch" style="background-color:#E43A2C;"> </a>
                            <a onclick="loadingScreen()" style="background:none;border:none" class="styleswitch"><i class="fas fa-spinner fa-spin"
                                                                                                                    style="color:black!important;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="#0" class="back-top">Topo</a>
<script src="/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="/assets/vendor/popper/popper.min.js"></script>
<script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/vendor/lightSlider/dist/js/lightslider.min.js"></script>
<script src="/assets/js/switcher.js"></script>
<script src="./assets/js/google-map.js"></script>
<script>
    // Carregamento
    function loadingScreen() {
        // $("body").toggleClass("disable-scroll");
        $("#wrapper").toggleClass("loading");
    }

    // Obtêm a localização
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        alert("Latitude: " + position.coords.latitude + "\nLongitude: " + position.coords.longitude);
        $("#user-location").fadeIn().html("<strong>Meu Local</strong>");
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }

    // Configura o aparecimento da barra de pesquisa
    var win = $(window),
        nav = $(".main-header"),
        logo = $(".logo-icon"),
        header = $(".main-header"),
        pos = nav.offset().top,
        sticky = function () {
            if (win.scrollTop() > pos) {
                nav.addClass("sticky");
                logo.addClass("hide-top")
                header.addClass("shrink-header")
            } else {
                nav.removeClass("sticky");
                logo.removeClass("hide-top")
                header.removeClass("shrink-header")
            }
        };
    win.scroll(sticky);

    // Botão mobile da barra de pesquisa
    $("#location-btn").click(function (e) {
        e.preventDefault();

        $(".select-location-group").toggleClass("d-none");
    });

    // Configura o menu de busca
    $('.search-field').keyup(function () {
        if (this.value.length < 4) {
            $('#search-results').fadeOut();
            return;
        }

        $('#search-results').fadeIn();
    });

    $(document).ready(function ($) {
        // requerimento de localizacao

        getLocation();

        // Configura o campo de busca
        $(".search-field").focus();

        // Configura o botão de Voltar ao Topo
        var offset = 300,
            offset_opacity = 1200,
            scroll_top_duration = 700,
            $back_to_top = $('.back-top');

        $(window).scroll(function () {
            ($(this).scrollTop() > offset) ? $back_to_top.addClass('back-is-visible') : $back_to_top.removeClass('back-is-visible back-fade-out');
            if ($(this).scrollTop() > offset_opacity) {
                $back_to_top.addClass('back-fade-out');
            }
        });

        $back_to_top.on('click', function (event) {
            event.preventDefault();
            $('body,html').animate({
                    scrollTop: 0,
                }, scroll_top_duration
            );
        });


        $(function () {
            generateGoogleMapImg('.googleMapImg');
        });

    });
</script>
</body>

</html>
