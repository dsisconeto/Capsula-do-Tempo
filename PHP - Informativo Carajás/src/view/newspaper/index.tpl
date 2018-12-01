{include "../header.tpl"}

{if $selectRegion}

    {include "../selectRegion.tpl"}

{else}
    <link href="/css/page/newspaper/index.css" rel="stylesheet">
    <div class="container">
        <div class="row">

            <div id="newspapers">

            </div>

        </div>
    </div>
    <script src="/js/page/newspaper/index.js"></script>
    {include "../footer.tpl"}

{/if}