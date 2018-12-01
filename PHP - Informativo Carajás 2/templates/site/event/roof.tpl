<div class="container " id="events">


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form role="form" class="search" method="get" action="/eventos/pesquisar/">
                <input type="text" class="form-control  margin-bottom-20"
                       placeholder="Pesquisar Eventos por nome ou categoria..."
                       style="width: 85%;border-radius: 20px 0 0 20px; float: left;" value="" name="arg"
                       autocomplete="off" required="required">
                <input type="hidden" value="{$geoRegionId}" name="region">
                <button class="btn btn-primary form-control margin-bottom-20"
                        style="width: 15%;    border-radius: 0 20px 20px 0; float: left;">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
    </div>


    {if $eventDay}
        <div class="row">
            <div class="col-md-12">
                <div class="tag-section tag-section-event">
                    Eventos de Hoje
                </div>
            </div>
        </div>
        <div class="row">
            {foreach from=$eventDay item=key}
                <div class="col-md-3 col-sm-4">
                    <a href="/{$key.system_url_url}" class="card-event">
                        <img src="/img/event_cover/xs/{$key.event_cover}"
                             class="img-responsive">
                        <div class="card-event-text">
                            {$key.event_name} <br>
                            <small>{$key.geo_region_name}</small>
                        </div>
                    </a>
                </div>
            {/foreach}
        </div>
    {/if}


    {if $eventWeek}
        <div class="row">
            <div class="col-md-12">
                <div class="tag-section text-center"> Eventos da Semana</div>
            </div>
        </div>
        <div class="row">
            {foreach from=$eventWeek item=key}
                <div class="col-md-3 col-sm-4">
                    <a href="/{$key.system_url_url}" class="card-event">
                        <img src="/img/event_cover/xs/{$key.event_cover}"
                             class="img-responsive">
                        <div class="card-event-text">
                            {$key.event_name} <br>
                            <small>{$key.geo_region_name}</small>
                        </div>
                    </a>
                </div>
            {/foreach}
        </div>
    {/if}


    {if $eventNext}
        <div class="row">
            <div class="col-md-12">
                <div class="tag-section text-center"> Próximos Eventos</div>
            </div>
        </div>
        <div class="row">
            {foreach from=$eventNext item=key}
                <div class="col-md-3 col-sm-4">
                    <a href="/{$key.system_url_url}" class="card-event">
                        <img src="/img/event_cover/xs/{$key.event_cover}"
                             class="img-responsive">
                        <div class="card-event-text">
                            {$key.event_name} <br>
                            <small>{$key.geo_region_name}</small>
                        </div>
                    </a>
                </div>
            {/foreach}
        </div>
    {/if}
    <div class="row">
        <div class="col-md-12">
            <div class="tag-section text-center"> Eventos com Fotos</div>
        </div>
    </div>

    {if $eventRoof}
        <div class="row">
            {foreach from=$eventRoof item=key}
                <div class="col-md-4 ">
                    <div class="card card-4">
                        <a href="/{$key.system_url_url}">
                            <img src="/img/event_gallery/lg/85f21ae6a4889ff53a5956821dc28257.jpg"
                                 class="img-responsive">
                            <div class="card-block">
                                <div class="card-content">
                                    <div class="card-title">
                                        {$key.event_name}<br>
                                        <small>{$key.geo_region_name}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            {/foreach}
        </div>
    {/if}


    <div class="row">
        <div class=" col-sm-12">
            <a href="/eventos/pesquisar/?region={$geoRegionId}"
               class="btn btn-danger view_more_btn ">
                Eventos Antigos ...
            </a>
        </div>
    </div>


</div>



