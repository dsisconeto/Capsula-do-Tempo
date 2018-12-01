{include "../header.tpl"}

{if $selectRegion}

    {include "../selectRegion.tpl"}


{else}
    <link rel="stylesheet" href="/css/page/event/event-all.css">
    <div class="eventos" id="home_eventos">

    <div class="header-tag header-tag-top margin-bot">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    Eventos
                </div>
            </div>
        </div>
    </div>

    {include "roof.tpl"}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tag-section tag-section-event">
                    Todos Eventos
                </div>
            </div>
        </div>

        <div class="row" id="events-all">


        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="loading">
                    Carregando mais Eventos...
                </div>

            </div>

        </div>


    </div>

    <script src="/js/page/event/event-all.js"></script>


{/if}