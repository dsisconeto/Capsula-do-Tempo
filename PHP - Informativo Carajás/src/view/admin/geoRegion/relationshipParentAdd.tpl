{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <section class="content-header">
        <h1>Cadastrar Relação entre regiões : <b>{$geoRegionName}</b></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">


                    <div class="box-body pad">
                        <form role="form" id="form_region" method="post"
                              action="/form/admin/regiao/relacao/cadastrar/">
                            <input type="hidden" value="{$geoRegionId}" name="geo_region_id_parent"
                                   id="geo_region_id_parent"
                                   required="required">

                            <div class="form-group col-md-12">

                                <label for="geo_region_id"></label>

                                <select class="form-control" name="geo_region_id" id="geo_region_id">
                                </select>
                            </div>

                            <div class="form-group col-md-12">

                                <button class="btn btn-primary pull-right">
                                    Adicionar
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
                            </tr>
                            </thead>
                            <tbody id="tbody_geo_region">


                            </tbody>
                        </table>

                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>

<script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
<script src="/vendor/select2/select2.min.js"></script>
<!-- script de configuração da pagina -->

<script src="/admin/js/page/geoRegion/relationshipParentAdd.js"></script>


{include "../footer.tpl"}