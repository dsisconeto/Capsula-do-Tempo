{extends file="../template.tpl"}
{block name="css" prepend}
    <link rel="stylesheet" href="/vendor/croppic/css/croppic.css">
{/block}

{block name="script" prepend}

    <script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
    <script src="/vendor/croppic/js/croppic.min.js"></script>
    <!-- script de configuração da pagina -->
    <script src="/dist_admin/js/obj/News.js"></script>
    <script src="/dist_admin/js/page/news/cover.js"></script>
{/block}


{block name="content" prepend}
    <div class="content-wrapper">
    <section class="content-header">

        <h1>
            {if isset($newsCover)}
                Editar Notícia
                <small>{$newsTitle} - {$newsId}</small>
                <br>
                <small>
                    <a href="/admin/noticia/editar/{$newsId}/"> Informações da Notícia</a>
                    |
                    <b>Capa da Notícia</b>
                </small>
            {else}
                Postar nova notícia
                <small>
                    <a href="/admin/noticia/editar/{$newsId}/"> Informações da Notícia</a> |
                    <small>Capa da Notícia</small>
                </small>
            {/if}

        </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">

                        <div class="btn-group  btn-group-sm pull-left">
                            <a href="/admin/noticia/todas/" class="btn btn-info">
                                <i class="fa fa-list" aria-hidden="true"></i> Tabela de Notícias
                            </a>
                        </div>

                        <div class="btn-group pull-right" role="group" aria-label="...">
                            {if $newsStatus == 1}
                                <button onclick="News.updateStatus({$newsId}, 3,null, this)" class="btn btn-primary">
                                    Públicar
                                </button>
                            {else}
                                <button onclick="News.updateStatus({$newsId}, 1,null, this)" class="btn btn-primary">
                                    Despublicar
                                </button>
                            {/if}
                            <a href="/admin/noticia/editar/{$newsId}/" class="btn btn-info">
                                Informações da Notícia
                            </a>

                        </div>


                        <!-- tools box -->
                    </div><!-- /.box-header -->
                    <div class="box-body pad">


                        <div class="row">
                            <div class="col-md-12" id="news_cover_file"
                                 style="{if !isset($newsCover)}display: none{/if}">
                                <h2 class="text-center">Capa antiga.</h2>
                                <img src="/img/news_cover/lg/{if isset($newsCover)}/{$newsCover}{/if}"
                                     class="img-responsive center-block">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <h2 class="text-center">Upload de Imagem de Capa</h2>
                                <div id="show_cover"
                                     style="margin: 0 auto; width:1200px; height: 720px; position:relative; border:solid 1px #CCCCCC;"
                                     class="center-block">
                                </div>
                            </div>
                        </div>


                        <hr>
                        <form role="form" id="form_news_cover" method="post"
                              action="/form/admin/noticia/capa/">
                            <input type="hidden" name="news_cover" id="news_cover" required="required">
                            <input type="hidden" name="news_id" value="{$newsId}" required="required">
                        </form>

                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
{/block}