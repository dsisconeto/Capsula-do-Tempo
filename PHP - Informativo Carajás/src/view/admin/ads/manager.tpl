{include "../header.tpl"}
{include "../siderbar.tpl"}

<div class="content-wrapper">

    <link href="/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <section class="content-header">
        <h1>
            {if $edit}
                Editar Publicidade
            {else}
                Cadastrar Nova Publicidade
            {/if}

        </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-header">
                        {if isset($msgSuccess)}
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                {$msgSuccess}
                            </div>
                        {/if}

                        {if isset($msgError)}
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                {$msgError}
                            </div>
                        {/if}

                    </div>
                    <!-- /.box-header -->

                    <div class="box-body pad">

                        <form role="form" id="form_ads_manager" method="post"
                              action="/form/admin/anuncio/{if $edit}editar{else}registrar{/if}/"
                              enctype="multipart/form-data">
                            <input type="hidden" value="{$adsId}" name="ads_id">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Imagem da Pubublicidade:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-picture"></span>
                                        </div>
                                        <input type="file" class="form-control" name="ads_file"
                                               {if !$edit}required="required"{/if}>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="ads_local_id">Tipo de Anúncio</label>
                                    <select class="form-control" name="ads_local_id" id="ads_local_id"
                                            required="required">
                                        {if !$edit}
                                            <option value="">-- Selecione o Tipo de Anuncio --</option>
                                        {/if}
                                        {foreach from=$adsLocalAll item=key}
                                            <option value="{$key.ads_local_id}">{$key.ads_local_name}</option>
                                        {/foreach}
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="ads_link">Link:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-link"></span>
                                        </div>
                                        <input type="text" class="form-control" name="ads_link" id="ads_link"
                                               value="{$adsLink}"
                                               required="required">
                                    </div>
                                </div>

                            </div>

                            <div class="row">


                                <div class="form-group col-md-2">
                                    <label for="ads_start_display">Inicio da Exibição:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                        <input type="text" id="ads_start_display" class="form-control"
                                               name="ads_start_display"
                                               value="{$adsStartDisplay}" required="required">
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="ads_end_display">Fim da Exibição:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                        <input type="text" id="ads_end_display" class="form-control"
                                               name="ads_end_display"
                                               value="{$adsAndDisplay}" required="required">
                                    </div>
                                </div>


                                <div class="form-group col-md-8">
                                    <label for="select_company">Selecione a empresa:</label>
                                    <select id="select_company" style="width: 100%;" class="form-control"
                                            name="company_id"
                                            {if $edit}disabled{else} required="required"{/if} >
                                        {if $edit}
                                            <option value="{$companyId}">
                                                {$companyName}

                                            </option>
                                        {/if}
                                    </select>
                                </div>


                            </div>
                            {if !$geoRegionId}
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label for="select_region">Região:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"
                                                                              aria-hidden="true"></i>
                                            </div>


                                            <select id="select_region" name="geo_region[]" style="width: 100%;"
                                                    multiple="multiple" required="required">
                                                {if $regionAll}
                                                    {foreach from=$regionAll item=key}
                                                        <option selected="selected" value="{$key.geo_region_id}">
                                                            {$key.geo_region_name}
                                                        </option>
                                                    {/foreach}
                                                {/if}
                                            </select>


                                        </div>
                                    </div>

                                </div>
                            {else}
                                <input type="hidden" name="geo_region[]" value="{$geoRegionId}">
                            {/if}


                            <div class="form-group">

                                <button class="btn btn-primary pull-right" type="submit">
                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Enviar
                                </button>


                            </div>
                        </form>
                        {if $edit}
                            <div class="row">
                                <div class="col-md-12">

                                    <img src="/img/ads_banner/lg/{$adsFile}" class="img-responsive center-block">

                                </div>
                            </div>
                        {/if}

                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>
<!-- script de configuração da pagina -->
<script src="/vendor/select2/select2.min.js"></script>
<script src="/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>

<script src="/js/obj/Megaic.js"></script>
<script src="/admin/js/obj/Ads.js"></script>
<script src="/admin/js/page/ads/manager.js"></script>


{include "../footer.tpl"}