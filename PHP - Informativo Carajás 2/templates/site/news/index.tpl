{extends file="../template.tpl"}


{block name="content"}

    {include "manchete.tpl"}
    <div class="container">

        {if $categoryResult}

            {foreach from=$categoryResult item=$aux}

                {if $aux.items }
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tag-section text-center">{$aux.news_category_name}</div>
                        </div>
                    </div>
                    <div class="row">
                        {foreach from=$aux.items item=$key}
                            <div class="col-md-3 ">
                                <div class="card card-sm">
                                    <a href="/{$key.system_url_url}">
                                        <img src="/img/news_cover/xs/{{$key.news_cover}}"
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
                            </div>
                        {/foreach}
                    </div>
                {/if}
            {/foreach}
        {/if}

        <div class="row">
            <div class="col-md-12 ">
                <a href="/noticias/pesquisar/"
                   class="btn btn-danger view_more_btn ">
                    Todas Notícias
                </a>
            </div>
        </div>
    </div>
{/block}