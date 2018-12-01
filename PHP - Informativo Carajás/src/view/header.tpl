<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$metaTitle}</title>
    <meta name="theme-color" content="‪#‎2780e3">
    <meta name="description" content="{$metaDescription}">
    <meta name="keywords" content="{$metaKeywords}">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:site_name" content="Infomativo Cidade">
    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="258509954511790"/>
    <meta property="og:url" content="{if isset($metaUrl)}{$metaUrl}{/if}">
    <meta property="og:title" content="{$metaTitle|replace:'"':"'"}">
    <meta property="og:description" content="{$metaDescription}">
    <script type="text/javascript">
        (function (p, u, s, h) {
            p._pcq = p._pcq || [];
            p._pcq.push(['_currentTime', Date.now()]);
            s = u.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = 'https://cdn.pushcrew.com/js/e237b84f6886bef0422dbe49aec36ab8.js';
            h = u.getElementsByTagName('script')[0];
            h.parentNode.insertBefore(s, h);
        })(window, document);
    </script>

    {if isset($metaImage)}
        <meta property="og:image" content="{$metaImage}">
    {/if}
    <script>
        const isMobile = {if $isMobile }1{else}0{/if};
        const metaUrl = "{$metaUrl}";
    </script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="icon" href="{asset("/img/favicon.ico")}">
    <link rel="stylesheet" href="{asset("vendor/bootstrap/css/bootstrap.min.css")}">
    <link rel="stylesheet" href="{asset("vendor/font-awesome-4.6.2/css/font-awesome.min.css")}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="{asset("css/system.css")}" rel="stylesheet">
    <link href="{asset("css/theme.css")}" rel="stylesheet">

    <script src="{asset("vendor/jquery/jquery-2.2.2.min.js")}"></script>
    <script src="{asset("vendor/bootstrap/js/bootstrap.min.js")}"></script>
    <script src="{asset("vendor/balupton-jquery/lib/jquery-scrollto.js")}"></script>
    <script src="{asset("js/system.js")}"></script>
    <script src="{asset("js/obj/Megaic.js")}"></script>

    {if isset($newsSingle)}
        <link href="{asset("/css/page/news/news-single.css")}" rel="stylesheet">
        <script src="{asset("/js/page/news/news-single.js")}"></script>
    {/if}


</head>
<body>
{if !isset($selectRegion)}
    {$selectRegion = false}
{/if}


{if isset($viewLoad)}
    <div class="loading-page" id="loading-page" style="display: block">
        <img src="{asset("/img/loading.gif")}" class="img-responsive" id="loading-page-icon"
             onload=" Megaic.html.centralize('#loading-page-icon')">
    </div>
{/if}


<header>
    <nav class="navbar navbar-default navbar-fixed-top" style="z-index: 999" id="menubar">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo-top" href="https://informativocarajas.com/">
                    <img alt="Logotipo de Informativo Carajás" src="{asset("/img/icon.png")}" class="img-responsive">
                </a>

                {*<a class="navbar-brand logo-postivo-brad"*}
                {*target="_blank"*}
                {*href="https://www.radios.com.br/aovivo/radio-rede-positiva-1001-fm/40700">*}

                {*<img src="{asset("img/logo_positivo.png")}" class="img-responsive logo-postivo">*}

                {*</a>*}

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav nav">
                    {if !$selectRegion}

                        <li>
                        <a href="/noticias/">Notícias</a>
                        {if $systemEventView}
                            <li><a href="/eventos/"> Eventos</a></li>
                        {/if}

                        {if $systemCompanyView}
                            <li>
                                <a href="/empresas/"> Empresas</a>
                            </li>
                        {/if}

                        {if $systemNewspaperView}
                            <li>
                                <a href="/impresso/">Jornal Impresso</a>
                            </li>
                        {/if}
                        <li>
                            <a href="/cidade/selecionar/"> Trocar de Cidade</a>
                        </li>
                    {else}
                        <li>
                            <a href="#"> {$metaTitle}</a>
                        </li>
                    {/if}
                </ul>
                {*<a target="_blank" href="https://www.radios.com.br/aovivo/radio-rede-positiva-1001-fm/40700"*}
                {*class="nav navbar-right navbar-logo-positivo">*}

                {*<img src="{asset("img/logo_positivo.png")}" class="img-responsive logo-postivo">*}

                {*</a>*}


            </div>
            <!-- /.navbar-collapse -->


        </div><!-- /.container-fluid -->
    </nav>
</header>


<div class="space-top" id="space-top"></div>
{if !$selectRegion}
    {if !isset($hideAdsTop)}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ads">
                        <div class="ads">
                            <script src="/services/anuncio/4/js/6789876/?url=https://informativocarajas.com/"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {/if}
    <div class="back-top" id="back-top">
        <i class="fa fa-angle-up" aria-hidden="true"></i> voltar ao topo
    </div>
{/if}

