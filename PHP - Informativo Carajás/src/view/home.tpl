{include "header.tpl"}
{if $selectRegion}

    {include "selectRegion.tpl"}

{else}
    <link rel="stylesheet" href="{asset("/vendor/animate-css/css.css")}">
    <link href="{asset("/vendor/jquery.bxslider/jquery.bxslider.css")}" rel="stylesheet">
    <link rel="stylesheet" href="{asset("/css/page/event/event-all.css")}">
    <link href="{asset("/css/page/company/company-all.css")}" rel="stylesheet">
    <link href="{asset("/css/page/news/news-all.css")}" rel="stylesheet">
    <link href="{asset("/css/page/home.css")}" rel="stylesheet">
    <link href="{asset("/css/news.css")}" rel="stylesheet">
    {include "news/manchete.tpl"}
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-12">
                <a href="{host("/noticias/")}"
                   class="btn btn-danger view_more_btn ">
                    Veja Mais Notícias...
                </a>
            </div>
        </div>
    </div>
    {if $systemEventView}
        <div class="eventos" id="home_eventos">
            <div class="header-tag margin-bot">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            Eventos
                        </div>
                    </div>
                </div>
            </div>

            {include "event/roof.tpl"}
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-sm-12">
                        <a href="/eventos/"
                           class="btn btn-danger view_more_btn ">
                            Veja Mais Eventos...
                        </a>
                    </div>
                </div>
            </div>

        </div>
    {/if}
    {if $systemCompanyView}
        <div id="home_company">
            <div class="header-tag margin-bot">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            Empresas
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">

                {include "company/searchForm.tpl"}
                {include "company/featured.tpl"}


                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-sm-12">
                        <a href="/empresas/"
                           class="btn btn-danger view_more_btn ">
                            Veja Mais Empresas...
                        </a>
                    </div>
                </div>
            </div>
        </div>
    {/if}
    <script src="/vendor/animate-css/js.js"></script>
    <script src="/vendor/jquery.bxslider/jquery.bxslider.min.js"></script>
    <script src="/js/page/news/manchete.js"></script>
    <script src="/js/page/home.js"></script>
{/if}