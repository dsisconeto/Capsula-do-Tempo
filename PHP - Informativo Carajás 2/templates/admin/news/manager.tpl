{extends file="../template.tpl"}
{block name="css" prepend}
    <link href="/vendor/select2/select2.min.css" rel="stylesheet">
{/block}

{block name="script" prepend}
    <script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
    <script src="/vendor/ckeditor/ckeditor.js"></script>
    <script src="/vendor/select2/select2.min.js"></script>
    <!-- script de configuração da pagina -->
    <script src="/dist_admin/js/obj/NewsTag.js"></script>
    <script src="/dist_admin/js/obj/News.js"></script>
    <script src="/dist_admin/js/page/news/manager.js"></script>
{/block}


{block name="content" prepend}
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {if $edit}
                    Editar Notícia
                    <br>
                    <small>
                        <b>Informações da Notícia</b>
                        |
                        <a href="/admin/noticia/capa/{$newsId}/">Capa da Notícia</a>
                    </small>
                {else}
                    Escrever Notícia
                    <br>
                    <small>
                        <b>Informações da Notícia</b>
                        |
                        Capa da Notícia
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
                            {if $edit}
                                <div class="btn-group pull-right" role="group" aria-label="...">
                                    {if $newsStatus == 1}
                                        <button onclick="News.updateStatus({$newsId}, 3, null, this)"
                                                class="btn btn-primary">
                                            Públicar
                                        </button>
                                    {else}
                                        <button onclick="News.updateStatus({$newsId}, 1, null, this)"
                                                class="btn btn-primary">
                                            Despublicar
                                        </button>
                                    {/if}
                                    <a href="/admin/noticia/capa/{$newsId}/" class="btn btn-info">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i> Capa da Notícia
                                    </a>
                                </div>
                            {/if}
                            <!-- tools box -->
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body pad">


                            <form role="form" id="form_news_post" method="post"
                                  action="/form/admin/noticia/{if $edit}editar{else}cadastrar{/if}/">

                                {* quando for editar*}
                                {if isset($newsId)}
                                    <input type="hidden" name="news_id" value="{$newsId}" id="news_id">
                                    <input type="hidden" name="news_status" value="{$newsStatus}">
                                {/if}

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="news_title">Titulo:*</label>
                                            <input type="text" placeholder="Titulo" class="form-control"
                                                   name="news_title"
                                                   id="news_title"
                                                   value="{$newsTitle}">
                                        </div>


                                        <div class="col-md-3">
                                            <label class="control-label" for="select_category">
                                                Selecionar Categoria:
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-tag" aria-hidden="true"></i>
                                                </div>

                                                <select class="form-control" id="select_category" name="news_category"
                                                        required="required">
                                                    {if isset($newsCategoryId)}
                                                        <option value="{$newsCategoryId}">{$newsCategoryName}</option>
                                                    {else}
                                                        <option value="">-- Selecione a categoria --</option>
                                                    {/if}
                                                    {if isset($allCategory)}
                                                        {foreach from=$allCategory item=key}
                                                            <option value="{$key.news_category_id}">
                                                                {$key.news_category_name}
                                                            </option>
                                                        {/foreach}
                                                    {/if}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="control-label" for="select_tag">
                                                Selecionar Tag:
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-tag" aria-hidden="true"></i>
                                                </div>

                                                <select class="form-control"
                                                        id="select_tag" name="news_tag_id" required="required">
                                                    <option value=''>-- Selecione a Tag --</option>
                                                    {if $edit}
                                                        <option value="{$newsTagId}"
                                                                selected="selected">{$newsTagName}</option>
                                                        {foreach from=$newsTagAll item=keyTag}
                                                            {if {$newsTagId} != $keyTag.news_tag_id}
                                                                <option value="{$keyTag.news_tag_id}">{$keyTag.news_tag_name}</option>
                                                            {/if}
                                                        {/foreach}

                                                    {/if}
                                                </select>
                                                <div class="input-group-addon btn btn-primary" id="btn_modal_news_tag">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>

                                                </div>


                                            </div>

                                        </div>


                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="news_post"></label>
                                    <textarea class="form-control" name="news_post" id="new_post" rows="20"
                                              cols="80">{$newsPost}</textarea>
                                </div>

                                <div class="form-group">
                                    <iframe border="0"
                                            style="overflow-x: hidden; height: 250px; width: 100%; border: 0;"
                                            src="/admin/noticia/imagem/upload/"></iframe>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">
                                        Selecione a Região
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </div>

                                        <select id="select_region" required="required" style="width: 100%;"
                                                name="geo_region_id[]"
                                                multiple="multiple">
                                            {if isset($geoRegionSelect)}
                                                {foreach from=$geoRegionSelect item=key}
                                                    <option value="{$key.geo_region_id}"
                                                            selected="selected">{$key.geo_region_name}</option>
                                                {/foreach}
                                            {/if}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary pull-right">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div><!-- /.box -->

                </div><!-- /.col-->
            </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cadatrar nova Tag</h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="form_add_tag" action="/form/admin/noticia/tag/cadastrar/" method="post">

                        <input type="hidden" name="news_category_id" required="required" id="modal_news_category_id">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="news_tag_name">Nome da Tag:</label>
                                <input type="text" class="form-control" id="news_tag_name" name="news_tag_name"
                                       required="required" minlength="2" autocomplete="off">
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">Cadastrar</button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}