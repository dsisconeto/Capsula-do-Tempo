{extends file="../template.tpl"}

{block name="css"}
    <link href="/css/page/company/company-search.css" rel="stylesheet">
    <link href="/css/page/company/company-all.css" rel="stylesheet">
{/block}

{block name="javascript"}
    <script src="/js/page/company/company-search.js"></script>
{/block}

{block name="content"}
    <div class="container">
        {include "searchForm.tpl"}

        {if $resCompany}
            <div class="row">

                {foreach from=$resCompany item=$key}
                    <div class="col-md-3 col-sm-6">
                        <a href="/{$key.system_url_url}"
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
                            </div>

                        </a>
                    </div>
                {/foreach}
            </div>
        {else}
            <div class="row">
                <div class="col-md-12">
                    <div class="box-result">
                        Não encontramos resultados para sua busca "{$arg}" :(
                    </div>
                </div>
            </div>
        {/if}


        {if $numberPage}
            <nav aria-label="Page navigation ">

                <ul class="pagination center-block">
                    {for $i=1 to $numberPage}
                        {if $page == $i}
                            <li class="active">
                                <a class="active">{$i}</a>
                            </li>
                        {else}
                            <li>
                                <a href="/empresas/pesquisar/{$i}/?arg={$arg}{if isset($geoRegionId)}&region={$geoRegionId}{/if}">{$i}</a>
                            </li>
                        {/if}

                    {/for}
                </ul>
            </nav>
        {/if}
    </div>
{/block}
