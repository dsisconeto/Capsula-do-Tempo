{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Categorias e Tags de Notícias
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body pad">

                        <form role="form" id="form-add-tag" action="/form/admin/noticia/tag/cadastrar/" method="post">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label>Selecione a Categoria:</label>
                                    <select class="form-control" name="news_category_id" id="news_category_id">
                                        {foreach from=$newsCategoryAll item=key}
                                            <option value="{$key.news_category_id}">
                                                {$key.news_category_name}
                                            </option>
                                        {/foreach}
                                    </select>

                                </div>

                                <div class="form-group col-md-6">
                                    <label>Nome da Tag:</label>
                                    <input type="text" class="form-control" id="news_tag_name" name="news_tag_name">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button class="btn btn-primary pull-right" type="submit">
                                        Cadastrar
                                    </button>
                                </div>
                            </div>
                        </form>


                        <div class="row">
                            <div class="col-md-12">

                                <table class="table table-bordered table-striped">
                                    <thead>

                                    <tr>
                                        <th>
                                            Nome da Tag:
                                        </th>
                                        <th>
                                            Ações:
                                        </th>
                                    </tr>

                                    </thead>

                                    <tbody id="tbody_tags">


                                    </tbody>


                                </table>
                            </div>
                        </div>


                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>
<script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
<script src="/admin/js/obj/NewsTag.js"></script>
<script src="/admin/js/page/news/tag.js"></script>
{include "../footer.tpl"}