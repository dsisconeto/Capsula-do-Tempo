{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <link rel="stylesheet" href="/admin/css/page/company-featured.css">

    <section class="content-header">
        <h1>
            Empresas em Destaque
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body pad">

                        <form role="form" id="form_company_featured" method="post"
                              action="/form/admin/empresa/destaque/cadastrar/">
                            <div class="row">

                                {if !$geoRegionId}
                                    <div class="form-group col-md-4">
                                        <label for="geo_region_id">Selecione a região</label>

                                        <select id="geo_region_id" name="geo_region_id" class="form-control"
                                                required="required">
                                        </select>
                                    </div>
                                {else}
                                    <input type="hidden" name="geo_region_id" id="geo_region_id" value="{$geoRegionId}">
                                {/if}


                                <div class="form-group col-md-4">
                                    <label for="company_id">Selecione a Empresa</label>
                                    <select id="company_id" name="company_id" class="form-control" required="required">
                                    </select>

                                </div>


                                <div class="form-group col-md-4">
                                    <label for="company_featured_id">Selecione o Segmento</label>
                                    <select id="company_featured_id" name="company_featured_id" class="form-control"
                                            required="required">
                                        <option value="">-- Selecione o Segmento --</option>
                                        {foreach from=$companyFeaturedAll item=key}
                                            <option value="{$key.company_featured_id}">{$key.company_featured_name}</option>
                                        {/foreach}
                                    </select>

                                </div>

                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        Adicionar
                                    </button>
                                </div>

                            </div>
                        </form>
                        <hr>

                        <form role="form" id="company_featured_search">

                            {if !$geoRegionId}
                                <div class="form-group col-md-4">
                                    <label>Selecione a região</label>

                                    <select id="search_geo_region_id" class="form-control">

                                    </select>

                                </div>
                            {else}
                                <input type="hidden" value="{$geoRegionId}" name="search_geo_region_id">
                            {/if}
                            <div class="form-group col-md-4">
                                <label>Selecione o Segmento</label>
                                <select id="search_company_featured_id" class="form-control" required="required">
                                    <option value="">-- Selecione o Segmento --</option>

                                    {foreach from=$companyFeaturedAll item=key}
                                        <option value="{$key.company_featured_id}">{$key.company_featured_name}</option>
                                    {/foreach}
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Buscar
                                </button>
                            </div>

                        </form>


                        <ul id="list_company">


                        </ul>

                    </div><!-- /.box -->

                </div><!-- /.col-->
            </div><!-- ./row -->
    </section><!-- /.content -->

</div>
<script src="/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/vendor/select2/select2.min.js"></script>
<script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>

<!-- script de configuração da pagina -->
<script src="/js/obj/Megaic.js"></script>

<script src="/admin/js/page/company/featured.js"></script>
{if !$geoRegionId}
<script>
    $("#geo_region_id").select2(searhRegion);
    $("#search_geo_region_id").select2(searhRegion);

</script>
{/if}

{include "../footer.tpl"}


