{extends file="../template.tpl"}

{block name="css"}
    <link href="/css/page/news/news-single.css" rel="stylesheet">
{/block}

{block name="javascript"}
    <script src="/js/page/news/news-single.js"></script>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6&appId=258509954511790";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
{/block}

{block name="content"}
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <article>

                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-left news_title">
                                {$news->getTitle()}
                            </h1>
                        </div>
                    </div>
                    <div class="row margin-bottom-20">
                        <div class="col-md-12 ">

                            <p>
                                Publicada
                                em {$news->getDateInsert()}

                                {if $isMobile}
                                    <br>
                                {else}
                                    |
                                {/if}
                                <a href="/noticias/{$news->tag()->category()->getNickname()}/">
                                    {$news->tag()->category()->getName()}
                                    / {$news->tag()->getName()}
                                </a>


                                |


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

                            </p>


                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="post-text">

                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="/img/news_cover/{if $isMobile}xs{else}md{/if}/{$news->getCover()}"
                                             class="post-cover img-responsive col-md-12">
                                    </div>
                                    <div class="col-md-8 col-md-offset-2 ">
                                        {$news->getPost()}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </article>

                <div class="col-md-12"
                     id="comment_news_container">
                    <div class="fb-comments"
                         data-href="{$metaUrl}"
                         data-numposts="10"
                         data-width="100%"></div>
                </div>

            </div>
            <div class="col-md-3 col-xs-12">

                <div class="box-sidebar-body">
                    <div class="ads">
                        <script src="/services/anuncio/1/js/?url={$metaUrl}"></script>
                    </div>
                </div>


                {if isset($related)}
                    <div class="tag-section ">
                        Relacionadas
                    </div>
                    {foreach from=$related item=key}
                        <div class="card card-sm">
                            <a href="/{$key.system_url_url}">
                                <img src="/img/news_cover/xs/{$key.news_cover}"
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
                    {/foreach}

                {/if}


                {if isset($ViewManchete)}
                    <div class="tag-section">
                        Manchete
                    </div>
                    {foreach from=$ViewManchete item=key}
                        <div class="card card-sm">
                            <a href="/{$key.system_url_url}">
                                <img src="/img/news_cover/xs/{$key.news_cover}"
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
                    {/foreach}


                {/if}

                {if isset($viewMoreAll)}
                    <div class="tag-section ">
                        Em Alta
                    </div>
                    {foreach from=$viewMoreAll item=key}
                        <div class="card card-sm">
                            <a href="/{$key.system_url_url}">
                                <img src="/img/news_cover/xs/{$key.news_cover}"
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
                    {/foreach}
                {/if}


                {if isset($lastNews)}
                    <div class="tag-section ">
                        Últimas Notícias
                    </div>
                    {foreach from=$lastNews item=key}
                        <div class="card card-sm">
                            <a href="/{$key.system_url_url}">
                                <img src="/img/news_cover/xs/{$key.news_cover}"
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
                    {/foreach}
                {/if}
            </div>
            <div id="fb-root"></div>
        </div>
    </main>
{/block}