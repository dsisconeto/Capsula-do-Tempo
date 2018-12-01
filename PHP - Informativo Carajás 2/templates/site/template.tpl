<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$metaTitle}</title>
    <meta name="theme-color" content="‪#‎2780e3">
    <meta name="description" content="{$metaDescription}">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:site_name" content="Infomativo Cidade">
    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="258509954511790"/>
    <meta property="og:url" content="{if isset($metaUrl)}{$metaUrl}{/if}">
    <meta property="og:title" content="{$metaTitle|replace:'"':"'"}">
    <meta property="og:description" content="{$metaDescription}">
    {if isset($metaImage)}
        <meta property="og:image" content="{$metaImage}">
    {/if}

    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/507cb53259.js"></script>
    <link href="/vendor/select2/select2.min.css" rel="stylesheet">
    <link href="/css/theme.css" rel="stylesheet">
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
    <link rel="stylesheet" href="/vendor/animate-css/css.css">
    {block name="css"}{/block}


</head>
<body>


<header>
    <nav class="navbar navbar-default navbar-fixed-top" style="z-index: 999" id="menubar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo-top" href="https://informativocarajas.com/">
                    <img alt="Logotipo de Informativo Carajás" src="/img/icon.png" class="img-responsive">


                </a>

            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                {if $isMobile}
                    <form class="navbar-form navbar-right" id="form_region" action="/form/cidade/escolher/"
                          method="post">
                        <div class="form-group">
                            <select class="" name="geo_region_id" id="geo_region_id" required="required">
                                <option value="{$selectGeoRegionId}">{$selectGeoRegionName}</option>
                            </select>

                        </div>
                    </form>
                {/if}
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/noticias/">Notícias</a>
                    </li>
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


                </ul>
                {if !$isMobile}
                    <form class="navbar-form navbar-right" id="form_region" action="/form/cidade/escolher/"
                          method="post">
                        <div class="form-group">
                            <select class="" name="geo_region_id" id="geo_region_id" required="required">
                                <option value="{$selectGeoRegionId}">{$selectGeoRegionName}</option>
                            </select>

                        </div>
                    </form>
                {/if}
            </div>
        </div>
    </nav>
</header>


<div class="space-top" id="space-top"></div>

{if !isset($hideAdsTop)}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ads">
                    <script src="/services/anuncio/4/js/blabla/?url={$metaUrl}"></script>
                </div>
            </div>
        </div>
    </div>
{/if}
<div class="back-top" id="back-top">
    <i class="fa fa-angle-up" aria-hidden="true"></i> Voltar ao Topo
</div>


{block name="content"}{/block}


<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h3>Tudo</h3>
                <ul>
                    <li><a href="/noticias/pesquisar/">Todas Notícias</a></li>
                    <li><a href="/eventos/pesquisar/">Todos Eventos</a></li>
                    <li><a href="/empresas/pesquisar/">Todas Empresas</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h3>Redes Sociais</h3>
                <ul>
                    <li>
                        <a href="/noticias/pesquisar/">
                            <i class="fa fa-facebook-official" aria-hidden="true"></i>
                            Facebook</a>
                    </li>
                    <li>
                        <a href="/eventos/pesquisar/">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                            Twitter
                        </a>
                    </li>

                    <li>
                        <a href="/eventos/pesquisar/">
                            <i class="fa fa-youtube" aria-hidden="true"></i>
                            YouTube
                        </a>
                    </li>


                </ul>
            </div>

            <div class="col-md-3">
                <h3>Contato</h3>
                <ul>
                    <li>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        (xx) xxxx-xxxx
                    </li>
                    <li>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        contato@informativocarajas.com
                    </li>

                </ul>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="footer-copyright">
                    &copy; 2017 <a href="https://informativocarajas.com">Informativo Carajás</a> - Todos os Direitos
                    Reservados
                </p>
            </div>
        </div>
    </div>

</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="/vendor/balupton-jquery/lib/jquery-scrollto.js"></script>
<script src="/vendor/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
<script src="/vendor/jqueryform/jquery.form.min.js"></script>
<script src="/vendor/select2/select2.full.min.js"></script>
<script src="/js/obj/Site.js"></script>
<script src="/js/header.js"></script>

<script src="/js/obj/Megaic.js"></script>
<script src="/js/obj/News.js"></script>


<script>
    Site.IS_MOBILE = {if $isMobile }1{else}0{/if};
    Site.URL = "{$metaUrl}";
    {if isset($geoRegionId)}
    Site.GEO_REGION_ID = {$geoRegionId};
    {/if}

</script>

{block name="javascript"}

{/block}


</body>
</html>

