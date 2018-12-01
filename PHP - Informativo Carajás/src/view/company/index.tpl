{include "../header.tpl"}


{if $selectRegion}

    {include "../selectRegion.tpl"}

{else}
    <link href="/css/page/company/company-all.css" rel="stylesheet">
    <div class="container">


        {include "searchForm.tpl"}
        {include "featured.tpl"}






        {if $bares}
            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-company">
                        <a href="/empresas/pesquisar/?arg=Alimentação">
                            <img src="/img/company-segment-01.png"
                                 class="segment-icon-bar img-responsive center-block">

                            <p class="text-center">
                                Alimentação
                            </p>
                        </a>

                    </div>


                </div>
            </div>
            <div class="row">
                {foreach from=$bares item=$key}
                    <div class="col-md-3 col-sm-6">
                        <a href="/{$key.system_url_url}"
                           class="company-box">

                            <div class="company-box-img">
                                <img src="/img/company_logo/sm/{$key.company_logo}"
                                     class="img-responsive center-block">
                            </div>

                            <div class="company-box-text">
                                <div class="company-box-title">
                                    {$key.company_fantasy_name}
                                </div>
                                <p>
                                    {$key.company_address}
                                </p>
                                <p>
                                    {$key.company_phone}
                                </p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/if}


        {if $hoteis}
            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-company">
                        <a href="/empresas/pesquisar/?arg=Hospedagem">
                            <img src="/img/company-segment-02.png"
                                 class="segment-icon-bar img-responsive center-block">

                            <p class="text-center">
                                Hospedagem
                            </p>
                        </a>

                    </div>
                </div>
            </div>
            <div class="row">
                {foreach from=$hoteis item=$key}
                    <div class="col-md-3 col-sm-6">
                        <a href="/{$key.system_url_url}"
                           class="company-box">

                            <div class="company-box-img">
                                <img src="/img/company_logo/sm/{$key.company_logo}"
                                     class="img-responsive center-block">
                            </div>

                            <div class="company-box-text">
                                <div class="company-box-title">
                                    {$key.company_fantasy_name}
                                </div>
                                <p>
                                    {$key.company_address}
                                </p>
                                <p>
                                    {$key.company_phone}
                                </p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/if}


        {if $clubes}
            <div class="row">
                <div class="col-md-12">

                    <div class="tag-section tag-section-company">
                        <a href="/empresas/pesquisar/?arg=Diversão">
                            <img src="/img/company-segment-04.png"
                                 class="segment-icon-bar img-responsive center-block">
                            <p class="text-center">
                                Diversão
                            </p>
                        </a>

                    </div>

                </div>
            </div>
            <div class="row">
                {foreach from=$clubes item=$key}
                    <div class="col-md-3 col-sm-6">
                        <a href="/{$key.system_url_url}"
                           class="company-box">

                            <div class="company-box-img">
                                <img src="/img/company_logo/sm/{$key.company_logo}"
                                     class="img-responsive center-block">
                            </div>

                            <div class="company-box-text">
                                <div class="company-box-title">
                                    {$key.company_fantasy_name}
                                </div>
                                <p>
                                    {$key.company_address}
                                </p>
                                <p>
                                    {$key.company_phone}
                                </p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/if}


        {if $imobili}
            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-company">
                        <a href="/empresas/pesquisar/?arg=Imobiliaria">
                            <img src="/img/company-segment-05.png"
                                 class="segment-icon-bar img-responsive center-block">
                            <p class="text-center">
                                Imobiliaria
                            </p>
                        </a>

                    </div>

                </div>
            </div>
            <div class="row">
                {foreach from=$imobili item=$key}
                    <div class="col-md-3 col-sm-6">
                        <a href="/{$key.system_url_url}"
                           class="company-box">

                            <div class="company-box-img">
                                <img src="/img/company_logo/sm/{$key.company_logo}"
                                     class="img-responsive center-block">
                            </div>

                            <div class="company-box-text">
                                <div class="company-box-title">
                                    {$key.company_fantasy_name}
                                </div>
                                <p>
                                    {$key.company_address}
                                </p>
                                <p>
                                    {$key.company_phone}
                                </p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/if}


        {if $farmacia}
            <div class="row">
                <div class="col-md-12">

                    <div class="tag-section tag-section-company">

                        <a href="/empresas/pesquisar/?arg=Farmácias+e+Drograrias">
                            <img src="/img/company-segment-06.png"
                                 class="segment-icon-bar img-responsive center-block">
                            <p class="text-center">
                                Farmácias e Drograrias
                            </p>
                        </a>

                    </div>

                </div>
            </div>
            <div class="row">
                {foreach from=$farmacia item=$key}
                    <div class="col-md-3 col-sm-6">
                        <a href="/{$key.system_url_url}"
                           class="company-box">

                            <div class="company-box-img">
                                <img src="/img/company_logo/sm/{$key.company_logo}"
                                     class="img-responsive center-block">
                            </div>

                            <div class="company-box-text">
                                <div class="company-box-title">
                                    {$key.company_fantasy_name}
                                </div>
                                <p>
                                    {$key.company_address}
                                </p>
                                <p>
                                    {$key.company_phone}
                                </p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/if}


        {if $super}
            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-company">

                        <a href="/empresas/pesquisar/?arg=Supermercados">
                            <img src="/img/company-segment-07.png"
                                 class="segment-icon-bar img-responsive center-block">
                            <p class="text-center">
                                Supermercados
                            </p>
                        </a>

                    </div>

                </div>
            </div>
            <div class="row">
                {foreach from=$super item=$key}
                    <div class="col-md-3 col-sm-6">
                        <a href="/{$key.system_url_url}"
                           class="company-box">
                            <div class="company-box-img">
                                <img src="/img/company_logo/sm/{$key.company_logo}"
                                     class="img-responsive center-block">
                            </div>

                            <div class="company-box-text">
                                <div class="company-box-title">
                                    {$key.company_fantasy_name}
                                </div>
                                <p>
                                    {$key.company_address}
                                </p>
                                <p>
                                    {$key.company_phone}
                                </p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/if}


        {if $versture}
            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-company">

                        <a href="/empresas/pesquisar/?arg=Roupas+e+Calçados">
                            <img src="/img/company-segment-03.png"
                                 class="segment-icon-bar img-responsive center-block">
                            <p class="text-center">
                                Roupas e Calçados
                            </p>
                        </a>

                    </div>
                </div>
            </div>
            <div class="row">
                {foreach from=$versture item=$key}
                    <div class="col-md-3 col-sm-6">
                        <a href="/{$key.system_url_url}"
                           class="company-box">

                            <div class="company-box-img">
                                <img src="/img/company_logo/sm/{$key.company_logo}"
                                     class="img-responsive center-block">
                            </div>

                            <div class="company-box-text">
                                <div class="company-box-title">
                                    {$key.company_fantasy_name}
                                </div>
                                <p>
                                    {$key.company_address}
                                </p>
                                <p>
                                    {$key.company_phone}
                                </p>
                            </div>
                        </a>
                    </div>
                {/foreach}
            </div>
        {/if}
    </div>
    <script src="/js/page/company/company-search.js"></script>
{/if}