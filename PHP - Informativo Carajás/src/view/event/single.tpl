{include "../header.tpl"}

{if $selectRegion}

    {include "../selectRegion.tpl"}

{else}
    <link rel="stylesheet" href="/css/page/event/single.css">
    <link rel="stylesheet" href="/vendor/blueimp-gallery/css/blueimp-gallery.css">
    <script>
        const eventId = {$eventId};
    </script>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center text-uppercase">
                    {$eventName}
                </h1>

            </div>

            <div class="col-md-3 event-cover">
                <div id="poster">
                    <a href="/img/event_cover/lg/{$eventCover}">
                        <img src="/img/event_cover/sm/{$eventCover}" alt="Capa do Evento {$eventName}"
                             class="img-responsive">
                    </a>
                </div>

                <div class="event-description text-center">
                    <i class="fa fa-eye" aria-hidden="true"></i> {$eventCounterView}
                </div>
                <div class="event-description">
                    <div class="row">
                        <div class="{if $isMobile}col-md-6{else}col-md-12{/if}">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={$metaUrl}"
                               class="btn-shared btn-shared-facebook">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                                Compartilhar
                            </a>
                        </div>

                        {if $isMobile}
                            <div class="col-md-6">
                                <a href="whatsapp://send?text={$metaUrl}" class="btn-shared btn-shard-whats-app">
                                    <i class="fa fa-whatsapp" aria-hidden="true">
                                    </i> Compartilhar
                                </a>
                            </div>
                        {/if}

                    </div>
                </div>


                <div class="event-description">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    {if isset($eventAddressMaps)}
                        <a href="{$eventAddressMaps}"> {$eventLocal} - {$eventAddress}</a>
                    {else}
                        {$eventLocal} - {$eventAddress}
                        <br>
                        {$regionName}
                    {/if}
                </div>

                <div class="event-description">
                    <i class="fa fa-calendar" aria-hidden="true"></i> {$eventDate}
                </div>


                <div class="event-description">
                    {$eventDescription}
                </div>


            </div>

            {if $eventRoof == 1}
                <div id="event-roof">
                    <div class="col-md-9">
                        <img src="/img/CAMERAr.png" class="img-responsive center-block">
                        <h2 class="text-center">Este evento será fotografado pela equipe do Portal. <br>
                            <small>Em breve as fotos serão postadas...</small>
                        </h2>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div id="links">
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-md-offset-3">
                    <div class="loading-gallery">
                        Carregando mais fotos...
                    </div>

                </div>
            {else}
                <div class="col-md-9">
                    <img src="/img/CAMERA-not.png" class="img-responsive center-block">
                    <h2 class="text-center">Este evento não será fotografado pela equipe do Portal.</h2>
                </div>
            {/if}

        </div>

    </div>
    <div id="blueimp-gallery" class="blueimp-gallery  {if !$isMobile}blueimp-gallery-controls{/if}">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    <script>
        const eventUrl = "{$eventUrl}";
    </script>
    <script src="/vendor/blueimp-gallery/js/blueimp-gallery.min.js"></script>
    <script src="/js/page/event/event-single.js"></script>
    {include "../footer.tpl"}


{/if}