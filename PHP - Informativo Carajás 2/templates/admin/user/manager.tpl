{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {if $edit}
                Editar Usuário: {$userName}
            {else}
                Cadastrar Usuário
            {/if}
        </h1>


    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-header">

                        <div class="btn-group  btn-group-sm pull-left">
                            <a href="/usuario/todos/" class="btn btn-info">
                                <i class="fa fa-list" aria-hidden="true"></i> Todos os Usuários
                            </a>
                        </div>
                        <!-- tools box -->
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body pad">


                        <form role="form" id="form_user_manager" method="post"
                              action="/form/usuario/{if $edit}editar{else}cadastrar{/if}/" autocomplete="off">
                            {if $edit}
                                <input type="hidden" name="system_user_id" value="{$userId}">
                            {/if}
                            <div class="form-group col-md-6">
                                <label for="system_user_name">
                                    Nome Completo:
                                </label>

                                <input type="text" class="form-control" name="system_user_name" id="system_user_name"
                                       required="required" minlength="2" maxlength="50" autocomplete="off"
                                       {if isset($userName)}value="{$userName}"{/if}>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="system_user_email">
                                    Email:
                                </label>

                                <input type="email" class="form-control" name="system_user_email" id="system_user_email"
                                       required="required" maxlength="300" autocomplete="off"
                                       {if isset($userEmail)}value="{$userEmail}"{/if}>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="system_user_login">
                                    Login:
                                </label>

                                <input type="text" class="form-control" name="system_user_login" id="system_user_login"
                                        {if !$edit} required="required"minlength="2"{/if} maxlength="20"
                                       autocomplete="off"
                                        {if $edit}placeholder="Deixe vazio caso não queira editar o Login"{/if}>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="system_user_password">
                                    Senha:
                                </label>

                                <input type="password" class="form-control" name="system_user_password"
                                       id="system_user_password"
                                        {if !$edit} required="required" minlength="2"{/if} maxlength="20"
                                       autocomplete="off"
                                        {if $edit}placeholder="Deixe vazio caso não queira editar a Sanha"{/if}>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="system_user_phone_number">
                                    Número do Telefone:
                                </label>

                                <input type="text" class="form-control" name="system_user_phone_number"
                                       id="system_user_phone_number"
                                       minlength="8" maxlength="15" autocomplete="off"
                                       {if isset($userPhone)}value="{$userPhone}"{/if}>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="system_user_description">
                                    Descrição:
                                </label>

                                <textarea class="form-control" name="system_user_description"
                                          id="system_user_description">{if isset($userDescription)}{$userDescription}{/if}</textarea>
                            </div>


                            <div class="form-group col-md-12">
                                <h3>Permissões do Usuário</h3>

                                {if $loginPermissionNews}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="system_user_permission_news"
                                                   {if (isset($userPermissionNews)) && $userPermissionNews}checked="checked"{/if}
                                                   value="1">Cadastrar
                                            Notícias
                                        </label>
                                    </div>
                                {/if}

                                {if $loginPermissionNewsCategory}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_news_category" value="1"
                                                   {if (isset($userPermissionNewsCategory)) && $userPermissionNewsCategory}checked="checked"{/if}>
                                            Cadastrar
                                            Categoria de
                                            Notícias
                                        </label>
                                    </div>
                                {/if}

                                {if $loginPermissionNewsSuper}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_news_super" value="1"
                                                   {if (isset($userPermissionNewsSuper)) && $userPermissionNewsSuper}checked="checked"{/if}>
                                            Aprovar
                                            Notícias
                                        </label>
                                    </div>
                                {/if}

                                {if $loginPermissionEvent}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_event" value="1"
                                                   {if (isset($userPermissionEvent)) && $userPermissionEvent}checked="checked"{/if}>
                                            Casdatrar Evento
                                        </label>
                                    </div>
                                {/if}


                                {if $loginPermissionEventCategory}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_event_category"
                                                   value="1"
                                                   {if (isset($userPermissionEventCategory)) && $userPermissionEventCategory}checked="checked"{/if}>
                                            Cadastrar Categoria de
                                            Evento
                                        </label>
                                    </div>
                                {/if}

                                {if $loginPermissionEventSuper}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_event_super" value="1"
                                                   {if (isset($userPermissionEventSuper)) && $userPermissionEventSuper}checked="checked"{/if}>
                                            Aprovar
                                            Evento
                                        </label>
                                    </div>
                                {/if}
                                {if $loginPermissionCompany }
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_company" value="1"
                                                   {if (isset($userPermissionCompany)) && $userPermissionCompany}checked="checked"{/if}>
                                            Cadastrar
                                            Empresas
                                        </label>
                                    </div>
                                {/if}
                                {if $loginPermissionAds}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_ads" value="1"
                                                   {if (isset($userPermissionAds)) && $userPermissionAds}checked="checked"{/if}>
                                            Castrar Anúncios
                                        </label>
                                    </div>
                                {/if}
                                {if $loginPermissionUserRegister}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_register_user" value="1"
                                                   {if (isset($userPermissionUserRegister)) && $userPermissionUserRegister}checked="checked"{/if}>Cadastrar
                                            Usuário
                                        </label>
                                    </div>
                                {/if}

                                {if $loginPermissionGeo}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_geo" value="1"
                                                   {if (isset($userPermissionGeo)) && $userPermissionGeo}checked="checked"{/if}>
                                            Gerenciar Regiões
                                        </label>
                                    </div>
                                {/if}


                                {if $loginPermissionPartner}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_partner" value="1"
                                                   {if (isset($userPermissionPartner)) && $userPermissionPartner}checked="checked"{/if}>
                                            Cadastrar Parceiros
                                        </label>
                                    </div>
                                {/if}


                                {if $loginPermissionNewspaper}
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="system_user_permission_newspaper" value="1"
                                                   {if (isset($userPermissionNewspaper)) && $userPermissionNewspaper}checked="checked"{/if}>
                                            Cadastrar Parceiros
                                        </label>
                                    </div>
                                {/if}


                            </div>


                            <div class="form-group col-md-12">
                                <button class="btn btn-primary pull-right">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Enviar
                                </button>
                            </div>
                        </form>


                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
</div>


<script src="/vendor/jqueryform/jquery.form.min.js"></script>

<script src="/vendor/select2/select2.min.js"></script>

<!-- script de configuração da pagina -->
<script src="/js/page/user/manager.js"></script>

{include "../footer.tpl"}
