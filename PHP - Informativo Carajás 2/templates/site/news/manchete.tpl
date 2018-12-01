<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="tag-section text-center">Manchete</div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form role="form" class="search" method="get" action="/noticias/pesquisar/">
                <input type="hidden" value="{$geoRegionId}" name="region">
                <input type="text" class="form-control  margin-bottom-20"
                       placeholder="Pesquisar Notícias por título ou categoria..."
                       style="width: 85%;border-radius: 20px 0 0 20px; float: left;" value="" name="arg"
                       autocomplete="off" required="required" minlength="1">
                <button class="btn btn-primary form-control margin-bottom-20"
                        style="width: 15%;    border-radius: 0 20px 20px 0px; float: left;">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>

            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-md-9">


            <div class="card card-lg">

                <a href="/{$resultNews.local_1.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}lg{/if}/{$resultNews.local_1.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_1.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="col-md-3">

            <div class="card card-sm">
                <a href="/{$resultNews.local_2.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_2.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_2.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="card card-sm">
                <a href="/{$resultNews.local_3.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_3.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_3.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="card card-sm">
                <a href="/{$resultNews.local_4.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_4.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_4.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-md">
                <a href="/{$resultNews.local_5.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}md{/if}/{$resultNews.local_5.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_5.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card card-md">
                <a href="/{$resultNews.local_6.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}md{/if}/{$resultNews.local_6.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_6.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-4">
                <a href="/{$resultNews.local_7.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}sm{/if}/{$resultNews.local_7.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_7.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card card-4">
                <a href="/{$resultNews.local_8.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}sm{/if}/{$resultNews.local_8.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_8.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>


        <div class="col-md-4">
            <div class="card card-4">
                <a href="/{$resultNews.local_9.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}sm{/if}/{$resultNews.local_9.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_9.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>


    </div>


    <div class="row">


        <div class="col-md-3">
            <div class="card card-sm">
                <a href="/{$resultNews.local_10.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_10.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_10.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card card-sm">
                <a href="/{$resultNews.local_11.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_11.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_11.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="card card-sm">
                <a href="/{$resultNews.local_12.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_12.news_cover}" class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_12.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>

        <div class="col-md-9">

            <div class="card card-lg">
                <a href="/{$resultNews.local_13.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}lg{/if}/{$resultNews.local_12.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_13.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-md-4">

            <div class="card card-4">
                <a href="/{$resultNews.local_14.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}sm{/if}/{$resultNews.local_14.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_14.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>
        <div class="col-md-4">

            <div class="card card-4">
                <a href="/{$resultNews.local_15.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}sm{/if}/{$resultNews.local_15.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_15.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <div class="col-md-4">

            <div class="card card-4">
                <a href="/{$resultNews.local_16.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}sm{/if}/{$resultNews.local_16.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_16.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="card card-md">
                <a href="/{$resultNews.local_17.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}md{/if}/{$resultNews.local_17.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_17.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card card-md">
                <a href="/{$resultNews.local_18.system_url_url}">
                    <img src="/img/news_cover/{if $isMobile}xs{else}md{/if}/{$resultNews.local_18.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_18.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-sm">
                <a href="/{$resultNews.local_19.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_19.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_19.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card card-sm">
                <a href="/{$resultNews.local_20.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_20.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_20.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card card-sm">
                <a href="/{$resultNews.local_21.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_21.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_21.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card card-sm">
                <a href="/{$resultNews.local_22.system_url_url}">
                    <img src="/img/news_cover/xs/{$resultNews.local_22.news_cover}"
                         class="img-responsive">
                    <div class="card-block">
                        <div class="card-content">
                            <div class="card-title">
                                {$resultNews.local_22.news_title}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
