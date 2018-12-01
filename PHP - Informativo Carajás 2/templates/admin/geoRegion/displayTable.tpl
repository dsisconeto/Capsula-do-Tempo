{extends file="../template.tpl"}

{block name="css" prepend}

{/block}

{block name="script" prepend}
    <script src="/vendor/jqueryform/jquery.form.min.js"></script>
    <!-- script de configuração da pagina -->
    <script src="/dist_admin/js/page/geoRegion/displayTable.js"></script>
{/block}

{block name="content" prepend}
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Regiões</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-body pad">

                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" id="form_search_region"
                                          action="/services/regiao/pesquisar/"
                                          method="post">

                                        <div class="form-group">
                                            <label for="geo_region_name">Nome:</label>
                                            <input type="text" class="form-control" name="geo_region_name"
                                                   id="geo_region_name"
                                                   required="required" minlength="2" autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary pull-right">
                                                Buscar
                                            </button>
                                        </div>

                                    </form>

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>
                                                Id:
                                            </th>
                                            <th>
                                                Nome:
                                            </th>
                                            <th>
                                                Ações:
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbody_geo_region">


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
{/block}
