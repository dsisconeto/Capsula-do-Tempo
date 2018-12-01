{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <section class="content-header">
        <h1>Configurar região <b>{$geoRegionName} - {$geoRegionId}</b></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">


                    <div class="box-body pad">
                        <div class="row">
                            <div class="col-md-6">
                                <form role="form" id="form_config_region"
                                      action="/form/admin/regiao/relacao/configuracao/"
                                      method="post">


                                    <input type="hidden" value="{$geoRegionId}" required="required" name="geo_region_id"
                                           id="geo_region_id">

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="event_view" id="event_view"
                                                   {if $eventView}checked="checked"{/if}>
                                            Habilitar Eventos
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="company_view"
                                                   id="company_view" {if $companyView}checked="checked"{/if}>
                                            Habilitar Empresas
                                        </label>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="newspaper_view"
                                                   id="newspaper_view" {if $newspaperView}checked="checked"{/if}>
                                            Jornal Impresso
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary pull-right">
                                            Enviar
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>

<script src="/vendor/jqueryform/jquery.form.min.js"></script>
<!-- script de configuração da pagina -->
<script src="/js/obj/Megaic.js"></script>
<script src="/admin/js/page/geoRegion/config.js"></script>


{include "../footer.tpl"}