{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Jornais Impresso
        </h1>


    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-header">

                        <div class="btn-group  btn-group-sm pull-left">
                            <a href="/admin/impresso/cadastrar/" class="btn btn-info">
                                Cadastrar Jornal
                            </a>


                        </div>
                        <!-- tools box -->
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body pad">
                        <form method="get" action="/services/admin/impresso/pesquisar/" id="form_newspaper">
                            {if $geoRegionId}
                                <input type="hidden" value="{$geoRegionId}" name="geo_region_id" id="geo_region_id">
                            {else}
                                <div class="col-md-12 form-group">
                                    <label for="geo_region_id">Região</label>
                                    <select class="form-control" name="geo_region_id" id="geo_region_id"
                                            required="required">
                                    </select>
                                </div>
                            {/if}
                            <div class="col-md-12 form-group pull-right">
                                <button class="btn btn-primary" type="submit">
                                    Buscar
                                </button>
                            </div>
                        </form>


                        <table class="table table-strip">

                            <thead>
                            <tr>
                                <th>
                                    Id:
                                </th>
                                <th class='col-md-1'>
                                    capa:
                                </th>
                                <th>
                                    Descrição:
                                </th>
                                <th>
                                    Edição:
                                </th>
                                <th>
                                    Tiragem:
                                </th>
                                <th>
                                    Data de Publicação:
                                </th>
                                <th>
                                    Quantidade de Páginas:
                                </th>

                                <th>
                                    Status:
                                </th>
                                <th>
                                    Ações:
                                </th>
                            </tr>

                            </thead>

                            <tbody id="newspapers">

                            </tbody>

                        </table>


                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>


<script src="/vendor/jqueryform/jquery.form.min.js"></script>
<script src="/vendor/select2/select2.min.js"></script>
<script src="/admin/js/obj/Newspaper.js"></script>

<!-- script de configuração da pagina -->
<script src="/admin/js/page/newspaper/displayTable.js"></script>

{if !$geoRegionId}
    <script>
        $("#geo_region_id").select2({

            ajax: {
                url: "/services/admin/regiao/select2/permissao/newspaper/",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        geo_region_name: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },

            minimumInputLength: 1


        });

    </script>
{/if}

{include "../footer.tpl"}

