{include "../header.tpl"}

{if $selectRegion}
    {include "../selectRegion.tpl"}

{else}
    <link href="/css/page/news/news-all.css" rel="stylesheet">
    <link href="/css/news.css" rel="stylesheet">
    <link href="/vendor/animate-css/css.css" rel="stylesheet">
    <link href="/vendor/jquery.bxslider/jquery.bxslider.css" rel="stylesheet">
    {include "manchete.tpl"}
    <div class="container">

        <div class="row news-wall" id="news-wall" style="min-height:100px">


        </div>
        <div class="news-wall-loading">
            <img src="/img/loader.gif">
        </div>
    </div>
    <script src="/vendor/animate-css/js.js"></script>
    <script src="/vendor/jquery.bxslider/jquery.bxslider.min.js"></script>
    <script>
        {if isset($newsCategoryId)}
        var newsCategoryId = {$newsCategoryId};
        {else}
        var newsCategoryId = 0;
        {/if}
        const home = false;

    </script>
    <script src="/js/page/news/manchete.js"></script>
    <script src="/js/page/news/news-all.js"></script>
{/if}

