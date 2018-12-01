{include "../header.tpl"}
{if $selectRegion}

    {include "../selectRegion.tpl"}

{else}
    <link href="/css/page/company/company-search.css" rel="stylesheet">
    <link href="/css/page/company/company-all.css" rel="stylesheet">
    <div class="container">
        {include "searchForm.tpl"}

        {if $resCompany}
            <div class="row">

                {foreach from=$resCompany item=$key}
                    <div class="col-md-3 col-sm-6">
                        <a href="{$getHost}{$key.system_url_url}"
                           class="company-box {if $key.company_nivel == 1}company-box-2 {/if}">

                            {if $key.company_nivel > 1}
                                <div class="company-box-img">
                                    <img src="/img/company_logo/md/{$key.company_logo}"
                                         class="img-responsive center-block">
                                </div>
                            {/if}
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
        {else}
            <div class="row">
                <div class="col-md-12">
                    <div class="box-result">
                        Não encontramos resultados para sua busca "{$search}" :(
                    </div>
                </div>
            </div>
        {/if}
    </div>
    <script src="/js/page/company/company-search.js"></script>
{/if}