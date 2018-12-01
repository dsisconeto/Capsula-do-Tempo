{extends file="../template.tpl"}

{block name="script" prepend}
    <script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
    <script src="/js/obj/Megaic.js"></script>
    <script src="/dist_admin/js/obj/News.js"></script>
    <script src="/dist_admin/js/page/news/displayTable.js"></script>
    <!-- script de configuração da pagina -->
{/block}

{block name="content" prepend}
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Notícias
            </h1>
        </section>
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">
                            <form role="form" id="form_news_search" method="get"
                                  action="/services/admin/noticia/pesquisar/">

                                <input type="hidden" value="1" name="page" id="page">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="news_title">Pesquisar pelo titulo:</label>
                                        <input type="text" name="news_title" class="form-control" id="news_title">
                                    </div>


                                    <div class="form-group col-md-2">
                                        <label for="news_status">Filtrar Por Status:</label>
                                        <select class="form-control" name="news_status" id="news_status">
                                            <option value="0">Todas</option>
                                            <option value="3">Publicadas</option>
                                            <option value="2">Em Analise</option>
                                            <option value="1">Não Publicadas</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="news_category_id">Filtrar por Categoria:</label>
                                        <select class="form-control" name="news_category_id" id="news_category_id">
                                            <option value="0">-- Selecione a Cagoria --</option>
                                            {if categoryAll}
                                                {foreach from=$categoryAll item=key}
                                                    <option value="{$key.news_category_id}">{$key.news_category_name}</option>
                                                {/foreach}
                                            {/if}
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="order_by">Orderna por:</label>
                                        <select class="form-control" name="order_by" id="order_by">
                                            <option value="2">Data de Cadastro</option>
                                            <option value="1">Titulo</option>
                                            <option value="3">Data de Edição</option>
                                            <option value="4">Visualisações</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="order">Ordem:</label>
                                        <select class="form-control" name="order" id="order">
                                            <option value="desc">Decrescente</option>
                                            <option value="asc">Crescente</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <a href="/admin/noticia/cadastrar/" class="btn btn-info pull-left">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Nova Notícia
                                        </a>

                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-search" aria-hidden="true"></i> Buscar
                                        </button>

                                    </div>

                                </div>
                            </form>
                            <hr>

                            <nav aria-label="Page navigation">
                                <ul class="pagination" id="pagination">
                                </ul>
                            </nav>
                            <table class="table table-bordered table-striped" id="table">
                                <thead>
                                <tr>
                                    <th>
                                        #Id
                                    </th>
                                    <th class="col-md-2">
                                        Titulo da Notícia
                                    </th>
                                    <th class="col-md-3">
                                        Capa da Imagem:
                                    </th>

                                    <th class="col-md-1">
                                        Categoria:
                                    </th>

                                    <th class="col-md-1">
                                        Link:
                                    </th>


                                    <th>
                                        Exibição:
                                    </th>

                                    <th>
                                        Data de Cadastro:
                                    </th>

                                    <th>
                                        Status:
                                    </th>


                                    <th class="col-md-3">
                                        Ações:
                                    </th>
                                </tr>
                                </thead>


                                <tbody id="tbody_news">

                                </tbody>
                            </table>


                            <!-- /.box -->
                        </div><!-- /.col-->
                    </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
{/block}
