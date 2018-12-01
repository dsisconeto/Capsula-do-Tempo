{extends file="../template.tpl"}

{block name="css"}
    <link href="/css/page/event/event-search.css" rel="stylesheet">
    <link href="/css/page/event/event-all.css" rel="stylesheet">
{/block}


{block name="content"}

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="tag-section text-center"> Pesquisar Eventos
                    /{if isset($geoRegionId)}{$selectGeoRegionName}{else}Todos{/if}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form role="form" class="search" method="get" action="/eventos/pesquisar/">
                    {if isset($geoRegionId)}
                        <input type="hidden" name="region" value="{$geoRegionId}">
                    {/if}
                    <input type="text" class="form-control  margin-bottom-20"
                           placeholder="Pesquisar Eventos por nome ou categoria..."
                           style="width: 85%;border-radius: 20px 0 0 20px; float: left;" value="{$arg}" name="arg"
                           autocomplete="off" required="required" minlength="1">
                    <button class="btn btn-primary form-control margin-bottom-20"
                            style="width: 15%;    border-radius: 0 20px 20px 0px; float: left;">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>

                </form>
            </div>
        </div>

        {if $eventSearch}
            <div class="row">
                {foreach from=$eventSearch item=key}
                    <div class="col-md-3 col-sm-4">
                        <a href="/{$key.system_url_url}" class="card-event">
                            <img src="/img/event_cover/xs/{$key.event_cover}"
                                 class="img-responsive">
                            <div class="card-event-text">
                                {$key.event_name}
                            </div>
                        </a>
                    </div>
                {/foreach}

            </div>
        {else}
            <div class="row">

                <div class="col-md-12">

                    <div class="loading">
                        Ops, não encontramos eventos para "{$arg}" :(
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
                                <a href="/eventos/pesquisar/{$i}/?arg={$arg}{if isset($geoRegionId)}&region={$geoRegionId}{/if}">{$i}</a>
                            </li>
                        {/if}

                    {/for}
                </ul>
            </nav>
        {/if}
    </div>
{/block}


