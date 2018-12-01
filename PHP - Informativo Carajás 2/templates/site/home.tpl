{extends file="template.tpl"}



{block name="javascript" prepend}
    <script src="/vendor/animate-css/js.js"></script>
    <script src="/js/obj/News.js"></script>
    <script src="/js/page/news/manchete.js"></script>
    <script src="/js/page/home.js"></script>
{/block}

{block name="css" prepend}
    <link href="/vendor/animate-css/css.css" rel="stylesheet">
    <link href="/vendor/jquery.bxslider/jquery.bxslider.css" rel="stylesheet">
    <link href="/css/page/event/event-all.css" rel="stylesheet">
    <link href="/css/page/company/company-all.css" rel="stylesheet">
    <link href="/css/page/news/news-all.css" rel="stylesheet">
    <link href="/css/page/home.css" rel="stylesheet">
    <link href="/css/news.css" rel="stylesheet">
{/block}


{block name="content" prepend}

    {include "news/manchete.tpl"}
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a href="/noticias/"
                   class="btn btn-danger view_more_btn ">
                    Veja Mais Notícias...
                </a>
            </div>
        </div>
    </div>
    {if $systemEventView}

        {include "event/roof.tpl"}


    {/if}
    {if $systemCompanyView}
        <div id="home_company">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tag-section text-center">
                            Empresas em Destaque
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form role="form" class="search" method="get" action="/empresas/pesquisar/">
                            {if isset($geoRegionId)}
                                <input type="hidden" value="{$geoRegionId}" name="region">
                            {/if}
                            <input type="text" class="form-control  margin-bottom-20"
                                   placeholder="Pesquisar Empresas por nome ou segmento..."
                                   style="width: 85%;border-radius: 20px 0 0 20px; float: left;"
                                   value="{if isset($arg)}{$arg}{/if}"
                                   name="arg"
                                   autocomplete="off">

                            <button class="btn btn-primary form-control margin-bottom-20"
                                    style="width: 15%;    border-radius: 0 20px 20px 0px; float: left;">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {if !$isMobile}
                    <div class="row margin-bottom-20 hidden-xs hidden-sm">

                        <div class="col-md-12">
                            <a href="/empresas/pesquisar/?arg=Alimentação{if isset($geoRegionId)}&region={$geoRegionId}{/if}"
                               class="segment-icon">
                                <img src="/img/company-segment-01.png" class="img-responsive center-block">
                                <p>Alimentação</p>
                            </a>

                            <a href="/empresas/pesquisar/?arg=Hospedagem{if isset($geoRegionId)}&region={$geoRegionId}{/if}"
                               class="segment-icon">
                                <img src="/img/company-segment-02.png" class="img-responsive center-block">
                                <p>Hospedagem</p>
                            </a>

                            <a href="/empresas/pesquisar/?arg=Diversão{if isset($geoRegionId)}&region={$geoRegionId}{/if}"
                               class="segment-icon">
                                <img src="/img/company-segment-04.png" class="img-responsive center-block">
                                <p>Diversão</p>
                            </a>

                            <a href="/empresas/pesquisar/?arg=Imobiliárias{if isset($geoRegionId)}&region={$geoRegionId}{/if}"
                               class="segment-icon">
                                <img src="/img/company-segment-05.png" class="img-responsive center-block">
                                <p>Imobiliárias</p>
                            </a>

                            <a href="/empresas/pesquisar/?arg=Farmácias+e+Drograrias{if isset($geoRegionId)}&region={$geoRegionId}{/if}"
                               class="segment-icon">
                                <img src="/img/company-segment-06.png" class="img-responsive center-block">
                                <p>Farmácias e <br> Drograrias</p>
                            </a>

                            <a href="/empresas/pesquisar/?arg=Supermercados{if isset($geoRegionId)}&region={$geoRegionId}{/if}"
                               class="segment-icon">
                                <img src="/img/company-segment-07.png" class="img-responsive center-block">
                                <p>Supermercados</p>
                            </a>


                            <a href="/empresas/pesquisar/?arg=Roupas+e+Calçados{if isset($geoRegionId)}&region={$geoRegionId}{/if}"
                               class="segment-icon">
                                <img src="/img/company-segment-03.png" class="img-responsive center-block">
                                <p>Roupas e <br> Calçados</p>
                            </a>

                        </div>
                    </div>
                {/if}
                {include "company/featured.tpl"}


                <div class="row">
                    <div class="col-md-12">
                        <a href="/empresas/"
                           class="btn btn-danger view_more_btn ">
                            Veja Mais Empresas...
                        </a>
                    </div>
                </div>
            </div>
        </div>
    {/if}

{/block}
