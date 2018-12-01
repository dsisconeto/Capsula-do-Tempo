{extends file="../template.tpl"}


{block name="css"}
    <link href="/css/page/company/company-all.css" rel="stylesheet">
{/block}

{block name="javascript"}
    <script src="/js/page/company/company-search.js"></script>
{/block}

{block name="content"}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="tag-section text-center">
                Empresas em Destaque
            </div>
        </div>
    </div>

    {include "searchForm.tpl"}

    {include "featured.tpl"}


    {if $bares}
        <div class="row">
            <div class="col-md-12">
                <div class="tag-section">
                    Alimentação
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
                <div class="tag-section">
                    Hospedagem
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
                <div class="tag-section">
                    Diversão
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
                <div class="tag-section">
                    Imobiliaria
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
                <div class="tag-section">
                    Farmácias e Drograrias
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
            <div class="tag-section">
                Supermercados
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
                <div class="tag-section">
                    Roupas e Calçados
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
        {/block}


