{extends file="../template.tpl"}

{block name="css"}
    <link rel="stylesheet" href="/css/page/event/single.css">
    <link rel="stylesheet" href="/vendor/blueimp-gallery/css/blueimp-gallery.css">
{/block}
{block name="javascript"}
    <script src="/vendor/blueimp-gallery/js/blueimp-gallery.min.js"></script>
    <script src="/js/obj/Event.js"></script>
    <script>
        Event.Single.eventId = {$eventId};


        Event.Single.gallery = {$gallery};
    </script>
    <script src="/js/page/event/event-single.js"></script>
{/block}


{block name="content"}
    <div class="container">


        <div class="row">

            <div class="col-md-12">
                <h1 class="text-center text-uppercase">
                    {$eventName}
                </h1>

            </div>
        </div>


        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 event-cover ">
                        <img src="/img/event_cover/sm/{$eventCover}" alt="Capa do Evento {$eventName}"
                             class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="event-description">
                            <a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={$metaUrl}', 'Compartilhar', 'toolbar=0, status=0, width=650, height=450');"
                               href="javascript: void(0);" class="btn-shared btn-shared-facebook ">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>

                            <a class="btn-shared btn-shard-google-plus " href="javascript: void(0);"
                               onclick="window.open('https://plus.google.com/share?url={$metaUrl}', 'Compartilhar', 'toolbar=0, status=0, width=650, height=450');">
                                <i class="fa fa-google-plus" aria-hidden="true"></i>
                            </a>

                            <a class="btn-shared btn-shard-twitter " href="javascript: void(0);"
                               onclick="window.open('https://twitter.com/intent/tweet?text={$metaUrl}', 'Compartilhar', 'toolbar=0, status=0, width=650, height=450');">
                                <i class="fa fa-twitter"
                                   aria-hidden="true"></i>

                            </a>
                            <a class="btn-shared btn-shard-whats-app " href="whatsapp://send?text={$metaUrl}">

                                <i class="fa fa-whatsapp"
                                   aria-hidden="true">
                                </i>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
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
        </div>
        <div class="row">
            {if $eventRoof == 1}
                {if !$gallery}
                    <div id="event-roof">
                        <div class="col-md-9">
                            <img src="/img/CAMERAr.png" class="img-responsive center-block">
                            <h2 class="text-center">Este evento será fotografado pela equipe do Portal. <br>
                                <small>Em breve as fotos serão postadas...</small>
                            </h2>
                        </div>
                    </div>
                {/if}
                <div class="col-md-12">
                    <div class="row">
                        <div id="links">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
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
{/block}