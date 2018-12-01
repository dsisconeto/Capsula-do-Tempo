{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {if $edit}
                Editar Empresa
            {else}
                Cadastrar Empresa
            {/if}
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-info">
                    <div class="box-header">
                        <div class="btn-group pull-left">
                            {if !$loginUserCompany}
                                <a href="/admin/empresa/todas/" class="btn btn-info"> <i class="fa fa-building"
                                                                                         aria-hidden="true"></i>
                                    Empresas</a>
                            {/if}

                            {if $edit}
                                <a href="/admin/empresa/adicionais/{$companyId}/" class="btn btn-info">
                                    Adicionais</a>
                            {/if}
                        </div>
                        {if $edit}
                            <div class="btn-group pull-right">

                                {if $companyStatus == 1}
                                    <button onclick="Company.updateStatus({$companyId}, 0, this)"
                                            class="btn btn-danger">
                                        <i class="fa fa-times" aria-hidden="true"></i> Desativar
                                    </button>
                                {else}
                                    <button onclick="Company.updateStatus({$companyId}, 1, this)"
                                            class="btn btn-success">
                                        <i class="fa fa-check" aria-hidden="true"></i> Ativar
                                    </button>
                                {/if}

                            </div>
                        {/if}

                        <!-- tools box -->
                    </div>


                    <div class="box-body pad">

                        <div class="row">

                            <form role="form" id="form_company_register" method="post"
                                  action="">

                                {if $edit}
                                    <input type="hidden" value="{$companyId}" name="company_id" id="company_id">
                                {/if}

                                <div class="form-group col-md-2">
                                    <label for="company_nivel">Nivel da Empresa:</label>
                                    <input type="number" max="5" min="1" class="form-control" id="company_nivel"
                                           name="company_nivel" value="{$companyNivel}"
                                           {if $loginUserCompany}disabled="disabled"{/if}>
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="company_name">Razão Social:</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                           value="{$companyName}" {if $loginUserCompany}disabled="disabled"{/if}>
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="company_fantasy_name">Nome Fantasia:</label>
                                    <input type="text" class="form-control" id="company_fantasy_name"
                                           name="company_fantasy_name" value="{$companyFantasyName}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="system_url_url">Url da Empresa:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">informativocarajas.com/</span>
                                        <input type="text" class="form-control" id="system_url_url"
                                               name="system_url_url" value="{$systemUrlUrl}">
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="company_cnpj_or_cpf">CPF ou CNPJ:</label>
                                    <input type="text" class="form-control" id="company_cnpj_or_cpf"
                                           name="company_cnpj_or_cpf" value="{$companyCnpjOrCpf}"
                                           {if $loginUserCompany}disabled="disabled"{/if}>
                                </div>

                                <div class="form-group col-md-5">
                                    <label for="company_address">Endereço Completo:</label>
                                    <input type="text" class="form-control" id="company_address" name="company_address"
                                           value="{$companyAddress}" required="required" minlength="2" maxlength="300">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="company_address_embed">Url do Google Maps:</label>
                                    <input type="text" class="form-control" id="company_address_embed"
                                           name="company_address_embed"
                                           value='{if $edit && $companyAddressEmbed}<iframe src="https://www.google.com/maps/embed?pb={$companyAddressEmbed}" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>{/if}'>
                                </div>

                                <div class="form-group col-md-12" id="post">
                                    <label for="company_description">Descrição da Empresa:</label>
                                    <textarea class="form-control" id="company_description"
                                              name="company_description">{$companyDescription}</textarea>
                                </div>


                                <div class="form-group col-md-12">
                                    <button type="submit"
                                            class="btn btn-primary pull-right"
                                            id="btn_submit">{if $edit}Editar{else}Cadastrar{/if}</button>
                                </div>

                            </form>
                        </div>

                    </div><!-- /.box -->

                </div><!-- /.col-->
            </div><!-- ./row -->
    </section><!-- /.content -->
</div>
<script src="/vendor/select2/select2.min.js"></script>
<script src="/vendor/ckeditor/ckeditor.js"></script>
<script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
<!-- script de configuração da pagina -->
<script src="/js/obj/Megaic.js"></script>
<script src="/admin/js/obj/Company.js"></script>

<script>

    var edit = {if $edit}true{else}false{/if };
    var userCompany = {if $loginUserCompany}true{else}false{/if };


</script>


<script src="/admin/js/page/company/manager.js"></script>

<script>
    companyLevel();
</script>


{include "../footer.tpl"}

