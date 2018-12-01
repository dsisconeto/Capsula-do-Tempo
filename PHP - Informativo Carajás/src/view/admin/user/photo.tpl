{include "../header.tpl"}
{include "../siderbar.tpl"}
<div class="content-wrapper">
    <link rel="stylesheet" href="/vendor/croppic/css/croppic.css">

    <section class="content-header">

        <h1>
            Foto do Perfil : {$userName}
        </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">

                        <div class="btn-group  btn-group-sm pull-left">
                            <a href="/admin/usuario/todos/" class="btn btn-info">
                                <i class="fa fa-user" aria-hidden="true"></i> Usuários
                            </a>
                            <a href="/admin/usuario/editar/{$userId}/" class="btn btn-info">
                                Editar Informações
                            </a>
                        </div>


                        <!-- tools box -->
                    </div><!-- /.box-header -->
                    <div class="box-body pad">


                        <div class="row">
                            <div class="col-md-12" id="user_photo_file"
                                 style="{if !$userPhoto}display: none{/if}">
                                <h2 class="text-center">Foto antiga.</h2>
                                <img src="{if $userPhoto}/img/sys-avatar/{$userPhoto}{/if}"
                                     class="img-responsive center-block">
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <h2 class="text-center">Foto do Perfil</h2>
                                <div id="show_cover"
                                     style="margin: 0 auto; width:160px; height: 160px; position:relative; border:solid 1px #CCCCCC;"
                                     class="center-block">
                                </div>

                            </div>

                        </div>


                        <hr>
                        <form role="form" id="form_user_photo" method="post"
                              action="/form/admin/usuario/foto/cadastrar/">
                            <input type="hidden" name="system_user_profile_photo" id="system_user_profile_photo" required="required">
                            <input type="hidden" name="system_user_id" value="{$userId}" required="required">
                        </form>

                    </div>
                </div><!-- /.box -->

            </div><!-- /.col-->
        </div><!-- ./row -->
    </section><!-- /.content -->
    <script src="/vendor/jqueryAjaxForm/jquery.form.min.js"></script>
    <script src="/vendor/croppic/js/croppic.min.js"></script>
    <!-- script de configuração da pagina -->

    <script src="/admin/js/page/user/photo.js"></script>

{include "../footer.tpl"}