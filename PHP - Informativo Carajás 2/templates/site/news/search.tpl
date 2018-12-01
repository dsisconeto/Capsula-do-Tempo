{extends file="../template.tpl"}

{block name="css"}
    <link href="/css/news.css" rel="stylesheet">
{/block}

{block name="javascript"}

{/block}

{block name="content"}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tag-section text-center">
                    Pesquisar Notícias
                    / {if isset($geoRegionId)}{$selectGeoRegionName}{else}Todas{/if}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form role="form" class="search" method="get">
                    {if isset($geoRegionId)}
                        <input type="hidden" name="region" value="{$geoRegionId}">
                    {/if}
                    <input type="text" class="form-control  margin-bottom-20"
                           placeholder="Pesquisar Notícias por título ou categoria..."
                           style="width: 85%;border-radius: 20px 0 0 20px; float: left;" value="{$arg}" name="arg"
                           autocomplete="off" required="required" minlength="1">
                    <button class="btn btn-primary form-control margin-bottom-20"
                            style="width: 15%;    border-radius: 0 20px 20px 0px; float: left;">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>

                </form>
            </div>
        </div>
        {if $result}
            <div class="row">
                {foreach from=$result item=key}
                    <div class="col-md-4">
                        <div class="card card-4">
                            <a href="/{$key.system_url_url}">
                                <img src="/img/news_cover/sm/{$key.news_cover}"
                                     class="img-responsive">
                                <div class="card-block">
                                    <div class="card-content">
                                        <div class="card-title">
                                            {$key.news_title}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                {/foreach}
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

                                <a href="/noticias/pesquisar/{$i}/?arg={$arg}{if isset($geoRegionId)}&regiao={$geoRegionId}{/if}">{$i}</a>
                            </li>
                        {/if}

                    {/for}
                </ul>
            </nav>
        {/if}
    </div>
{/block}