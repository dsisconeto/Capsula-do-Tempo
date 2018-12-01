{include file="../header.tpl"}
{if $selectRegion}
    {include "../selectRegion.tpl" }
{else}
    <link href="/css/news.css" rel="stylesheet">
    <link href="/css/page/news/news-single.css"
          rel="stylesheet">
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <article>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/noticias/{$newsCategoryNickname}/"
                               class="tag-text tag-text-{$newsCategoryColor}">{$newsCategoryName}
                                >> {$newsTag}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-left news_title">
                                    {$newsTitle}
                            </h1>
                        </div>
                    </div>
                    <div class="row margin-bottom-20">
                        <div class="col-md-12">
                            Públicada
                            em {$newsDateInsert}
                        </div>
                    </div>
                    <div class="row hidden-print">

                        <div class="col-md-4 col-xs-6">
                            <a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={$metaUrl}', 'Compartilhar', 'toolbar=0, status=0, width=650, height=450');"
                               href="javascript: void(0);"
                               class="btn-shared btn-shared-facebook"><i
                                        class="fa fa-facebook"
                                        aria-hidden="true"></i>
                                Compartilhar
                            </a>
                        </div>

                        <div class="col-md-4 col-xs-6">
                            <a href="javascript: void(0);"
                               onclick="window.open('https://plus.google.com/share?url={$metaUrl}', 'Compartilhar', 'toolbar=0, status=0, width=650, height=450');"
                               class="btn-shared btn-shard-google-plus">
                                <i class="fa fa-google-plus"
                                   aria-hidden="true"></i>
                                Compartilhar
                            </a>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <a href="javascript: void(0);"
                               onclick="window.open('https://twitter.com/intent/tweet?text={$metaUrl}', 'Compartilhar', 'toolbar=0, status=0, width=650, height=450');"
                               class="btn-shared btn-shared-twitter">
                                <i class="fa fa-twitter"
                                   aria-hidden="true"></i>
                                Compartilhar

                            </a>
                        </div>
                        <div class="col-md-3 col-xs-6">
                            {if $isMobile}
                                <a href="whatsapp://send?text={$metaUrl}"
                                   class="btn-shared btn-shard-whats-app">

                                    <i class="fa fa-whatsapp"
                                       aria-hidden="true">
                                    </i>
                                    Compartilhar
                                </a>
                            {/if}
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post-text">

                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="/img/news_cover/md/{$newsCover}"
                                             class="post-cover img-responsive col-md-12">
                                    </div>
                                    <div class="col-md-8 col-md-offset-2 ">
                                        {$newsPost}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </article>

                <div class="col-md-12">
                    <a target="_blank"
                       href="javascript: void(0);"
                       class="btn-shared btn-shared-facebook"
                       onclick="window.open('http://www.facebook.com/sharer.php?u={$metaUrl}','Compartilhar no facebook', 'toolbar=0, status=0, width=650, height=450');">
                        <i class="fa fa-facebook"
                           aria-hidden="true"></i>
                        <b> Compartilhe esta
                            notícia com os seus
                            amigos</b>
                    </a>
                </div>

                <div class="col-md-12"
                     id="comment_news_container">
                    <div class="fb-comments"
                         data-href="{$metaUrl}"
                         data-numposts="10"
                         data-width="100%"></div>
                </div>

                {if $lastNews}
                    <div class="col-md-12">
                        <div class="tag-section ">
                            Últimas Notícias
                        </div>
                    </div>
                    {foreach from=$lastNews item=key}
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <a href="{$getHost}{$key.system_url_url}"
                               class="card-last-news">
                                <img src="/img/news_cover/xs/{$key.news_cover}"
                                     class="img-responsive">
                                <p>
                                    <span class="tag-text tag-text-{$key.news_category_color}">{$key.news_tag_name}</span><br>
                                    {$key.news_title}
                                </p>
                            </a>
                        </div>
                    {/foreach}
                {/if}


            </div>
            <div class="col-md-3 col-xs-12 col-md-12  hidden-print">

                <div class="box-sidebar-body">
                    <div class="ads">
                        <script src="/services/anuncio/1/js/{$countAds++}/?url={$metaUrl}"></script>
                    </div>
                </div>

                <div class="tag-section">
                    Manchete
                </div>
                <div class="box-sidebar-body">
                    {foreach from=$ViewManchete item=key}
                        <a href="{$key.system_url_url}"
                           class="box-news box-news-sm box-news-md-margin">
                            <img src="img/news_cover/xxs/{$key.news_cover}"
                                 class="img-responsive">
                            <div class="box-news-text">
                                <p>
                                    <span class="tag-text tag-text-{$key.news_category_color}">{$key.news_tag_name}</span><br>
                                    {$key.news_title}
                                </p>
                            </div>
                        </a>
                    {/foreach}
                </div>
                <div class="tag-section ">
                    Em Alta
                </div>
                <div class="box-sidebar">
                    <ul>
                        {foreach from=$viewMoreAll item=key}
                            <li>
                                <a href="{$host}{$key.system_url_url}">
                                    <div class="media">
                                        <div class="media-left">
                                            <img class="media-object"
                                                 width="150"
                                                 src="/img/news_cover/xs/{$key.news_cover}"
                                                 alt=" ...">
                                        </div>
                                        <div class="media-body">

                                            <h4 class="media-heading text-left">{$key.news_title}</h4>

                                        </div>
                                    </div>
                                </a>
                            </li>
                        {/foreach}
                    </ul>

                </div>
                {if !$isMobile}
                    <div class="ads-sidebar">
                        {for $i=1 to $countAdsView}
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="ads">
                                        <script src="/services/anuncio/1/js/{$countAds++}/?url={$metaUrl}"></script>
                                    </div>
                                </div>
                            </div>
                        {/for}
                    </div>
                {/if}
            </div>

        </div>
    </main>
    <script src="/js/page/news/news-single.js"></script>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6&appId=258509954511790";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    {include file="../footer.tpl"}
{/if}