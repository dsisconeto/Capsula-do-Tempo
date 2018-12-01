{extends file="../template.tpl"}

{block name="css" prepend}
    <link href="/vendor/select2/select2.min.css" rel="stylesheet">
{/block}

{block name="script" prepend}
    <script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
    <script src="/vendor/select2/select2.full.min.js"></script>
    <script src="/js/obj/Megaic.js"></script>
    <script src="/dist_admin/js/page/news/panel.js"></script>
{/block}

{block name="content" prepend}
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Painel de Notícias
            </h1>
        </section>

        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="select_geo_region">Região:</label>
                                    <select class="form-control" name="select_geo_region"
                                            id="select_geo_region"></select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    <button class="btn btn-success btn-block" id="desc">Decrescer <span
                                                class="badge">ON</span></button>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-header -->


                        <div class="box-body pad">


                            <form method="post" action="/form/admin/noticia/painel/alterar/" id="form_panel">
                                <input type="hidden" name="geo_region_id" id="geo_region_id" value="0">
                                <table class="table table-bordered table-strip">
                                    <thead>
                                    <tr>
                                        <th style="width: 133px">Local:</th>
                                        <th>Notícia:</th>
                                    </tr>
                                    </thead>

                                    <tbody id="table_news">

                                    </tbody>
                                </table>
                            </form>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="form-control btn btn-primary" id="btn_save" style="display: none">
                                        Salvar
                                    </button>
                                </div>
                            </div>

                            <!-- /.box -->
                        </div><!-- /.col-->
                    </div><!-- ./row -->
        </section><!-- /.content -->
    </div>
{/block}