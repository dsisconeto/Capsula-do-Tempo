{extends file="../template.tpl"}

{block name="css"}


    <link rel="stylesheet" href="/vendor/animate-css/css.css">
    <link rel="stylesheet" href="/css/page/newspaper/readerPage.css">

{/block}

{block name="javascript"}
    <script>
        var number = {$pageNumber};
        var countPage = {$countPage};
        var pages = {$pagesJson};
    </script>
    <script src="/js/page/newspaper/readerPage.js"></script>
    <script src="/vendor/animate-css/js.js"></script>
{/block}

{block name="content"}


    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">{$regionName}<br>
                    <small> {$edition}º Edição, Publicado em {$dataPub}, Tiragem {$drawing}</small>
                </h1>
            </div>
        </div>

        <div class="row hidden-print">
            <div class="col-md-6 col-md-offset-3">
                <div class="col-md-4 col-xs-6">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={$metaUrl}"
                       class="btn-shared btn-shared-facebook"><i class="fa fa-facebook"
                                                                 aria-hidden="true"></i>
                        Compartilhar
                    </a>
                </div>

                <div class="col-md-4 col-xs-6">
                    <a target="_blank" href="https://plus.google.com/share?url={$metaUrl}"
                       class="btn-shared btn-shard-google-plus">

                        <i class="fa fa-google-plus"
                           aria-hidden="true"></i>
                        Compartilhar
                    </a>
                </div>
                <div class="col-md-4 col-xs-6">
                    <a target="_blank" href="https://twitter.com/intent/tweet?text={$metaUrl}"
                       class="btn-shared btn-shared-twitter">
                        <i class="fa fa-twitter" aria-hidden="true"></i> Compartilhar

                    </a>
                </div>
                <div class="col-md-3 col-xs-6">
                    {if $isMobile}
                        <a href="whatsapp://send?text={$metaUrl}" class="btn-shared btn-shard-whats-app">

                            <i class="fa fa-whatsapp" aria-hidden="true">
                            </i> Compartilhar
                        </a>
                    {/if}
                </div>

            </div>
        </div>
        <div class="row">

            <div class="col-md-12 page">
                <div class="back_page"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></div>
                <img id="page" src="" class="img-responsive center-block">
                <div class="next_page"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></div>
            </div>

        </div>
    </div>
    {foreach from=$pages item=key}
        <img src="/img/newspaper_page/lg/{$key.newspaper_page_file}" class="hidden">
    {/foreach}

{/block}





