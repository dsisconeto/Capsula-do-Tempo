<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form role="form" class="search" method="get" action="/eventos/pesquisar/">

                <input type="text" class="form-control  margin-bottom-20"
                       placeholder="Pesquisar Eventos por nome ou categoria..."
                       style="width: 85%;border-radius: 20px 0 0 20px; float: left;" value="" name="arg"
                       autocomplete="off" required="required">

                <button class="btn btn-primary form-control margin-bottom-20"
                        style="width: 15%;    border-radius: 0 20px 20px 0; float: left;">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>


            </form>
        </div>
    </div>

    <div id="events">
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
                    <div class="tag-section tag-section-event">
                        Eventos da Semana
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="ads">
                        <script src="/services/anuncio/2/js/{$countAds++}/?url={$metaUrl}"></script>
                    </div>
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
        {if $eventRoof}
            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-event">
                        Eventos com Cobertura de Fotos
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="ads">
                        <script src="/services/anuncio/2/js/{$countAds++}/?url={$metaUrl}"></script>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            {foreach from=$eventRoof item=key}
                                {if $eventRoofCountSlide <= 3}
                                    <li data-target="#carousel-example-generic"
                                        {if $eventRoofCountSlide == 0}class="active"{/if}
                                        data-slide-to="{$eventRoofCountSlide++}"></li>
                                {/if}
                            {/foreach}

                        </ol>

                        <!-- Wrapper for slides {$eventRoofCountSlide = 0} -->
                        <div class="carousel-inner" role="listbox">
                            {foreach from=$eventRoof item=key}
                                {if $eventRoofCountSlide <= 3 }
                                    <div class="item {if  $eventRoofCountSlide == 0}active{/if}">
                                        <a href="/{$key.system_url_url}" class="box-event">
                                            <img src="/img/hahahaieie.png" class="img-responsive"
                                                 style="background: url('/img/event_gallery/md/{$key.event_roof_cover}'); background-position: center; background-size: cover">
                                            <div class="box-event-text">
                                                <p>
                                                    <span class="tag-text tag-text-{$key.event_category_color}">{$key.event_category_name}</span><br>
                                                    {$key.event_name} -
                                                    <small>{$key.geo_region_name}</small>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <!--  {$eventRoofCountSlide++}-->
                                {/if}
                            {/foreach}

                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" role="button"
                           data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" role="button"
                           data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>


                </div>

                <div class="col-md-3">
                    <!-- {$eventRoofCountSlide = 0} -->
                    {foreach from=$eventRoof item=key}
                        <!-- {$eventRoofCountSlide++} -->
                        {if $eventRoofCountSlide >= 5 && $eventRoofCountSlide <= 6}
                            <a href="/{$key.system_url_url}" class="box-event margin-bottom-20">
                                <img src="/img/hahahaieie.png" class="img-responsive"
                                     style="background: url('/img/event_gallery/xs/{$key.event_roof_cover}'); background-position: center; background-size: cover">'
                                <div class="box-event-text">
                                    <p>
                                        <span class="tag-text tag-text-{$key.event_category_color}">{$key.event_category_name}</span><br>
                                        {$key.event_name} -
                                        <small>{$key.geo_region_name}</small>
                                    </p>
                                </div>
                            </a>
                        {/if}
                    {/foreach}
                </div>

                <div class="col-md-3">
                    <!-- {$eventRoofCountSlide = 0} -->
                    {foreach from=$eventRoof item=key}
                        <!-- {$eventRoofCountSlide++} -->
                        {if $eventRoofCountSlide >= 7 && $eventRoofCountSlide <= 8}
                            <a href="/{$key.system_url_url}" class="box-event margin-bottom-20">
                                <img src="/img/hahahaieie.png" class="img-responsive"
                                     style="background: url('/img/event_gallery/xs/{$key.event_roof_cover}'); background-position: center; background-size: cover">'
                                <div class="box-event-text">
                                    <p>
                                        <span class="tag-text tag-text-{$key.event_category_color}">{$key.event_category_name}</span><br>
                                        {$key.event_name} -
                                        <small>{$key.geo_region_name}</small>
                                    </p>
                                </div>
                            </a>
                        {/if}
                    {/foreach}
                </div>


            </div>
            <div class="row">
                <!-- {$eventRoofCountSlide = 0} -->
                {foreach from=$eventRoof item=key}
                    <!-- {$eventRoofCountSlide++} -->
                    {if $eventRoofCountSlide >= 9 && $eventRoofCountSlide <= 16}
                        <div class="col-md-3">
                            <a href="/{$key.system_url_url}" class="box-event margin-bottom-20">
                                <img src="/img/hahahaieie.png" class="img-responsive"
                                     style="background: url('/img/event_gallery/xs/{$key.event_roof_cover}'); background-position: center; background-size: cover">'
                                <div class="box-event-text">
                                    <p>
                                        <span class="tag-text tag-text-{$key.event_category_color}">{$key.event_category_name}</span><br>
                                        {$key.event_name} -
                                        <small>{$key.geo_region_name}</small>
                                    </p>
                                </div>
                            </a>
                        </div>
                    {/if}
                {/foreach}


            </div>
        {/if}


        {if $eventNext}
            <div class="row">
                <div class="col-md-12">
                    <div class="tag-section tag-section-event">
                        Próximos Eventos
                    </div>
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

    </div>
</div>