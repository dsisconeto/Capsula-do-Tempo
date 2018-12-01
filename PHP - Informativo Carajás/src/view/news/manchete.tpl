<div class="hidden-xs hidden-sm">
    <div class="header-tag header-tag-top hidden-xs header-tag-news">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-tag-span">Notícias</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  =================================!-->

<nav class="navbar navbar-default navbar-news">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <span class="navbar-tag hidden-md hidden-lg">Notícias</span>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">

                {foreach from=$newsCategoryAll item=key}
                    <li>
                        <a href="/noticias/{$key.news_category_nickname}"
                           onclick="loadNewsByCategory({$key.news_category_id})" style="text-transform: capitalize"
                           class="news-category-btn btn_news_category_{$key.news_category_id}">
                            {$key.news_category_name}
                        </a>


                    </li>
                {/foreach}
                <li>
                    <a href="/noticias/" onclick="lastNews(true)" class="news-category-btn btn_news_category_0"
                       style="text-transform: capitalize">
                        Ultimas Notícias
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div id="news-manchete" class="news-manchete">

        <div class="row">
            <div class="col-md-12">
                <div class="quadro-mega-1 margin-bottom-20">
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
                <div class="quadro-grande-1 margin-bottom-20">
                </div>

            </div>

            <div class="col-md-3">
                <div class="quadro-pequeno-1 margin-bottom-20">
                </div>

                <div class="quadro-pequeno-2"></div>
            </div>

            <div class="col-md-3">

                <div class="quadro-pequeno-3 margin-bottom-20"></div>

                <div class="quadro-pequeno-4"></div>
            </div>

        </div>


        <div class="row">

            <div class="col-md-4">
                <div class="quadro-medio-1 margin-bottom-20">
                </div>

            </div>

            <div class="col-md-4">
                <div class="quadro-medio-2 margin-bottom-20">
                </div>

            </div>

            <div class="col-md-4">
                <div class="quadro-medio-3 margin-bottom-20">
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


            <div class="col-md-3">

                <div class="quadro-pequeno-5 margin-bottom-20">
                </div>

                <div class="quadro-pequeno-6">
                </div>

            </div>

            <div class="col-md-3">

                <div class="quadro-pequeno-7 margin-bottom-20"></div>

                <div class="quadro-pequeno-8"></div>
            </div>


            <div class="col-md-6">
                <div class="quadro-grande-2 margin-bottom-20">
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
        {if !$isMobile}
            <div class="hidden-xs hidden-sm">
                <div class="col-md-12">
                    <ul class="bxslider">
                        <li>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="quadro-pequeno-9"></div>
                                </div>

                                <div class="col-md-3">
                                    <div class="quadro-pequeno-10"></div>
                                </div>

                                <div class="col-md-3">
                                    <div class="quadro-pequeno-11"></div>
                                </div>

                                <div class="col-md-3">
                                    <div class="quadro-pequeno-12"></div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="quadro-pequeno-13"></div>
                                </div>

                                <div class="col-md-3">
                                    <div class="quadro-pequeno-14"></div>
                                </div>

                                <div class="col-md-3">
                                    <div class="quadro-pequeno-15"></div>
                                </div>

                                <div class="col-md-3">
                                    <div class="quadro-pequeno-16"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        {/if}
        {if $isMobile}
            <div class="hidden-md hidden-lg">
                <ul class="bxslider">

                    <li>
                        <div class="quadro-pequeno-9"></div>
                    </li>

                    <li>
                        <div class="quadro-pequeno-10"></div>
                    </li>

                    <li>
                        <div class="quadro-pequeno-11"></div>
                    </li>

                    <li>
                        <div class="quadro-pequeno-12"></div>
                    </li>

                    <li>
                        <div class="quadro-pequeno-13"></div>
                    </li>
                    <li>
                        <div class="quadro-pequeno-14"></div>
                    </li>

                    <li>
                        <div class="quadro-pequeno-15"></div>
                    </li>

                    <li>
                        <div class="quadro-pequeno-16"></div>
                    </li>

                </ul>

            </div>
        {/if}
    </div>

</div>